<?php
	if(!empty($datas))
	{	
		$id = $datas->id;
		$ten = $datas->ten;
		$anh = $datas->anh;
		$idloaitb = $datas->id_loai_thiet_bi;
		$donvitinh = $datas->don_vi_tinh;
		$trangthai = $datas->trang_thai;
		$mota = $datas->mo_ta;
	}
?>
<div id='formedit'>
	<form method="post" class="form" action="" enctype="multipart/form-data">
    <input type='hidden' name='id' value="<?php echo $id; ?>">
    <div class="container-box">
        <div class="box-title bg-chosen">
            <h2><?php echo $title; ?></h2>
        </div>
        <div class="row-fluid">
            <div class="span6">
                <div class="control-group">
                    <label class="control-label fix-width">Thiết bị</label>
                    <div class="controls fix-margin">
                        <input type="text" class="span10" name='ten' value="<?php echo $ten; ?>">
                    </div> 
                </div>  
            </div> 
            <div class="span6">
                <div class="control-group">
                    <label class="control-label fix-width">Ảnh</label>
                    <div class="controls fix-margin">
                        <input type="text" class="span10" name='anh' value="<?php echo $anh; ?>"/>
                    </div> 
                </div>  
            </div> 
        </div>
        <div class="row-fluid">
            <div class="span6">
                <div class="control-group">
                    <label class="control-label fix-width">Loại</label>
                    <div class="controls fix-margin">
                        <select name='id_loai_thiet_bi' class="span10">
									<option value=0><?php echo "---Chọn loại thiết bị---"?></option>
									<?php 
										foreach ($listtb as $key => $value) {
									?>
										<option <?php if($idloaitb == $value['id']) echo "selected='selected'" ?> value="<?php echo $value['id'] ?>"><?php echo $value['ten']; ?></option>
									<?php
										}
									?>	
						</select>
                    </div> 
                </div>  
            </div> 
            <div class="span6">
                <div class="control-group">
                    <label class="control-label fix-width">Đơn vị tính</label>
                    <div class="controls fix-margin">
                        <input type="text" class="span10" name='don_vi_tinh' value="<?php echo $donvitinh; ?>"/>
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
                       		<?php echo $trangthai; ?>
                        </textarea>
                    </div> 
                </div>  
            </div> 
            <div class="span6">
                <div class="control-group">
                    <label class="control-label fix-width">Mô tả</label>
                    <div class="controls fix-margin">
                        <textarea class="span12" name='mo_ta'>
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
</div>
