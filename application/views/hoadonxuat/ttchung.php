<script>
$(function() {
  $( "#ngayThucHien" ).datepicker({
    dateFormat: 'dd-mm-yy'
});
});
</script>
<script>
$(document).ready(function() {

  $("#donvinhan").select2();
  $("#nguonvon").select2();
  $("#nhacungcap").select2();

});
</script>
<?php
echo form_open('hoadon/xuat/doCreate');
?>
<div class="box-show" style="background:#f0f0f0">
	<span class="box-show-icon" >
		<i class="icon-chevron-down"></i>
	</span>
    Thông tin chung hóa đơn
    <div class="box-show-content"  style="background:#f0f0f0">
    	<table width="100%">
           <tr>
               <td>Số hóa đơn</td>
               <td><input type="text" name = "so_hoa_don" value="" /></td>
               <td>Ngày thực hiện</td>
               <td><input type="text" id="ngayThucHien" name = "ngay_thuc_hien" value="<?php echo set_value('ngay_thuc_hien', $today); ?>" /></td>
               <td>Cán bộ thực hiện</td>
               <td><input type="text" name="id_can_bo_thuc_hien"  /></td>

           </tr>
           <tr>

               <td>Đơn vị nhận</td>
               <td>
                <select name="don_vi_nhan" id="donvinhan">
                  <option value=""></option>
                  <?php
                  foreach ($list_donvi as $item) {

                      echo "<option value = " . $item['ma_dv'] . ">" . $item['dv'] . "</option>";
              }
              ?>
          </select>
          </td>
          <td>Khu nhà</td>
          <td><input type="text" name="khu_nha" /></td>
          <td>Phòng</td>
          <td><input type="text" name="phong"  /></td>
      </tr>
      <tr>
       <td>Nguồn vốn</td>
       <td><select name="nguon_von" id="nguonvon">
        <option value=""></option>
        <?php
        foreach ($list_nguonvon as $item) {

          echo "<option value = " . $item['id'] . ">" . $item['ten'] . "</option>";
      }
      ?>

    </select></td>
   </tr>
</table>
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

                    <th>Đơn giá</th>
                    <th>Số lượng</th>
                    <th>Số lượng xuất</th>
                    <th>Chi phí lắp đặt</th>
                    <th>Chi phí vận chuyển</th>
                    <th>Chi phí chạy thử</th>

                </tr>
                <?php

                if (!empty($list_chitietnhap)) {
            //    var_dump($xuat);
                    foreach ($list_chitietnhap as $key => $item) {
                        $i = $item['id'];
                        if (empty($item))
                            continue;
                        ?>

                        <tr>
                                <input type="hidden" name="id_thiet_bis[<?php echo $i; ?>]" value="<?php echo $item['id_ten_thiet_bi']; ?>" >
                            <td> <input type="text" style="width: 150px;" readonly name="ten_thiet_bis[<?php echo $i; ?>]" value="<?php echo $item['ten_thiet_bi']; ?>" /></td>
                            <td> <input type="text"  style="width: 100px;" readonly name="don_gias[<?php echo $i; ?>]" value="<?php echo number_format($item['don_gia']); ?>" /></td>
                            <td> <input type="text" style="width: 100px;" readonly name="so_luong_cons[<?php echo $i; ?>]" value="<?php echo $item['so_luong_con']; ?>" /></td>
                            <td> <input type="text" name="so_luong_xuats[<?php echo $i; ?>]" value="<?php echo $item['so_luong_con']; ?>" placeholder="0" style="width: 100px;"></td>
                            <td> <input type="text" name="lap_dats[<?php echo $i; ?>]" value="" placeholder="0" style="width: 100px;"></td>
                            <td> <input type="text" name="van_chuyens[<?php echo $i; ?>]" value="" placeholder="0" style="width: 100px;"></td>
                            <td> <input type="text" name="chay_thus[<?php echo $i; ?>]" value="" placeholder="0" style="width: 100px;"></td>

                        </tr>
                        <?php
                    }
                }
                ?>


            </table>
        </div>
        <div style=" text-align:center"><input class="btn btn-success" type="submit" value="Tạo hoá đơn xuất" name="btnOK" ></div>

        <?php  echo form_close(); ?>
    </div>
</div>