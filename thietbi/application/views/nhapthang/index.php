<?php
    echo form_open('nhap', array("name" => "thietbi"));
    
    function list_option($ds){
        foreach ($ds as $item){
            echo '<option value="' . $item['id'] . '">' . $item['ten'] . '</option>';
        }
    }
?>
<fieldset>
<div>
    <table>
        <tr>
            <td><label>Số hóa đơn</label></td>
            <td><input type="text" name="so_hd" id="so_hd" onkeypress="onlyNumber(event)" /></td>
            <td><label>Nhà cung cấp</label></td>
            <td>
                <select name="nha_cung_cap" id="nha_cung_cap">
                    <?php list_option($ds_nha_cung_cap); ?>
                </select>
            </td>
        </tr>
        <tr>
            <td><label>Đơn vị nhận</label></td>
            <td>
                <select id="don_vi_nhan">
                    <?php
                        list_option($ds_don_vi);
                    ?>
                </select>
            </td>
            <td><label>Khu nhà</label></td>
            <td>
                <select id="khu_nha">
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
                <select id="nguon_von">
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
</div>
</fieldset>
<fieldset>
<div>
    <div>
        <input type="hidden" id="ma" value="" />
        <table>
            <tr>
                <td><label>Tên thiết bị</label></td>
                <td>
                    <select id="ten">
                        <?php
                            list_option($ds_ten_thiet_bi);
                        ?>
                    </select>
                </td>
                <td><label>Quốc gia</label></td>
                <td>
                    <select id="qg">
                        <?php
                            foreach ($ds_quoc_gia as $item){
                                echo '<option value="' . $item['ma_qg'] . '">' . $item['qg'] . '</option>';
                            }
                        ?>
                    </select>
                </td>
                <td><label>Số lượng</label></td>
                <td>
                    <input type="text" name="so_luong" id="sl" onkeypress="onlyNumber(event)" />
                </td>
            </tr>
            <tr>
                <td><label>Số tháng bảo hành</label></td>
                <td>
                    <input type="text" name="bao_hanh" id="stbh" onkeypress="onlyNumber(event)" />
                </td>
                <td><label>Chi phí lắp đặt</label></td>
                <td>
                    <input type="text" name="lap_dat" id="cpld" onkeypress="onlyNumber(event)" />
                </td>
                <td><label>Chi phí vận chuyển</label></td>
                <td>
                    <input type="text" name="van_chuyen" id="cpvc" onkeypress="onlyNumber(event)" />
                </td>
            </tr>
            <tr>
                <td><label>Chi phí chạy thử</label></td>
                <td>
                    <input type="text" name="chay_thu" id="cpct" onkeypress="onlyNumber(event)" />
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
            <tr>
                <td></td>
                <td></td>
                <td colspan="2">
                    <input type="button" value="Thêm mới" id="add" />
                    <input type="button" value="Cập nhật" id="edit" />
                </td>
                <td></td>
            </tr>
        </table>
    </div>
    <div>
        <table id="customers" data="" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Tên thiết bị</th>
                    <th>Quốc gia</th>
                    <th>Số lượng</th>
                    <th>Số tháng bảo hành</th>
                    <th>Chi phí</th>
                    <th>Khấu hao</th>
                    <th>Đơn giá</th>
                    <th>Chức năng</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
</fieldset>
<div>
    <input type="button" id="hoantat" name="submit" value="Hoàn tất" style="width: auto; margin: auto;" />
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
            var txt ="{";
            var tbl = document.getElementById('customers');
            var ls = tbl.getElementsByTagName('tr');
            for (i = 1; i < ls.length; i++){
                var ds = ls[i].getElementsByTagName('td');
                var ten_ = ds[0].getAttribute("data");
                var qg_ = ds[1].getAttribute("data");
                var sl_ = ds[2].innerHTML;
                var stbh_ = ds[3].innerHTML;
                var cpld_ = ds[4].getAttribute("ld");
                var cpvc_ = ds[4].getAttribute("vc");
                var cpct_ = ds[4].getAttribute("ct");
                var kh_ = ds[5].innerHTML;
                var dg_ = ds[6].innerHTML;
                
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
    });
</script>