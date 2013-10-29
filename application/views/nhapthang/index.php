
<?php

    echo form_open('nhap', array("name" => "thietbi"));

    function list_option($ds){
        foreach ($ds as $item){
            echo '<option value="' . $item['id'] . '">' . $item['ten'] . '</option>';
        }
    }
?>
<div class="container-box">
<div class="box-title">
	<h2 align="left">Nhập thẳng</h2> 
</div>
    <table width="100%">
        <tr>
            <td><label>Số hóa đơn</label></td>
            <td><input type="text" name="so_hd" id="so_hd" onkeypress="onlyInteger(event)"/></td>
            <td><label>Nhà cung cấp</label></td>
            <td>
                <select name="nha_cung_cap" id="nha_cung_cap" chosen="">
                    <?php list_option($ds_nha_cung_cap); ?>
                </select>
            </td>
        </tr>
        <tr>
            <td><label>Đơn vị nhận</label></td>
            <td>
                <select id="don_vi_nhan" chosen="">
                    <?php
                       // list_option($ds_don_vi);
                        foreach ($ds_don_vi as $item){
                          echo '<option value="' . $item['ma_dv'] . '">' . $item['dv'] . '</option>';
                      }
                    ?>
                </select>
            </td>
            <td><label>Khu nhà</label></td>
            <td>
                <select id="khu_nha" chosen="">
                    <?php
                        foreach ($ds_khu_nha as $item){
                            echo '<option value="' . $item['id'] . '" tt="' . $item['trang_thai']
                            . '">' . $item['ten'] . '</option>';
                        }
                    ?>
                </select>
            </td>
        </tr>
        <tr id="change">
            <td><label>Nguồn vốn</label></td>
            <td>
                <select id="nguon_von" chosen="">
                    <?php
                        list_option($ds_nguon_von);
                    ?>
                </select>
            </td>
            <?php
            if (count($ds_khu_nha) !=  0){
                    if ($ds_khu_nha[0]['trang_thai'] == 0){
            ?>
                        <td id="kh1"><label>Phòng</label></td>
                        <td id="kh2"><input type="text" name="phong" id="phong" /></td>
                <?php
                    }else{
                ?>
                        <td id="kh1"><label>Cho mượn</label></td>
                        <td id="kh2"><input type="checkbox" name="cho_muon" id="cho_muon" /></td>
                <?php
                    }
                }
                ?>

        </tr>
    </table>
    <div class="sub-box">
    	<input type="hidden" id="ma" value="" />
        <table width="100%">
            <tr>
                <td><label>Tên thiết bị</label></td>
                <td>
                    <select id="ten" chosen="">
                        <?php
                            list_option($ds_ten_thiet_bi);
                        ?>
                    </select>
                    <span class="btn btn-success" id="new" title="Thêm mới thiết bị"><i class="icon-plus"></i></span>
                </td>
                <td><label>Quốc gia</label></td>
                <td>
                    <select id="qg" chosen="">
                        <?php
                            foreach ($ds_quoc_gia as $item){
                                echo '<option value="' . $item['ma_qg'] . '">' . $item['qg'] . '</option>';
                            }
                        ?>
                    </select>
                </td>
                <td><label>Số lượng</label></td>
                <td>
                    <input type="text" name="so_luong" id="sl" onkeypress="onlyInteger(event)" />
                </td>
            </tr>
            <tr>
                <td><label>Chi phí lắp đặt</label></td>
                <td>
                    <input type="text" name="lap_dat" id="cpld" onkeypress="onlyNumber(event)" />
                </td>
                <td><label>Chi phí vận chuyển</label></td>
                <td>
                    <input type="text" name="van_chuyen" id="cpvc" onkeypress="onlyNumber(event)" />
                </td>
                <td><label>Chi phí chạy thử</label></td>
                <td>
                    <input type="text" name="chay_thu" id="cpct" onkeypress="onlyNumber(event)" />
                </td>
            </tr>
            <tr>
                <td><label>Số tháng bảo hành</label></td>
                <td>
                    <input type="text" name="bao_hanh" id="stbh" onkeypress="onlyNumber(event)" />
                </td>
                <td><label>Số năm khấu hao</label></td>
                <td>
                    <input type="text" name="khau_hao" id="kh" onkeypress="onlyNumber(event)" />
                </td>
                <td><label>Đơn giá</label></td>
                <td>
                    <input type="text" name="don_gia" id="dg" onkeypress="onlyNumber(event)" />
                </td>
            </tr>
           
        </table>
    </div>
	<div class="button-box">
    	 <input type="button" value="Thêm mới" class="btn btn-success" id="add" />
         <input type="button" value="Cập nhật" class="btn btn-success" id="edit" />
    </div>
