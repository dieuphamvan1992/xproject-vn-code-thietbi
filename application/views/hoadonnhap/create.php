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
<h3> Tạo hoá đơn nhập </h3>
<?php
    echo form_open("hoadonnhap/luuThongTinChung");
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
            <label for="" >Nhà cung cấp</label>
            <div class="input-box">
                 <select name="nhaCungCap" id="">
                <?php
                        foreach ($list_nhacungcap as $item) {
                            if ($item['id'] == $thongTinChung['nhaCungCap'])
                               echo "<option value = " . $item['id'] . " selected>" . $item['ten'] . "</option>";
                           else
                            echo "<option value = " . $item['id'] . ">" . $item['ten'] . "</option>";
                        }
                        ?>

           </select>
            </div>

            <?php echo form_error('nhaCungCap', '<div class="error">', '</div>'); ?>
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
            <label for="">Cán bộ thực hiện</label>
            <div class="input-box">
                <input type="text" name="canBoThucHien" readonly value="<?php echo $this->session->userdata('idcanbo'); ?>"/>
            </div>
            <?php echo form_error('canBoThucHien', '<div class="error">', '</div>'); ?>
        </div>
        <div class="box">
            <label for="" >Mô tả</label>
            <div class="input-box">
                <input type="text" name="moTa" value="<?php echo set_value('moTa',$thongTinChung['moTa']); ?>" />
            </div>
            <?php echo form_error('moTa', '<div class="error">', '</div>'); ?>
        </div>

        <div class="clearfix"></div>
    </div>
    <input type="submit" class="btn btn-success"value="Lưu" name="btnSave">
<?php
    echo form_close();
?>
    <!--<div class="sub-box">

</div>-->
<?php echo form_open('hoadonnhap/taoHoaDon'); ?>
<div class="button-box">

    <a href="<?php echo site_url("hoadonnhap/resetNhap"); ?>" onclick="return confirm('Bạn có muốn tạo lại hoá đơn nhập? \nLưu ý: Toàn bộ thông tin đã thêm sẽ bị xoá.');"><button class="btn">Reset</button></a>


    <input type="submit" name="btnCreateHoaDonNhap" value="Tạo hoá đơn nhập" class="btn btn-success" >

</div>
</div>

<!--Bảng-->
<div class="table-box">
    <table class="table table-bordered">
        <tr>
            <th>Tên thiết bị</th>
            <th>Số lượng</th>
            <th>Đơn giá</th>
            <th>Thời gian bảo hành</th>
            <th colspan="2"></th>
        </tr>
        <?php
        if (!empty($nhap)) {
            //    var_dump($xuat);
            foreach ($nhap as $key => $item) {
                $i = $key;
                ?>
                <input type="hidden" name="id_thiet_bis[<?php echo $i; ?>]" value="<?php echo $item[0]; ?>">
                <tr>

                    <td> <input type="text" style="width: 150px;" readonly name="ten_thiet_bis[<?php echo $i; ?>]" value="<?php echo $item[1]; ?>" /></td>
                    <td> <input type="text" style="width: 100px;" readonly name="so_luongs[<?php echo $i; ?>]" value="<?php echo $item[2]; ?>" /></td>
                    <td> <input type="text"  style="width: 100px;" readonly name="don_gias[<?php echo $i; ?>]" value="<?php echo $item[3]; ?>" /></td>
                    <td> <input type="text"  style="width: 100px;" readonly name="bao_hanhs[<?php echo $i; ?>]" value="<?php echo $item[5]; ?>" /></td>

                   <td> <a href="<?php echo site_url("hoadonnhap/edit/$i"); ?>" class="btn"><i class="icon-edit"></i></a></td><td><a href="<?php echo site_url("hoadonnhap/del/$i"); ?>"><i class="icon-remove"></a></i></td>


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
    echo form_open("hoadonnhap/doEdit/" . $id_edit);


    ?>
    <input type="hidden" name="thiet_bi_id" value="<?php echo $edit[0]; ?>" >

    <div class="container-box">
        <div class="box-title">
            <button class="btn btn-success">Thêm thiết bị xuất</button>
        </div>
        <!--Ba cột-->
        <div class="three-column">

            <div class="box">
                <label for="" >Tên thiết bị</label>

                <select name="ten_thiet_bi" id="tenthietbi">
                        <option value=""></option>
                        <?php
                        foreach ($list_tenthietbi as $item) {
                            if ($edit[0] == $item['id'])
                        echo "<option value = " . $item['id'] . " selected>" . $item['ten'] . "</option>";
                            else
                            echo "<option value = " . $item['id'] . ">" . $item['ten'] . "</option>";
                        }
                        ?>
                    </select>
            </div>

            <div class="box">
                <label for="" >Số lượng </label>
                <div class="input-box">
                    <input type="text" name="so_luong" readonly value="<?php echo $edit[2]; ?>" >

                </div>
            </div>


            <div class="clearfix"></div>
        </div>
        <!--Ba cột-->
        <div class="three-column">

            <div class="box">
                <label for="" >Đơn giá</label>
                <div class="input-box">
                    <?php
                    ?>
                    <input type="text" name="don_gia" <?php
                    if (isset($edit)) {
                        echo "value = '" . $edit[3] . "'";
                    }
                    ?> />
                </div>
            </div>
            <div class="box">
                <label for="" >Thời gian bảo hành</label>
                <div class="input-box">
                    <input type="text" name="thoi_gian_bao_hanh" <?php
                    if (isset($edit)) {
                        echo "value = '" . $edit[5] . "'";
                    }
                    ?> />
                </div>
            </div>
            <div class="clearfix"></div>
        </div>


            <div class="clearfix"></div>
            <input type="submit" name ="btnUpdateThietBiXuat" class="btn btn-success">

        </div>
    </div>

    <?php
} else { //nếu là thêm mới thiết bị vào hoá đơn
    echo form_open("hoadonnhap/doAdd");
    ?>



    <div class="container-box">
        <div class="box-title">
            <a href="<?php echo site_url("hoadonxuat"); ?>">
                <button class="btn btn-success">Thêm thiết bị nhập</button>
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
            <div class="box">
                <label for="" >Số lượng</label>
                <div class="input-box">
                    <?php ?>
                    <input type="text" name="so_luong" />
                    <?php echo form_error('so_luong', '<div class="error">', '</div>'); ?>
                </div>

            </div>
            <div class="clearfix"></div>
        </div>
        <!--Ba cột-->




        <div class="three-column">
            <div class="box">
                <label for="" >Đơn giá</label>
                <div class="input-box">
                    <input type="text" name="don_gia" />
                </div>
                <?php echo form_error('don_gia', '<div class="error">', '</div>'); ?>
            </div>

            <div class="box">
                <label for="">Thời gian bảo hành</label>
                <div class="input-box">
                    <input type="text" name="thoi_gian_bao_hanh" />
                </div>
                <?php echo form_error('thoi_gian_bao_hanh', '<div class="error">', '</div>'); ?>
            </div>

            <div class="clearfix"></div>
        </div>
            <input type="submit" name ="btnThemThietBiNhap" class="btn btn-success">

        </div>
    </div>
    <?php
}
?>




<?php echo form_close(); ?>