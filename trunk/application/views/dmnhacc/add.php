<form method="post" class="" action="" enctype="multipart/form-data">
    <div class="container-box">
        <div class="box-title">
            <h2><?php echo $title; ?></h2>
        </div>
        <div class="row-fluid">
            <div class="span6">
                <div class="control-group">
                    <label class="control-label fix-width">Nhà cung cấp</label>
                    <div class="controls fix-margin">
                        <input type="text" class="span10" name='ten'>
                    </div> 
                </div>  
            </div> 
            <div class="span6">
                <div class="control-group">
                    <label class="control-label fix-width">Điện thoại</label>
                    <div class="controls fix-margin">
                        <input type="text" class="span10" name='so_dien_thoai' />
                    </div> 
                </div>  
            </div> 
        </div>
        <div class="row-fluid">
            <div class="span6">
                <div class="control-group">
                    <label class="control-label fix-width">Email</label>
                    <div class="controls fix-margin">
                       <input type="text" class="span10" name='email' />
                    </div> 
                </div>  
            </div> 
            <div class="span6">
                <div class="control-group">
                    <label class="control-label fix-width">Địa chỉ</label>
                    <div class="controls fix-margin">
                        <input type="text" class="span10" name='dia_chi' />
                    </div> 
                </div>  
            </div> 
        </div>
        <div class="row-fluid">
             <div class="span6">
                <div class="control-group">
                    <label class="control-label fix-width">Quốc gia</label>
                    <div class="controls fix-margin">
                        <input type="text" class="span10" name='id_quoc_gia'/>
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