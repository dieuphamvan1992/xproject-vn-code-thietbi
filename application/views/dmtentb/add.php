<form method="post" class="" action="" enctype="multipart/form-data">
    <div class="container-box">
        <div class="box-title">
            <h2><?php echo $title; ?></h2>
        </div>
        <div class="row-fluid">
            <div class="span6">
                <div class="control-group">
                    <label class="control-label fix-width">Thiết bị</label>
                    <div class="controls fix-margin">
                        <input type="text" class="span10" name='ten'>
                    </div> 
                </div>  
            </div> 
            <div class="span6">
                <div class="control-group">
                    <label class="control-label fix-width">Ảnh</label>
                    <div class="controls fix-margin">
                        <input type="text" class="span10" name='anh'/>
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
										<option value="<?php echo $value['id'] ?>"><?php echo $value['ten']; ?></option>
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
                        <input type="text" class="span10" name='don_vi_tinh'"/>
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
            <input class="btn btn-success" type="submit" name="submit" value="Cập nhật">
            <input type='button' class="btn btn-inverse" value='Hủy' onclick = 'removeFormEdit()'>
        </div>  				
    </div>
</form>