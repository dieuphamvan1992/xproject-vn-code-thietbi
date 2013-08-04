<?php
		echo form_open('search/index2', array('name' => 'timkiem', 'id' => 'timkiem'));
		echo form_fieldset();
	?>
<div class="container-box">
	<div class="box-title">
    	<h2>Tìm kiếm theo lô</h2>
    </div>
    
	<div class="form-horizontal">
    	<div class="row-fluid">
            <div class="span4">
                <div class="control-group">
                    <label class="control-label fix-width">Số hóa đơn nhập</label>
                    <div class="controls fix-margin">
                        <input type="text" class="fix-height" name="shdn" id="shdn" />
                    </div> 
                </div>  
            </div> 
            <div class="span4">
                <div class="control-group">
                    <label class="control-label fix-width">Số hóa đơn xuất</label>
                    <div class="controls fix-margin">
                        <input type="text" class="fix-height" name="shdx" id="shdx" />
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
                        echo form_dropdown("khu_nha", $khu_nha, null, ' chosen=""');
                    ?>
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
                            echo form_dropdown("don_vi", $don_vi, null, ' chosen=""');
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
                        <select name="ten" id="ten" chosen="">
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
								echo form_dropdown("loai_thiet_bi", $loai, null, 'id="loai" chosen=""');
            				?>
                      </div>
                </div>
            </div>  
            <div class="span4">
                <div class="control-group">
                    <label class="control-label fix-width">Trạng thái</label>
                    <div class="controls fix-margin">
                        <select name="tt" id="tt" chosen="">
                            <option value=""></option>
                            <option value="0">Chưa thanh lý</option>
                            <option value="1">Đã thanh lý</option>
                    	</select>
                    </div>
                </div>
            </div>
       </div>
       <div class="row-fluid">
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
        <div class="button-box">
            <button class="btn btn-success" type="submit" name="submit">Tìm kiếm</button>
        </div>
    </div>
</div>

<div class="table-box">
	 <?php
        	if (isset($list_thiet_bi) && count($list_thiet_bi) > 0){
    	?>
	<div class="table-box-title">
        <div style="float:left">
            <h3><i class=" icon-chevron-right">&nbsp;</i>&nbsp;Danh sách lô thiết bị</h3>
        </div>
        <div style="float:right">
            Tổng số thiết bị: <font color="#42515f"><strong><?php echo count($list_thiet_bi); ?></strong></font>
            <span></span>
            <a href='<?php echo site_url(); ?>/export/batch'>
            <button type="button" class="btn btn-small btn-info" ><i class="icon-list-alt icon-white"></i> Xuất</button>
            </a>
            
        </div>
        <div class="clear"></div>
    </div>

        <table class="table table-striped table-dark-blue " id="customers">
            <thead>
                <tr>
                    <th width="40px">STT</th>
                    <th width="90px">Mã thiết bị</th>
                    <th>Tên thiết bị</th>
                    <th width="70px">Số lượng</th>
                    <th>Đơn vị</th>
                    <th width="90px">Số h/đ xuất</th>
                    <th>Loại thiết bị</th>
                    <th width="90px">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $index = 0;
                    foreach ($list_thiet_bi as $item){
                        $index++;
                ?>
                <tr>
                    <td><?php echo $index; ?></td>
                    <td><?php echo $item['MIN(thiet_bi_su_dung.id)'].' - '.$item['MAX(thiet_bi_su_dung.id)']; ?></td>
                    <td><?php echo $item['ten']; ?></td>
                    <td><?php echo $item['COUNT(thiet_bi_su_dung.id)']; ?></td>
                    <td><?php echo $item['don_vi']; ?></td>
                    <td><?php echo $item['so_hoa_don']; ?></td>
                    <td><?php echo $item['loai']; ?></td>
                    <td>
                        <a target="_blank" href="<?php echo base_url('index.php/search/view/' . $item['id_chi_tiet_xuat']); ?>">
                            <span class="btn">Chi tiết</span>
                        </a>
                    </td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    <?php     
        }else if (!isset($is_first)){
            echo '<p style="color:red;">No matches were found</p>';
        }
        $hdn = $hdx = '';
        foreach ($ds_hdn as $item){
            $hdn = $hdn . '"' . $item['so_hoa_don'] . '"' . ',';
        }
        foreach ($ds_hdx as $item){
            $hdx = $hdx . '"' . $item['so_hoa_don'] . '"' . ',';
        }
        $hdn = $hdn . '" "';
        $hdx = $hdx . '" "';
    ?>
</div>
<!-- Begin script -->
<script type="text/javascript" src="<?php echo base_url('public/js/search.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('public/js/jquery-ui.js'); ?>"></script>
<script type="text/javascript">
    $('document').ready(function(){
            $('[chosen]').select2();
            var temp_n = [<?php echo $hdn; ?>];
            var temp_x = [<?php echo $hdx; ?>];
            $('#shdn').autocomplete({
                source: temp_n
            });
            $('#shdx').autocomplete({
               source: temp_x 
            });
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