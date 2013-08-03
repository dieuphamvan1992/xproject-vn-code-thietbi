<script>
$(document).ready(function() {

    $("#loaithietbi").select2();
    $("#tenthietbi").select2();

});
</script>
<script type="text/javascript">// <![CDATA[
$(document).ready(function() {
    $('#loaithietbi').change(function() {
        $('#tenthietbi option:gt(0)').remove();

        var loaithietbi_ID = $('#loaithietbi').val();
            // alert("<?php echo site_url('ajax/getListThietBiByIDLoai/'); ?>/"+loaithietbi_ID);
            $.ajax({
                type: "GET",
                url: "<?php echo site_url('ajax/getListThietBiByIDLoai/'); ?>/" + loaithietbi_ID,
                dataType: "json",
                success: function(data)
                {

                    $.each(data, function(id, ten)
                    {
                        $('#tenthietbi').append($("<option></option>")
                            .attr("value", id).text(ten));
                    });
                },
                error: function(error) {
                    console.log(error);
                }

            });

        });
});
// ]]>
</script>
<script type="text/javascript">// <![CDATA[
$(document).ready(function() {
    $('#tenthietbi').change(function() {


        var tenthietbi_ID = $('#tenthietbi').val();
            //  alert(tenthietbi_ID);
            // alert("<?php echo site_url('ajax/getListChiTietNhapByIDTen/'); ?>/"+loaithietbi_ID);
            $.ajax({
                type: "GET",
                url: "<?php echo site_url('ajax/getListChiTietNhapByIDTen/'); ?>/" + tenthietbi_ID,
                success: function(data)
                {

                    $('#resultHoaDon').html(data);
                },
                error: function(error) {
                    console.log(error);
                }

            });

        });
});
// ]]>
</script>
<h3> Tạo hoá đơn xuất </h3>
<?php
    echo form_open("hoadonxuat/luuThongTinChung");
    $thongTinChung = $this->session->userdata("ThongTinChung");
?>
<div class="container-box">
    <!--Ba cột-->
    <div class="three-column">
        <div class="box">
            <label for="">Số hóa hơn</label>
            <div class="input-box">
                <input type="text" name="soHoaDon" value="<?php echo set_value('soHoaDon',$thongTinChung['soHoaDon']); ?>" />
            </div>
            <?php echo form_error('soHoaDon', '<div class="error">', '</div>'); ?>
        </div>
        <div class="box">
            <label for="" >Cán bộ thực hiện</label>
            <div class="input-box">
                <input type="text" name="canBoThucHien" value="<?php echo set_value('canBoThucHien',$thongTinChung['canBoThucHien']); ?>" />
            </div>
            <?php echo form_error('canBoThucHien', '<div class="error">', '</div>'); ?>
        </div>
        <div class="box">
            <label for="" >Ngày Thực hiện</label>
            <div class="input-box">
                <?php
                if (empty ($thongTinChung['ngayThucHien']))
                {
                    $day = $today;
                }
                else
                    $day = $thongTinChung['ngayThucHien'];
                ?>
                <input type="text" name="ngayThucHien" value="<?php echo set_value('ngayThucHien',$day); ?>" />
            </div>
            <?php echo form_error('ngayThucHien', '<div class="error">', '</div>'); ?>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="three-column">
        <div class="box">
            <label for="">Nguồn vốn</label>
            <div class="input-box">

                 <select name="nguonVon" id="">
                        <option value=""></option>
                        <?php
                        foreach ($list_nguonvon as $item) {
                            if ($thongTinChung['nguonVon'] == $item['id'] )
                                echo "<option value = " . $item['id'] . " selected>" . $item['ten'] . "</option>";
                            else
                            echo "<option value = " . $item['id'] . ">" . $item['ten'] . "</option>";
                        }
                        ?>
                    </select>
            </div>
            <?php echo form_error('nguonVon', '<div class="error">', '</div>'); ?>
        </div>
        <div class="box">
            <label for="" >Phòng</label>
            <div class="input-box">
                <input type="text" name="phong" value="<?php echo set_value('phong',$thongTinChung['phong']); ?>" />
            </div>
            <?php echo form_error('phong', '<div class="error">', '</div>'); ?>
        </div>
        <div class="box">
            <label for="" >Đơn vị nhận</label>
            <div class="input-box">
                <input type="text" name="donViNhan" value="<?php echo set_value('donViNhan',$thongTinChung['donViNhan']); ?>"/>
            </div>
            <?php echo form_error('donViNhan', '<div class="error">', '</div>'); ?>
        </div>
        <div class="clearfix"></div>
    </div>
    <input type="submit" class="btn btn-success"value="Lưu" name="btnSave">
