<?php
		echo form_open('search/index2', array('name' => 'timkiem', 'id' => 'timkiem'));
		echo form_fieldset();
	?>
<div class="container-box">
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
                      <label class="control-label fix-width">Loại thiết bị</label>
                      <div class="controls fix-margin">
                          <?php
								$loai = array('' => '');
								foreach ($list_loai_thiet_bi as $item){
									$loai[$item['id']] = $item['ten'];
								}
								echo form_dropdown("loai_thiet_bi", $loai, null, 'id="loai" class="fix-height"');
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
                            echo form_dropdown("don_vi", $don_vi, null, 'class="fix-height"');
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
                        <input type="text" class="fix-height" name="phong" id="phong" />
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
                        echo form_dropdown("khu_nha", $khu_nha, null, 'class="fix-height"');
                    ?>
                    </div>
                </div>
            </div>  
            <div class="span4">
                <div class="control-group">
                    <label class="control-label fix-width">Trạng thái</label>
                    <div class="controls fix-margin">
                        <select name="tt" class="fix-height" id="tt">
                            <option value=""></option>
                            <option value="0">Chưa thanh lý</option>
                            <option>Đã thanh lý</option>
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
                            <select name="tu" id="tu" class="fix-height" style="width:50px">
                                <option value=""></option>
                                <?php
                                    $year = (int) date('Y');
                                    for ($i = $year; $i > $year - 10; $i--){
                                        echo '<option value="' . $i . '">' . $i . '</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>  
                <div class="span4">
                    <div class="control-group">
                        <label class="control-label" style="width:60px;">Đến năm</label>
                        <div class="controls" style="margin-left:70px;">
                            <select name="den" id="den" class="fix-height" style="width:50px">
                                <option value=""></option>
                                <?php
                                    for ($i = $year; $i > $year - 10; $i--){
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
        <h2 style="text-align: center;margin-top: 20px;margin-bottom: 30px;">Danh sách thiết bị</h2>
        <a href='<?php echo site_url(); ?>/export/batch'>Xuất</a>
        <table class="table table-striped table-dark-blue ">
            <thead>
                <tr>
                    <th width="40px">STT</th>
                    <th width="90px">Mã thiết bị</th>
                    <th>Tên thiết bị</th>
                    <th width="70px">Số lượng</th>
                    <th>Đơn vị</th>
                    <th width="90px">Số h/đ xuất</th>
                    <th>Loại thiết bị</th>
                    <th width="70px">Action</th>
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
    ?>
</div>
<!-- Begin script -->
<script type="text/javascript" src="<?php echo base_url('public/js/search.js'); ?>"></script>
<!-- End script -->