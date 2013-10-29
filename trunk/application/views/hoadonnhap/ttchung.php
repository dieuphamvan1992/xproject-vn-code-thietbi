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
 <?php
    if ($this->session->flashdata('error'))
    {
        ?>
        <div class="alert alert-error"><?php echo $this->session->flashdata('error'); ?></div>
        <?php
    }
    else
        if ($this->session->flashdata('success'))
    {
        ?>
        <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
        <?php
    }
?>
<div class="container-box">
    <div class="box-title">
        <h2>Tạo hóa đơn nhập</h2>
    </div>

   <div class="box-show">
     <span class="box-show-icon">
      <i class="icon-chevron-down"></i>
    </span>
    <strong>Thông tin chung hóa đơn</strong>
    <?php
    $soHoaDonX = "";
    $ngayThucHienX = $today;
    $nhaCungCapX = "";
    $canBoThucHienX = $this->session->userdata('idcanbo');
    $tenCanBoThucHienX = $this->session->userdata('username');
    $moTaX = "";
  
    if ($this->session->userdata('thongTinChungNhap'))
    {
      $thongTinChungNhap = $this->session->userdata('thongTinChungNhap');
      $soHoaDonX = $thongTinChungNhap['soHoaDon'];
      $ngayThucHienX = $thongTinChungNhap['ngayThucHien'];
      $nhaCungCapX = $thongTinChungNhap['nhaCungCap'];
      $canBoThucHienX = $thongTinChungNhap['canBoThucHien'];
      $tenCanBoThucHienX = $thongTinChungNhap['tenCanBoThucHien'];
      $moTaX = $thongTinChungNhap['moTa'];
    }
  
    ?>
    <?php echo form_open("hoadon/nhap/addTTC"); ?>
    <div class="box-show-content">
     <table width="100%">
       <tr>
         <td>Số hóa đơn</td>
         <td><input type="text" name="soHoaDon" autocomplete="off" value="<?php echo set_value('soHoaDon', $soHoaDonX); ?>" /> <?php echo form_error('soHoaDon', '<div class="error">', '</div>'); ?></td>
         <td>Ngày thực hiện</td>
         <td><input type="text" name="ngayThucHien" id = "ngayThucHien" value="<?php echo set_value('ngayThucHien', $ngayThucHienX); ?>" />
          <?php echo form_error('ngayThucHien', '<div class="error">', '</div>'); ?>
        </td>
  
        <td>Nhà cung cấp</td>
        <td><select name="nhaCungCap" id="nhacungcap">
          <option value=""></option>
          <?php
          foreach ($list_nhacungcap as $item) {
            if ($item['id'] == $nhaCungCapX)
             echo "<option value = " . $item['id'] . " selected>" . $item['ten'] . "</option>";
           else
            echo "<option value = " . $item['id'] . ">" . $item['ten'] . "</option>";
        }
        ?>
  
      </select>
      <?php echo form_error('nhaCungCap', '<div class="error">', '</div>'); ?>
    </td>
  </tr>
  <tr>
   <td>Cán bộ thực hiện</td>
   <td><input type="text" name="tenCanBoThucHien" readonly value="<?php echo set_value('tenCanBoThucHien', $tenCanBoThucHienX); ?>" />
    <input type="hidden" name="canBoThucHien" readonly value= "<?php echo $canBoThucHienX; ?>"></td>
   <td>Mô tả</td>
   <td><input type="text" name="moTa" value="<?php echo set_value('moTa',$moTaX); ?>" /></td>
  </tr>
  </table>
  <div style=" text-align:center"><input  class="btn btn-success" type="submit" value= "Lưu" name="btnOK" ></div>
  <?php echo form_close(); ?>
  </div>
  
  </div>
  <div class="box-hide">
      <span class="box-show-icon">
          <i class="icon-chevron-right"></i>
      </span>
    Thông tin chi tiết hóa đơn
  </div>
  
</div>