<?php
    echo form_close();
?>
    <!--<div class="sub-box">

</div>-->
<?php echo form_open('hoadonxuat/taoHoaDon'); ?>
<div class="button-box">

    <a href="<?php echo site_url("hoadonxuat/resetXuat"); ?>" onclick="return confirm('Bạn có muốn tạo lại hoá đơn xuất? \nLưu ý: Toàn bộ thông tin đã thêm sẽ bị xoá.');"><button class="btn">Reset</button></a>


    <input type="submit" name="btnCreateHoaDonXuat" value="Tạo hoá đơn xuất" class="btn btn-success" >

</div>
</div>

<!--Bảng-->
<div class="table-box">
    <table class="table table-bordered">
        <tr>
            <th>Tên thiết bị</th>
            <th>Hoá đơn nhập</th>
            <th>Số lượng còn</th>
            <th>Số lượng xuất</th>
            <th>Chi phí lắp đặt</th>
            <th>Chi phí vận chuyển</th>
            <th>Chi phí chạy thử</th>
            <th colspan="2"></th>
        </tr>
        <?php
        if (!empty($xuat)) {
            //    var_dump($xuat);
            foreach ($xuat as $key => $item) {
                $i = $key;
                ?>
                <tr>
                    <input type="hidden" name="id_chi_tiet_nhaps[<?php echo $i; ?>]" value="<?php echo $item[0]; ?>" />
                    <input type="hidden" name="id_thiet_bis[<?php echo $i; ?>]" value="<?php echo $item[1]; ?>" />
                    <td> <input type="text" style="width: 150px;" readonly name="ten_thiet_bis[<?php echo $i; ?>]" value="<?php echo $item[2]; ?>" /></td>
                    <td> <input type="text" style="width: 100px;" readonly name="hoa_don_nhaps[<?php echo $i; ?>]" value="<?php echo $item[8]; ?>" /></td>
                    <td> <input type="text"  style="width: 40px;" readonly name="so_luong_cons[<?php echo $i; ?>]" value="<?php echo $item[4]; ?>" /></td>

                    <td> <input type="text"  style="width: 40px;" readonly name="so_luongs[<?php echo $i; ?>]" value="<?php echo $item[3]; ?>" /></td>

                    <td> <input type="text" style="width: 90px;" name="chi_phi_lap_dats[<?php echo $i; ?>]" value="<?php echo number_format((double) $item[5]); ?>" /></td>
                    <td> <input type="text" style="width: 90px;" name="chi_phi_van_chuyens[<?php echo $i; ?>]" value="<?php echo number_format((double) $item[6]); ?>" /></td>
                    <td> <input type="text" style="width: 90px;" name="chi_phi_chay_thus[<?php echo $i; ?>]" value="<?php echo number_format((double) $item[7]); ?>" /></td>
                    <td> <a href="<?php echo site_url("hoadonxuat/edit/$item[9]"); ?>" class="btn"><i class="icon-edit"></i></a></td><td><a href="<?php echo site_url("hoadonxuat/del/$item[9]"); ?>"><i class="icon-remove"></a></i></td>


                </tr>
                <?php
            }
        }
        ?>
    </table>
</div>
<?php echo form_close(); ?>
<div align="center">

</div>