</div>
        
        <table id="customers" data="" class="table table-dark-blue">
            <thead>
                <tr>
                    <th>Tên thiết bị</th>
                    <th>Quốc gia</th>
                    <th>Số lượng</th>
                    <th>Số tbh</th>
                    <th>Cpld</th>
                    <th>Cpvc</th>
                    <th>Cpct</th>
                    <th>Khấu hao</th>
                    <th>Đơn giá</th>
                    <th width="50px">Sửa</th>
                    <th width="50px">Xóa</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    <div align="center">
    <input type="button" id="hoantat" name="submit" value="Hoàn tất" class="btn btn-success" 
    style="width: auto; margin: auto;" />
    </div>
<?php
    echo form_close();
?>
<script type="text/javascript" src="<?php echo base_url('public/js/nhapthang.js'); ?>"></script>
<script type="text/javascript">
    $("document").ready(function(){
       $("#hoantat").click(function(){
            nhapThang("<?php echo base_url('index.php/nhapthang/add'); ?>", 
            "<?php echo base_url("index.php/nhapthang/"); ?>");
       });
       $('#them').click(function(){
            themTen("<?php echo base_url('index.php/nhapthang/addTenThietBi'); ?>");
       }); 
    });
</script>
<!-- Begin Modal-->
<div id="them_thiet_bi" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Thêm mới thiết bị</h3>
    </div>
    <div class="modal-body">
        <div class="row-fluid">
            <div class="span6">
                <div class="control-group">
                    <label class="control-label"><strong>Tên thiết bị</strong></label>
                    <div class="controls">
                        <input type="text" name="ten" id="ten_moi" />
                    </div>
                </div>
            </div>
            <div class="span6">
                <label class="control-label"><strong>Đơn vị tính</strong></label>
                <input type="text" name="don_vi_tinh" id="don_vi_tinh" />
            </div>
        </div>
        <hr />
        <label><strong>Loại thiết bị</strong></label>
        <div class="row-fluid">
            <div class="span6">
                <div class="control-group">
                    <label class="control-label">Đã có</label>
                    <div class="controls">
                    <?php
						$loai = array('' => '');
						foreach ($list_loai_thiet_bi as $item){
							$loai[$item['id']] = $item['ten'];
						}
						echo form_dropdown("loai_thiet_bi", $loai, null, 'id="loai" class="fix-height" chosen=""');
    				?>
                    </div>
                </div>
            </div>
            <div class="span6">
                <div class="control-group">
                    <label class="control-label">Chưa có</label>
                    <div class="controls">
                        <input type="text" name="loai_moi" id="loai_moi" />
                    </div>
                </div>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label"><strong>Ảnh của thiết bị</strong></label>
            <div class="controls">
                <iframe width="400px" src="<?php echo base_url('index.php/upload/'); ?>"></iframe>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <input type="button" class="btn btn-success" value="Thêm mới" name="them" 
        id="them" data-dismiss="modal" aria-hidden="true" />
        <button class="btn" data-dismiss="modal" aria-hidden="true" id="closePopup">Đóng</button>
    </div>
</div>
<!--End Modal-->