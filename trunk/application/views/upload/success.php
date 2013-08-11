<html>
<head>
<title>Upload Form</title>
</head>
<body>
<?php
    $size = changeImage($upload_data['image_width'], $upload_data['image_height']);
?>
<img src="<?php echo base_url("upload/img/". $upload_data['file_name']); ?>" width="<?php echo $size['width'] ?>px" 
height="<?php echo $size['height']; ?>px" />

<p>
    <?php echo anchor('upload', 'Upload ảnh khác!'); ?>
    &nbsp;&nbsp;
    <?php echo anchor('upload/remove', 'Hủy bỏ'); ?>
</p>

</body>
</html>