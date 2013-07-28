<?php
	if(!empty($datas))
	{	
		$id = $datas->id;
		$ten = $datas->ten;
		$trangthai = $datas->trang_thai;
		$mota = $datas->mo_ta;
	}
?>

<form method="post" class="form" action="" enctype="multipart/form-data">
    <input type='hidden' name='id' value="<?php echo $id; ?>">
    <div class="container-box">
        <div class="box-title bg-chosen">
            <h2><?php echo $title; ?></h2>
        </div>
        <div class="row-fluid"> 
            <div class="span6">
                <div class="control-group">
                    <label class="control-label fix-width">Tên khu nhà</label>
                    <div class="controls fix-margin">
                        <input type="text" class="span10" name='ten' value="<?php echo $ten; ?>"/>
                    </div> 
                </div>  
            </div> 
        </div>
        <div class="row-fluid">
            <div class="span6">
                <div class="control-group">
                    <label class="control-label fix-width">Trạng thái</label>
                    <div class="controls fix-margin">
                       <textarea class="span12" name='trang_thai' >
                       		<?php echo $trangthai; ?>
                        </textarea>
                    </div> 
                </div>  
            </div> 
            <div class="span6">
                <div class="control-group">
                    <label class="control-label fix-width">Mô tả</label>
                    <div class="controls fix-margin">
                        <textarea class="span12" name='mo_ta' >
                        	<?php echo $mota; ?>
                        </textarea>
                    </div> 
                </div>  
            </div> 
        </div> 
        <div class="button-box">
            <input class="btn btn-success" type="submit" name="submit" value="Cập nhật">
            <input type='button' class="btn btn-inverse" value='Hủy' onclick = 'removeFormEdit()'>
        </div>  				
    </div>
</form>

