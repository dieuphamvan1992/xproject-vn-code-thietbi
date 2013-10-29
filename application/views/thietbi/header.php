<div class="header">
 <div class="header-box">
   <a href="#"><img src="<?php echo base_url(); ?>public/images/logo.png"/></a>
   <div class="top-menu ">
    <ul class="menu-list">
     <li class="list-item">
       <i class="icon-search icon-white"></i>
       Tìm kiếm
       <div class="dropdown">
        <!-- Link or button to toggle dropdown -->
        <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
          <li><a tabindex="-1" href="<?php echo site_url('search/index2') ?>">Tìm kiếm theo lô</a></li>
          <li><a tabindex="-1" href="<?php echo site_url('search') ?>">Tìm kiếm theo thiết bị</a></li>
        </ul>
      </div>
    </li>
    <?php
    if (($this->role > 0) && ($this->role <= 3))
    {
      ?>
      <li class="list-item">
       <i class="icon-list-alt icon-white"></i>
       Hoá đơn
       <div class="dropdown">
        <!-- Link or button to toggle dropdown -->
        <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
          <li><a tabindex="-1" href="<?php echo site_url('hoadon/nhap') ?>">Tạo hoá đơn nhập</a></li>
          <li><a tabindex="-1" href="<?php echo site_url('hoadon/xuat') ?>">Tạo hoá đơn xuất</a></li>
          <li><a tabindex="-1" href="<?php echo site_url('nhapthang') ?>">Nhập thẳng</a></li>
          <li class="divider"></li>
          <li><a tabindex="-1" href="<?php echo site_url('hoadon/quanlynhap') ?>">Quản lý hoá đơn nhập</a></li>
          <li><a tabindex="-1" href="<?php echo site_url('hoadon/quanlyxuat') ?>">Quản lý hoá đơn xuất</a></li>


        </ul>
      </div>
    </li>
    <?php   } ?>
    <?php
    if (($this->role > 0) && ($this->role <= 3))
    {
      ?>
      <li class="list-item">
       <i class=" icon-wrench icon-white"></i>
       Quản lý
       <div class="dropdown">
        <!-- Link or button to toggle dropdown -->
        <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
          <li><a tabindex="-1" href="<?php echo site_url('bangdm') ?>">Quản lý bảng danh mục</a></li>
          <li><a tabindex="-1" href="<?php echo site_url('users/manage') ?>">Quản lý người dùng</a></li>
          <li><a tabindex="-1" href="<?php echo site_url('import') ?>">Import dữ liệu</a></li>
        </ul>
      </div>
    </li>
    <?php   } ?>
    <li class="list-item">
     <i class=" icon-list-alt icon-white"></i>
     Xuất báo cáo
     <div class="dropdown">
      <!-- Link or button to toggle dropdown -->
      <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
        <li><a  href="<?php echo site_url('pdcthietbi') ?>">Điều chuyển thiết bi</a></li>
        <li><a href="<?php echo site_url('') ?>">Nhật ký sử dụng tài sản</a></li>
      </ul>
    </div>
  </li>
  <?php
  if (($this->role > 0) && ($this->role <= 3))
  {
    ?>
    <li class="list-item">
     <i class=" icon-align-justify icon-white"></i>
     Xem lịch sử
     <div class="dropdown">
      <!-- Link or button to toggle dropdown -->
      <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
        <li><a  href="<?php echo site_url('nhapthang/viewlog') ?>">Lịch sử nhập thẳng</a></li>
        <li><a href="<?php echo site_url('import/viewLogImport') ?>">Lịch sử import</a></li>
      </ul>
    </div>
  </li>
  <?php } ?>



</ul>
<a href="<?php echo site_url("users/login/logOut"); ?>">
 <li style="float:right; margin-right:10px; color:#FFF; list-style:none">
   <i class="icon-cog icon-white"></i>
   Thoát
 </li>
</a>
</div>
</div>
</div>