<script>
    $(document).ready(function() {
        $("#nha_cung_cap").select2();
        $("#loaithietbi").select2();
        $("#tenthietbi").select2();

    });
</script>


<?php
if ($this->session->flashdata('editThietBiID')) {
    ?>
    <script>
        $(document).ready(function() {
            $('#themThietBi').modal("show");
        });
    </script>
    <?php
}
?>

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
<div class="container-box">
<h3><?php echo $title; ?></h3>
<?php
echo form_open('hoadon/doCreateHoaDonXuat');
?>
<div style="float: left; width: 30%; padding: 1% 0px 0px 4%;">
    <label>Số hoá đơn xuất</label>
    <input type="text" name="sohoadon" value="">
</div>
<div style="float: left; width: 30%; padding: 1% 0px 0px 1%;">

</div>
<div style="float: left; width: 30%; padding: 1% 0px 0px 1%;">
    <label>Ngày thực hiện</label>
    <input type="text" name="ngaythuchien">
</div>
<div style="float: left; width: 30%; padding: 1% 0px 0px 4%;">
    <label>Cán bộ thực hiện</label>
    <select name="id_can_bo_thuc_hien">
        <option value=""></option>
    </select>
</div>
<div style="float: left; width: 65%; padding: 1% 0px 1% 1%;">
    <label>Mô tả</label>
    <textarea name="mota" style="width:80%">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</textarea>
</div>
<label>Khu nhà</label>
<select name="khu_nha" ></select>
<label>Nguồn vốn</label>
<select name="nguon_von" ></select>
<label>Phòng</label>
<input type="text" name="phong" value="">
<label>Đơn vị nhận</label>
<select name="don_vi_nhan" ></select>
<?php
if ($this->session->flashdata('ketqua')) {
    ?>
    <div style="float: left; width: 86%; padding: 1% 0px 1% 1%;">
        <div class="alert">
            <a class="close" data-dismiss="alert">×</a>
            <?php echo $this->session->flashdata('ketqua'); ?>
        </div>
        <?
    }
    ?>
    <div style="float: left; width: 87%; padding: 1% 0px 1% 1%;">
        <a class="btn btn-primary" href="#themThietBi" data-toggle="modal" style="float:right"><i class="icon-plus"></i>Thêm thiết bị</a>
    </div>
    <div style="float: left; width: 85%; padding: 1% 0px 1% 4%;">
        <table class="table table-bordered" style="">
            <thead>
                <tr>
                    <th width="25%">Tên Thiết Bị</th>

                    <th width="65px">Số lượng</th>
                    <th width="25%">Đơn giá</th>

                    <th width="25%">Quốc gia</th>
                    <th colspan="2"></th>
                </tr>
            </thead>
            <tbody>

                <?php
                if (!empty($mycart)) {
                    foreach ($mycart as $item) {
                        ?>
                        <tr>
                            <td> <input type="text" name="ten_thiet_bis[<?php echo $item[0]; ?>]" value="<?php echo $item[1]; ?>" /></td>
                            <td> <input type="text" name="so_luongs[<?php echo $item[0]; ?>]" value="<?php echo $item[2]; ?>" /></td>
                            <td> <input type="text" name="don_gias[<?php echo $item[0]; ?>]" value="<?php echo $item[3]; ?>" /></td>

                            <td> <input type="text" name="quoc_gias[<?php echo $item[0]; ?>]" value="<?php echo $item[4]; ?>" /></td>



                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <input type="submit" name="btnCreateHoaDonXuat" class="btn btn-inverse add_data" value="Hoàn thành Hoá đơn" style="margin-left: auto; margin-right: auto; display: block">
</div>
<div style="clear:both"></div>
<?php echo form_close(); ?>
</div>

<!-- Button to trigger modal -->


<!-- Modal -->
<div id="themThietBi" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

        <h3>Thêm thiết bị</h3>

    </div>
    <div class="modal-body">
        <div class="span5">
            <?php
            echo form_open('hoadon/doAddThietBiXuat');
            ?>

            <label>Loại thiết bị</label>
            <select name="loai_thiet_bi" id="loaithietbi">
                <option value=""></option>
<?php
foreach ($list_loaithietbi as $item) {
    echo "<option value = " . $item['id'] . ">" . $item['ten'] . "</option>";
}
?>
            </select>
            <label>Thiết bị</label>
            <select name="ten_thiet_bi" id="tenthietbi">
                <option value=""></option>
<?php
foreach ($list_tenthietbi as $item) {

    echo "<option value = " . $item['id'] . ">" . $item['ten'] . "</option>";
}
?>
            </select>
            <label>Thuộc hoá đơn </label>
            <div id="resultHoaDon" >
                <select ></select>

            </div>
            <label>Số lượng</label>
            <input type="text" name="so_luong" value="">


            <label>Chi phí lắp đặt</label>
            <input type="text" name="chi_phi_lap_dat" value="">
            <label>Chi phí vận chuyển</label>
            <input type="text" name="chi_phi_van_chuyen" value="">
            <label>Chi phí chạy thử</label>
            <input type="text" name="chi_phi_chay_thu" value="">



            <input type="submit" name="btnThemThietBiXuat" class="btn btn-primary" value="Thêm Thiết bị" />
<?php echo form_close(); ?>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true" id="closePopup">Đóng</button>
    </div>
</div>