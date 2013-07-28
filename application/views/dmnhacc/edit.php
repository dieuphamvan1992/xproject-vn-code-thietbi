<?php
	if(!empty($datas))
	{	
		$id = $datas->id;
		$ten = $datas->ten;
		$sdt = $datas->so_dien_thoai;
		$email = $datas->email;
		$diachi = $datas->dia_chi;
		$idquocgia = $datas->id_quoc_gia;
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
                    <label class="control-label fix-width">Nhà cung cấp</label>
                    <div class="controls fix-margin">
                        <input type="text" class="span10" name='ten' value="<?php echo $ten; ?>">
                    </div> 
                </div>  
            </div> 
            <div class="span6">
                <div class="control-group">
                    <label class="control-label fix-width">Điện thoại</label>
                    <div class="controls fix-margin">
                        <input type="text" class="span10" name='so_dien_thoai' value="<?php echo $sdt; ?>"/>
                    </div> 
                </div>  
            </div> 
        </div>
        <div class="row-fluid">
            <div class="span6">
                <div class="control-group">
                    <label class="control-label fix-width">Email</label>
                    <div class="controls fix-margin">
                       <input type="text" class="span10" name='email' value="<?php echo $email; ?>"/>
                    </div> 
                </div>  
            </div> 
            <div class="span6">
                <div class="control-group">
                    <label class="control-label fix-width">Địa chỉ</label>
                    <div class="controls fix-margin">
                        <input type="text" class="span10" name='dia_chi' value="<?php echo $diachi; ?>"/>
                    </div> 
                </div>  
            </div> 
        </div>
        <div class="row-fluid">
             <div class="span6">
                <div class="control-group">
                    <label class="control-label fix-width">Quốc gia</label>
                    <div class="controls fix-margin">
                        <select name='id_quoc_gia' class="span10">
                            <option value=0><?php echo "---Chọn quốc gia ---" ?></option>
                            <?php
                            foreach ($quocgia as $key => $value) {
                                ?>
                                <option <?php if ($idquocgia == $value['ma_qg']) echo "selected='selected'" ?> value="<?php echo $value['ma_qg'] ?>"><?php echo $value['qg']; ?></option>
                                <?php
                            }
                            ?>	
                        </select>
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
