
<?php

    echo form_open('nhap', array("name" => "thietbi"));

    function list_option($ds){
        foreach ($ds as $item){
            echo '<option value="' . $item['id'] . '">' . $item['ten'] . '</option>';
        }
    }
?>
<div class="container-box">
    <table width="100%">
        <tr>
            <td><label>Số hóa đơn</label></td>
            <td><input type="text" name="so_hd" id="so_hd" onkeypress="onlyNumber(event)"/></td>
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
                        list_option($ds_don_vi);
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
    var index = 1;
    $(document).ready(function(){
       $("#add").click(function(){
            appendText(index);
            index++;
       });

       $("#edit").hide();

       $("#khu_nha").change(function(){
            changeKhuNha();
       });

       $("#edit").click(function(){
            editText();
       });

       $("#hoantat").click(function(){
            
            var tbl = document.getElementById('customers');
            var ls = tbl.getElementsByTagName('tr');
            var sl = 0;
            for (i = 1; i < ls.length; i++){
                var ds = ls[i].getElementsByTagName('td');
                var temp = ds[2].innerHTML;
                if (!isNaN(parseInt(temp))){
                    sl = sl + parseInt(temp);
                }
            }
            var str = "Bạn có chắc chắn với những thông tin trên?";
            if (sl > 100){
                str = str + "\n\nCảnh báo: Số lượng của thiết bị vượt quá 100!" +
                    "\n\nTổng số thiết bị: " + sl;
            }
            var test = confirm(str);
            if (test == false){
                return;
            }
            
            var txt ="{";
            var tbl = document.getElementById('customers');
            var ls = tbl.getElementsByTagName('tr');
            for (i = 1; i < ls.length; i++){
                var ds = ls[i].getElementsByTagName('td');
                var ten_ = ds[0].getAttribute("data");
                var qg_ = ds[1].getAttribute("data");
                var sl_ = ds[2].innerHTML;
                var stbh_ = ds[3].innerHTML;
                var cpld_ = ds[4].innerHTML;
                var cpvc_ = ds[5].innerHTML;
                var cpct_ = ds[6].innerHTML;
                var kh_ = ds[7].innerHTML;
                var dg_ = ds[8].innerHTML;

                txt = txt +
                    '"' + i + '"' + ':{' +
                    '"ten" : "' + ten_ + '", ' +
                    '"qg" : "' + qg_ + '", ' +
                    '"sl" : "' + sl_ + '", ' +
                    '"stbh" : "' + stbh_ + '", ' +
                    '"cpld" : "' + cpld_ + '", ' +
                    '"cpvc" : "' + cpvc_ + '", ' +
                    '"cpct" : "' + cpct_ + '", ' +
                    '"kh" : "' + kh_ + '", ' +
                    '"dg" : "' + dg_ + '"' +
                    "}";
                if (i != ls.length -1){
                    txt = txt + ", ";
                }
            }
            txt = txt + "}";
            var tt = 0;
            if ($("#cho_muon").is(':checked')){
                tt = 1;
            }

            $.post("<?php echo base_url('index.php/nhapthang/add'); ?>",
            {
                csrf_test_name : $("input[name='csrf_test_name']").val(),
                so_hd : $("#so_hd").val(),
                nha_cung_cap : $("#nha_cung_cap").val(),
                don_vi_nhan : $("#don_vi_nhan").val(),
                khu_nha : $("#khu_nha").val(),
                nguon_von : $("#nguon_von").val(),
                phong : $("#phong").val(),
                cho_muon : tt,
                thietbi : txt,
                submit : "ok"
            },
            function(data, status){
                alert("Data: " + data + "\nStatus: " + status);
                window.location.assign("<?php echo base_url("index.php/nhapthang/"); ?>");
            });
       });
       $('[chosen]').select2();
       $('#new').click(function(){
            $('#them_thiet_bi').modal('show');
       });
       $('#them').click(function(){
            $.post("<?php echo base_url('index.php/nhapthang/addTenThietBi'); ?>",
            {
                csrf_test_name : $("input[name='csrf_test_name']").val(),
                ten_thiet_bi : $('#ten_moi').val(),
                don_vi_tinh : $('#don_vi_tinh').val(),
                loai : $("#loai").val(),
                loai_moi : $('#loai_moi').val(),
                new_ten : "new"
            },
            function(data, status){
                if (status = 'success'){
                    var obj = eval ("(" + data + ")");
                    var ten = '<option value="'+obj.id_ten+'">'+$('#ten_moi').val()+'</option>';
                    $("#ten").append(ten);
                    if ($("#loai").find("option[value="+obj.id_loai+"]").val() == null){
                        var loai = '<option value="'+obj.id_loai+'">'+$('#loai_moi').val()+'</option>';
                        $('#loai').append(loai);
                    }
                }else{
                    alert("Data: " + data + "\nStatus: " + status);
                }
            });
       });
       $("#loai").click(function(){
            $("#loai_moi").val("");
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
    </div>
    <div class="modal-footer">
        <input type="button" class="btn btn-success" value="Thêm mới" name="them" 
        id="them" data-dismiss="modal" aria-hidden="true" />
        <button class="btn" data-dismiss="modal" aria-hidden="true" id="closePopup">Đóng</button>
    </div>
</div>
<!--End Modal-->