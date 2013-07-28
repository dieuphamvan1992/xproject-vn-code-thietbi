<form method="post" class="" action="" enctype="multipart/form-data">
<div class="container-box">
	<div class="box-title">
    	<h2><?php echo $title; ?></h2>
    </div>
    <div class="row-fluid">
    	<div class="span6">
            <div class="control-group">
                <label class="control-label fix-width">Mã khu nhà</label>
                <div class="controls fix-margin">
                    <input type="text" class="span10" name='ma'>
                </div> 
            </div>  
        </div> 
       
    </div>
    <div class="row-fluid">
        <div class="span6">
            <div class="control-group">
                <label class="control-label fix-width">Trạng thái</label>
                <div class="controls fix-margin">
                   <textarea class="span12" name='trang_thai'>
                    </textarea>
                </div> 
            </div>  
        </div> 
        <div class="span6">
            <div class="control-group">
                <label class="control-label fix-width">Mô tả</label>
                <div class="controls fix-margin">
                    <textarea class="span12" name='mo_ta'>
                    </textarea>
                </div> 
            </div>  
        </div> 
    </div> 
    <div class="button-box">
    	<input class="btn btn-success" type="submit" name="submit" value="Thêm">
		<input type='button' class="btn btn-inverse" value='Hủy' onclick = 'removeFormEdit()'>
    </div>  				
</div>
</form>