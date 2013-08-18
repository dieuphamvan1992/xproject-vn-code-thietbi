<script>
$(function() {
  $( "#ngayThucHien" ).datepicker({
    dateFormat: 'dd-mm-yy'
});
});
</script>
<script>
$(document).ready(function() {

  $("#loaithietbi").select2();
  $("#tenthietbi").select2();
  $("#nhacungcap").select2();

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
<div class="box-show" style="background:#f0f0f0">
	<span class="box-show-icon" >
		<i class="icon-chevron-down"></i>
	</span>
    Thông tin chung hóa đơn
    <div class="box-show-content"  style="background:#f0f0f0">
    	<table width="100%">
         <tr>
             <td>Số hóa đơn</td>
             <td><input type="text" readonly="readonly" value="<?php echo $thongTinChungNhap['soHoaDon']; ?>" /></td>
             <td>Ngày thực hiện</td>
             <td><input type="text" readonly="readonly" value="<?php echo $thongTinChungNhap['ngayThucHien']; ?>" /></td>
             <td>Nhà cung cấp</td>
             <?php
             $ncc = "";
             foreach ($list_nhacungcap as $item)
                if ($item['id'] == $thongTinChungNhap['nhaCungCap'])
                   { $ncc = $item['ten']; break; }
               ?>
               <td><input type="text" readonly="readonly" value="<?php echo $ncc; ?>" /></td>
           </tr>
           <tr>
             <td>Cán bộ thực hiện</td>
             <td><input type="text" readonly="readonly" value="<?php echo $thongTinChungNhap['canBoThucHien']; ?>" /></td>
             <td>Mô tả</td>
             <td><input type="text" readonly="readonly" value="<?php echo $thongTinChungNhap['moTa']; ?>" /></td>
         </tr>
     </table>
     <div style=" text-align:center"><a href="<?php echo site_url('hoadon/nhap/create'); ?>"><button class="btn btn-warning" type="submit" name="submit">Sửa</button></a></div>

 </div>

</div>
<div class="box-show">
	<span class="box-show-icon">
		<i class="icon-chevron-down"></i>
	</span>
    <strong>Thông tin chi tiết hóa đơn</strong>
    <div class="box-show-content">
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
                if ($this->session->userdata('idHoaDonSua'))
                {
                    $idHoaDonSua = $this->session->userdata('idHoaDonSua');
                      echo form_open("hoadon/nhap/doUpdate/$idHoaDonSua");
                }
                else
                echo form_open('hoadon/nhap/doCreate');
                if (!empty($nhaps)) {
            //    var_dump($xuat);
                    foreach ($nhaps as $key => $item) {
                        $i = $key;
                        if (empty($item))
                            continue;
                        ?>
                        <input type="hidden" name="id_thiet_bis[<?php echo $i; ?>]" value="<?php echo $item['id']; ?>">
                        <tr>

                            <td> <input type="text" style="width: 150px;" readonly name="ten_thiet_bis[<?php echo $i; ?>]" value="<?php echo $item['ten']; ?>" /></td>
                            <td> <input type="text" style="width: 100px;" readonly name="so_luongs[<?php echo $i; ?>]" value="<?php echo $item['soLuong']; ?>" /></td>
                            <td> <input type="text"  style="width: 100px;" readonly name="don_gias[<?php echo $i; ?>]" value="<?php echo $item['donGia']; ?>" /></td>
                            <td> <input type="text"  style="width: 100px;" readonly name="bao_hanhs[<?php echo $i; ?>]" value="<?php echo $item['baoHanh']; ?>" /></td>

                            <td> <a href="<?php echo site_url("hoadon/nhap/edit/$i"); ?>" class="btn"><i class="icon-edit"></i></a></td><td><a href="<?php echo site_url("hoadon/nhap/del/$i"); ?>" onClick = "return confirm('Are you sure you want delete');" ><i class="icon-remove"></a></i></td>


                        </tr>
                        <?php
                    }
                }
                ?>


            </table>
        </div>
       <div style=" text-align:center"><input class="btn btn-success" type="submit" value="<?php if ($this->session->userdata('idHoaDonSua'))
                { ?> Cập nhật hoá đơn <?php } else { ?>Tạo hoá đơn <?php } ?>" name="btnOK" ></div>
        <?php  echo form_close(); ?>
        <div class="container-box">

            <!--Ba cột-->
            <?php echo form_open("hoadon/nhap/addThietBi"); ?>
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
                        <input type="text" name="so_luong" autocomplete="off" />
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
                        <input type="text" name="don_gia" autocomplete="off" />
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
            <input type="submit" value= "Thêm Thiết Bị" name ="btnThemThietBiNhap" class="btn btn-success">

        </div>
        <?php echo form_close(); ?>
    </div>

</div>

</div>