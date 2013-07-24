<?php
    echo form_open('import/index', array('name' => "importForm", 'method' => 'post', 'enctype' => "multipart/form-data"));
    echo form_fieldset();
?>
<!--<form enctype='multipart/form-data' action='importluong.php' method='post' >-->

<div style='background:#448ccb; height:25px; padding-top:5px; color:#fff;'><strong>Chọn file excel trong máy để Import:</strong></div>

<br><input type='file' name='myfile' id='chon'><br>

<input type='submit' name='btnsubmit' value='Import' class='nutimp1' ></form>
<?php 
echo form_close();
?>
<div id="result">
</div>