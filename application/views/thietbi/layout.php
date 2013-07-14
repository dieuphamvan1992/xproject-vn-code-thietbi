<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?php echo $title; ?></title>

    <link href='<?php echo base_url(); ?>public/css/abc.css' rel="stylesheet" type="text/css" />
    

    <link href='<?php echo base_url(); ?>public/bootstrap/css/bootstrap.min.css' rel="stylesheet" type="text/css" />
    <link href='<?php echo base_url(); ?>public/bootstrap/css/bootstrap-responsive.min.css' rel="stylesheet" type="text/css" />
    <link href='<?php echo base_url(); ?>public/select2/select2.css' rel="stylesheet" type="text/css" />
    <link href='<?php echo base_url(); ?>public/css/styles.css' rel="stylesheet" type="text/css" />

    <script src="<?php echo base_url(); ?>public/js/jquery.js" type="text/javascript"> </script>

    <script src="<?php echo base_url(); ?>public/bootstrap/js/bootstrap.js" type="text/javascript"> </script>
    <script src="<?php echo base_url(); ?>public/select2/select2.min.js" type="text/javascript"> </script>
</head>

<body>
    <img id="anhlogo" src="<?php echo base_url(); ?>public/images/logo.png" width="120" height="180" /><!--header-->
    <div id="header">

        <?php $this->load->view("thietbi/header");?>

    </div>


    <div class="page">

        <?php $this->load->view($template,$data);?>
    </div>
</body>
</html>
