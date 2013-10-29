<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="<?php echo base_url();?>public/css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="header">
<div class="logo-header">
		<img src="<?php echo base_url();?>public/images/logo.png" width="148" height="82" />
    </div>
</div>
<div class="login-box">
    <div class="title">
    	<h2>Đăng nhập <font size="-1"><i>(Quản trị hệ thống)</i></font></h2>
    </div>
    <?php
			echo form_open("users/login/doLogin");
	?>
    <div class="login-element">
          <ul>
          <label for="user">Tài khoản</label>
          <input type="text" name="username" value="<?php echo set_value('username');?>"/>
          <?php echo form_error('username', '<p class="thongbao">', '</p>'); ?>
          </ul>
          <ul>
          <label for="password">Mật khẩu</label>
          <input type="password" name="password" value="<?php echo set_value('password');?>" />
          <?php echo form_error('password', '<p class="thongbao">', '</p>'); ?>
          </ul>
          <ul class="thongbao">
              <?php if ($this->session->flashdata('error'))
			echo $this->session->flashdata('error');
		 ?>
          </ul>
    </div>
    <div class="button-box">
   	    	<button class="button" type="submit" name="btnOK" value="Login">Đăng nhập</button>
    </div>
	<?php
				echo form_close();
			?>
</div>
<p>&nbsp;</p>
</body>
</html>





