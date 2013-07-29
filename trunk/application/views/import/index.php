<?php
    echo form_open('import/importAction', array('name' => "importForm", 'method' => 'post', 'enctype' => "multipart/form-data"));
    echo form_fieldset();
?>
<!--<form enctype='multipart/form-data' action='importluong.php' method='post' >-->
<div>
    Tự động thêm:
    <br>
    <div>
        Nhà cung cấp: <input type="checkbox" name="checkNhaCungCap" checked="TRUE"/>
    </div>      
    <div>
        Khu nhà: <input type="checkbox" name="checkKhuNha" />
    </div>
    <div>
        Nguồn vốn: <input type="checkbox" name="checkNguonVon" />
    </div>
    <div>
        Loai thiết bị: <input type="checkbox" name="checkLoaiThietBi" />
    </div>
    <div>
        Tên thiết bị: <input type="checkbox" name="checkTenThietBi" />
    </div>
    <div>
        Quốc gia: <input type="checkbox" name="checkQuocGia" />
    </div>   
</div>
<div style='background:#448ccb; height:25px; padding-top:5px; color:#fff;'><strong>Chọn file excel trong máy để Import:</strong></div>

<br><input type='file' name='myfile' id='chon'><br>

<input type='submit' name='btnsubmit' value='Import' class='nutimp1' ></form>
<?php 
echo form_close();
?>