<?php
if (isset($edit)) { //nếu đang sửa thông tin thiết bị
    echo form_open("hoadonxuat/doEdit/" . $id_edit);


    ?>
    <input type="hidden" name="thiet_bi_id" value="<?php echo $edit[1]; ?>" >
    <input type="hidden" name="so_luong_cu" value="<?php echo $edit[3]; ?>" >
    <input type="hidden" name="hoadon_id" value="<?php echo $edit[0]; ?>" >
    <div class="container-box">
        <div class="box-title">
            <button class="btn btn-success">Thêm thiết bị xuất</button>
        </div>
        <!--Ba cột-->
        <div class="three-column">

            <div class="box">
                <label for="" >Tên thiết bị</label>
                <div class="input-box">
                    <input type="text" readonly value="<?php echo $edit[2]; ?>" >

                </div>
            </div>
            <div class="box">
                <label for="" >Hoá đơn nhập</label>
                <div class="input-box">
                    <div id="resultHoaDon" >
                        <input type="text" readonly value="<?php echo "Hoá đơn: ". $edit[8]." - Số lượng: ".$edit[4]; ?>" />
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <!--Ba cột-->
        <div class="three-column">

            <div class="box">
                <label for="" >Số lượng xuất</label>
                <div class="input-box">
                    <?php
                    ?>
                    <input type="text" name="so_luong" <?php
                    if (isset($edit)) {
                        echo "value = '" . $edit[3] . "'";
                    }
                    ?> />
                </div>
            </div>
            <div class="box">
                <label for="" >Chi phí lắp đặt</label>
                <div class="input-box">
                    <input type="text" name="chi_phi_lap_dat" <?php
                    if (isset($edit)) {
                        echo "value = '" . $edit[5] . "'";
                    }
                    ?> />
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="three-column">
            <div class="box">
                <label for="">Chi phí vận chuyển</label>
                <div class="input-box">
                    <input type="text" name="chi_phi_van_chuyen"  <?php
                    if (isset($edit)) {
                        echo "value = '" . $edit[6] . "'";
                    }
                    ?> />
                </div>
            </div>
            <div class="box">
                <label for="">Chi phí chạy thử</label>
                <div class="input-box">
                    <input type="text" name="chi_phi_chay_thu" <?php
                    if (isset($edit)) {
                        echo "value = '" . $edit[7] . "'";
                    }
                    ?> />
                </div>
            </div>

            <div class="clearfix"></div>
            <input type="submit" name ="btnUpdateThietBiXuat" class="btn btn-success">

        </div>
    </div>

    <?php
} else { //nếu là thêm mới thiết bị vào hoá đơn
    echo form_open("hoadonxuat/doAdd");
    ?>



    <div class="container-box">
        <div class="box-title">
            <a href="<?php echo site_url("hoadonxuat"); ?>">
                <button class="btn btn-success">Thêm thiết bị xuất</button>
            </a>
        </div>
        <!--Ba cột-->
        <div class="three-column">
            <div class="box">
                <label for="">Loại thiết bị</label>
                <div class="input-box">
                    <select name="loai_thiet_bi" id="loaithietbi">

                        <option value=""></option>
                        <?php
                        foreach ($list_loaithietbi as $item) {

                            echo "<option value = " . $item['id'] . ">" . $item['ten'] . "</option>";
                        }
                        ?>
                    </select>
                    <?php echo form_error('loai_thiet_bi', '<div class="error">', '</div>'); ?>
                </div>
            </div>
            <div class="box">
                <label for="" >Tên thiết bị</label>
                <div class="input-box">
                    <select name="ten_thiet_bi" id="tenthietbi">
                        <option value=""></option>
                        <?php
                        foreach ($list_tenthietbi as $item) {

                            echo "<option value = " . $item['id'] . ">" . $item['ten'] . "</option>";
                        }
                        ?>
                    </select>
                    <?php echo form_error('ten_thiet_bi', '<div class="error">', '</div>'); ?>
                </div>
            </div>
        </div>
        <!--Ba cột-->
        <div class="three-column">
            <div class="box">
                <label for="" >Hoá đơn nhập</label>
                <div class="input-box">
                    <div id="resultHoaDon" >
                        <input type="text"  />
                    </div>
                </div>
                <?php echo form_error('hoa_don_nhap', '<div class="error">', '</div>'); ?>
            </div>



            <div class="box">
                <label for="" >Số lượng xuất</label>
                <div class="input-box">
                    <?php ?>
                    <input type="text" name="so_luong" />
                    <?php echo form_error('so_luong', '<div class="error">', '</div>'); ?>
                </div>

            </div>
            <div class="clearfix"></div>
        </div>
        <div class="three-column">
            <div class="box">
                <label for="" >Chi phí lắp đặt</label>
                <div class="input-box">
                    <input type="text" name="chi_phi_lap_dat" />
                </div>
                <?php echo form_error('chi_phi_lap_dat', '<div class="error">', '</div>'); ?>
            </div>

            <div class="box">
                <label for="">Chi phí vận chuyển</label>
                <div class="input-box">
                    <input type="text" name="chi_phi_van_chuyen" />
                </div>
                <?php echo form_error('chi_phi_van_chuyen', '<div class="error">', '</div>'); ?>
            </div>
            <div class="box">
                <label for="">Chi phí chạy thử</label>
                <div class="input-box">
                    <input type="text" name="chi_phi_chay_thu" />
                </div>
                <?php echo form_error('chi_phi_chay_thu', '<div class="error">', '</div>'); ?>
            </div>

            <div class="clearfix"></div>
            <input type="submit" name ="btnThemThietBiXuat" class="btn btn-success">

        </div>
    </div>
    <?php
}
?>




<?php echo form_close(); ?>