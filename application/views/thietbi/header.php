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
                    	<li class="list-item">
                        	<i class="icon-list-alt icon-white"></i>
                    		 Hoá đơn
                           <div class="dropdown">
                              <!-- Link or button to toggle dropdown -->
                              <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                <li><a tabindex="-1" href="<?php echo site_url('hoadonnhap') ?>">Tạo hoá đơn nhập</a></li>
                                <li><a tabindex="-1" href="<?php echo site_url('hoadonxuat') ?>">Tạo hoá đơn xuất</a></li>
                                <li><a tabindex="-1" href="<?php echo site_url('nhapthang') ?>">Nhập thẳng</a></li>
                                <!--<li class="divider"></li>
                                <li><a tabindex="-1" href="#">Separated link</a></li>-->
                              </ul>
                            </div>
                    	</li>
                        <li class="list-item">
                        	<i class=" icon-wrench icon-white"></i>
                    		Quản lý
                              <div class="dropdown">
                              <!-- Link or button to toggle dropdown -->
                              <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                <li><a tabindex="-1" href="<?php echo site_url('bangdm') ?>">Quản lý bảng danh mục</a></li>
                                <li><a tabindex="-1" href="<?php echo site_url('') ?>">Quản lý người dùng</a></li>
                                <li><a tabindex="-1" href="<?php echo site_url('import') ?>">Import dữ liệu</a></li>
                              </ul>
                            </div>
                    	</li>
                        <li class="list-item">
                        	<i class=" icon-wrench icon-white"></i>
                    		Xem lịch sử
                              <div class="dropdown">
                              <!-- Link or button to toggle dropdown -->
                              <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                <li><a  href="<?php echo site_url('nhapthang/viewlog') ?>">Lịch sử nhập thẳng</a></li>
                                <li><a href="<?php echo site_url('') ?>">Lịch sử import</a></li>
                              </ul>
                            </div>
                    	</li>
                        
                    	
                    
                </ul>
                <a href="#">
                    	<li style="float:right; margin-right:10px; color:#FFF; list-style:none">
                        	<i class="icon-cog icon-white"></i>
                    		Thoát
                    	</li>
                    </a>
          </div>
        </div>
     </div>