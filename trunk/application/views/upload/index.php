<html>
<head>
<title>Upload Form</title>
</head>
<body>

<?php echo $error;?>

<?php echo form_open_multipart('upload/do_upload');?>

<input type="file" name="userfile" size="20" class="" />

<br /><br />

<input type="submit" value="Upload" class="" />

</form>

</body>
</html>