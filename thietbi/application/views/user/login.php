<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Đăng nhập</title>
        <style type="text/css">
            .box{
                width: 250px;
                margin: auto;
                margin-top: 200px;
            }
            .sub_box{
                margin: 5px;
            }
            .error{
                color: red;
            }
        </style>
    </head>
    <body>
        <div class="box">
            <?php echo form_open('user/verifylogin'); ?>
            <div align="center">
                ĐĂNG NHẬP
            </div>
            <div class="sub_box">
                <label>Username</label>
                <input type="text" name="username" required="required" />
                <?php echo form_error('username', '<p class="error">', '</p>'); ?>
            </div>
            <div class="sub_box">
                <label>Password</label>
                <input type="password" name="password" required="required" />
                <?php echo form_error('password', '<p class="error">', '</p>'); ?>
            </div>
            <div class="sub_box">
                <input type="submit" name="submit" value="Đăng nhập" />
            </div>
            <?php echo form_close(); ?>
        </div>
    </body>
</html>