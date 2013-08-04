<?php
    echo form_open('search/index', array('name' => "timkiem", "id" => "timkiem"));
    echo form_fieldset();
?>
    <div class="container-box">
    	<div class="box-title">
        	<h2>Tìm kiếm theo thiết bị</h2>
        </div>
            <div class="form-horizontal">
                    <div class="row-fluid">
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label fix-width">Mã thiết bị</label>
                                <div class="controls fix-margin">
                                    <input type="text" class="fix-height" name="ma" onkeypress="onlyNumber(event)">
                                </div> 
                            </div>  
                        </div> 
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label fix-width">Trạng thái</label>
                                <div class="controls fix-margin">
                                    <select type="text" class="fix-height" name="tt" chosen="">
                                    	<option value=""></option>
                                        <option value="0">Chưa thanh lý</option>
                                        <option value="1">Đã thanh lý</option>
                                    </select>
                                </div>
                            </div>
                        </div> 
                   </div> 
                   <div class="row-fluid">
                        <div class="span12">
                            <div class="control-group">
                                <label class="control-label fix-width">Đơn vị quản lý</label>
                                <div class="controls fix-margin">
                                    <?php
										$don_vi = array('' => 'Tất cả các đơn vị quản lý');
										foreach($list_don_vi as $item){
											$don_vi[$item['id']] = $item['ten'];
										}
										echo form_dropdown("don_vi", $don_vi, null, 'class="fix-height" id="don_vi" chosen=""');
									?>
                                </div>
                            </div>
                        </div>    
                    </div> 
                    <div class="row-fluid">
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label fix-width">Tên thiết bị</label>
                                <div class="controls fix-margin">
                                    <select name="ten" id="ten" class="fix-height" chosen="">
                                        <option value="" loai="first"></option>
                                        <?php
                                            foreach ($list_ten_thiet_bi as $item){
                                                echo '<option value="'.$item['id'].'" loai="'.$item['id_loai_thiet_bi'] 
                                                .'">' . $item['ten'] . '</option>';
                                            }
                                        ?>
                                    </select>        
                                </div>
                            </div>
                        </div>  
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label fix-width">Loại thiết bị</label>
                                <div class="controls fix-margin">
                                    <?php
										$loai = array('' => '');
										foreach ($list_loai_thiet_bi as $item){
											$loai[$item['id']] = $item['ten'];
										}
										echo form_dropdown("loai_thiet_bi", $loai, null, 'class="fix-height" id="loai" chosen=""');
									?>
                                </div>
                            </div>
                        </div>  
                        <div class="span4">
                            <div class="span6">
                                <div class="control-group">
                                    <label class="control-label fix-width">Từ năm</label>
                                    <div class="controls fix-margin">
                                        <select name="tu" id="tu" class="fix-height" style="width:70px">
                                            <option value=""></option>
                                            <?php
                                                $year = (int) date('Y');
                                                for ($i = $year; $i > 2003; $i--){
                                                    echo '<option value="' . $i . '">' . $i . '</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>  
                            <div class="span3">
                                <div class="control-group">
                                    <label class="control-label" style="width:60px;">Đến năm</label>
                                    <div class="controls" style="margin-left:70px;">
                                        <select name="den" id="den" class="fix-height" style="width:70px">
                                            <option value=""></option>
                                            <?php
                                                for ($i = $year; $i > 2003; $i--){
                                                    echo '<option value="' . $i . '">' . $i . '</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                               </div>
                            </div>   
                        </div>
                    </div>
                    <div class="row-fluid">
                         <div class="span4">
                            <div class="control-group">
                                <label class="control-label fix-width">Phòng</label>
                                <div class="controls fix-margin">
                                    <input type="text" name="phong" class="fix-height" >
                                </div>
                            </div>
                        </div>   
                         <div class="span4">
                            <div class="control-group">
                                <label class="control-label fix-width">Khu nhà</label>
                                <div class="controls fix-margin">
                                    <?php
										$khu_nha = array('' => 'Tất cả các khu nhà');
										foreach($list_khu_nha as $item){
											$khu_nha[$item['id']] = $item['ten'];
										}
										echo form_dropdown("khu_nha", $khu_nha, null, 'class="fix-height" id="khu_nha" chosen=""');
									?>
                                </div>
                            </div>
                        </div> 
                   </div>      
           </div>
           <div class="button-box">
                <button class="btn btn-success" type="submit" name="submit">Tìm kiếm</button>
           </div>
    </div>
<?php
    echo form_fieldset_close();
    echo form_close();
?>
    <!--Bảng-->
            <div class="table-box">
                <?php
					if (isset($list_thiet_bi) && count($list_thiet_bi) > 0){
				?>
            <div class="table-box-title">

                <div style="float:left">
                	<h3><i class=" icon-chevron-right">&nbsp;</i>&nbsp;Danh sách thiết bị</h3>
                </div>
                <div style="float:right">
                	Tổng số thiết bị: <font color="#42515f"><strong><?php echo count($list_thiet_bi); ?></strong></font>
                    <span></span>
                	<a href='<?php echo site_url(); ?>/export'>
                	<button type="button" class="btn btn-small btn-info" ><i class="icon-list-alt icon-white"></i> Xuất</button>
                    </a>
                </div>
                <div class="clear"></div>
            </div>
            <table id="customers" class="table table-striped table-dark-blue ">
                <thead>
                    <tr>
                        <th width="40px">STT</th>
                        <th width="90px">Mã thiết bị</th>
                        <th>Tên thiết bị</th>
                        <th>Đơn vị quản lý</th>
                        <th>Phòng</th>
                        <th>Khu nhà</th>
                        <th width="120px">Ngày sử dụng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $index = 0; 
                        foreach($list_thiet_bi as $thiet_bi){
                            $index++;
                    ?>
                        <tr>
                            <td><?php echo $index; ?></td>
                            <td><?php echo $thiet_bi['id']; ?></td>
                            <td>
                                <a target="_blank" href="<?php echo base_url('index.php/search/detail/' . $thiet_bi['id']); ?>">
                                    <?php echo $thiet_bi['ten']; ?>
                                </a>
                            </td>
                            <td><?php echo $thiet_bi['don_vi']; ?></td>
                            <td><?php echo $thiet_bi['phong']; ?></td>
                            <td><?php echo $thiet_bi['khu_nha']; ?></td>
                            <td><?php echo $thiet_bi['ngay_su_dung']; ?></td>
                        </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        <?php
            }else if(!isset($is_first)){
                echo '<p style="color:red;">No matches were found</p>';
            }
        ?>
            </div>     
    <!-- Begin script -->
    <script type="text/javascript" src="<?php echo base_url('public/js/nhapthang.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('public/js/search.js'); ?>"></script>
    <script type="text/javascript">
        $('document').ready(function(){
            $('[chosen]').select2();

	   });
        $(document).ready(function(){
     	$('#loai').change(function(){
     		$('#ten option:gt(0)').remove();
    
     		var loaithietbi_ID = $('#loai').val();
    		// alert("<?php echo site_url('ajax/getListThietBiByIDLoai/'); ?>/"+loaithietbi_ID);
    		$.ajax({
    			type: "GET",
    			url: "<?php echo site_url('ajax/getListThietBiByIDLoai/'); ?>/"+loaithietbi_ID,
    			dataType: "json",
    			success: function(data)
    			{
    
    				$.each(data,function(id,ten)
    				{
    					$('#ten').append($("<option></option>")
    						.attr("value", id) .text(ten));
    				});
    			},
    			error: function(error){
    				console.log(error);
    			}
    
    		});
    
    	});
     });
    </script>
    <!-- End script -->