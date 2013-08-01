<?php
    echo form_open('import/importAction', array('name' => "importForm", 'method' => 'post', 'enctype' => "multipart/form-data"));
    echo form_fieldset();
?>
<!--<form enctype='multipart/form-data' action='importluong.php' method='post' >-->
<div class="container-box">
	<div class="box-title">
        	<h2>Import</h2>
    </div>
    <div class="row-fluid">
       <div class="span4 alert alert-info" style="height:120px; text-align:center">
       		<h4 style="margin-bottom:5px; text-align:center">Chọn file excel trong máy để Import</h4>
            <p style="padding-top:20px"><input type='file' name='myfile' id='chon'><p>
       </div>
       <div style="padding-top:50px; margin-right:-50px; float:left">
       		<i class="icon-chevron-right"></i>
       </div>
       <div class="span4 alert alert-success" style="height:120px">
            <h4 style="margin-bottom:5px; text-align:center">Tự động thêm</h4>
             <div class="row-fluid">
                <div class="span6">
                    <div class="checkbox">
                    <label>
                        <input type="checkbox" name="checkNhaCungCap" checked="TRUE"/> Nhà cung cấp
                    </label>
                    </div>
                    <div class="checkbox">
                    <label>
                        <input type="checkbox" name="checkKhuNha" /> Khu nhà
                    </label>
                    </div>
                    <div class="checkbox">
                    <label>
                        <input type="checkbox" name="checkNguonVon" /> Nguồn vốn
                    </label>
                    </div>
                </div>
                <div class="span6">
                    <div class="checkbox">
                    <label>
                        <input type="checkbox" name="checkLoaiThietBi" /> Loại thiết bị
                    </label>
                    </div>
                    <div class="checkbox">
                    <label>
                        <input type="checkbox" name="checkTenThietBi" /> Tên thiết bị
                    </label>
                    </div>
                    <div class="checkbox">
                    <label>
                        <input type="checkbox" name="checkQuocGia" /> Quốc gia
                    </label>
                    </div>
                </div>
           </div>
       </div>
       <div class="span4 alert alert-box" style="height:120px;">
       		<h4 align="center">Ghi chú</h4>
            <li>Hãy chắc chắn rằng nội dung của file excel bạn đưa vào là chính xác</li>
            <li>Bạn có thể tải mẫu Excel tại đây </li>
       </div>
    </div>
    <div class="button-box" style="text-align:center">
    	<input type='submit' name='btnsubmit' value='Import' class='btn btn-success' >
    </div>
</div>
<div>
    
<?php 
echo form_close();
?>
