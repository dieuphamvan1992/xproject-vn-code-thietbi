    <?php
        echo form_open('search/detail/'.$thiet_bi['id']);
    ?>
<div class="container-box" >
    <div class="box-title">
        <h2>Chi tiết thiết bị sử dụng</h2>
    </div>
    <div class="table-box">
        <input type="hidden" name="id" value="<?php echo $thiet_bi['id']; ?>" />
        <table width="100%">
            <tr>
                <td width="140px">Mã thiết bị</td>
                <td><input type="text" value="<?php echo $thiet_bi['id']; ?>" class="uneditable-input" /></td>
                <td width="140px">Tên thiết bị</td>
                <td ><input type="text" value="<?php echo $thiet_bi['ten'] ?>" class="uneditable-input"/></td>
            </tr>
            <tr>
                <td>Đơn vị quản lý</td>
                <td colspan="3">
                    <input type="text" value="<?php echo $thiet_bi['don_vi']; ?>" class="uneditable-input span7" 
                    title="<?php echo $thiet_bi['don_vi']; ?>" />
                </td>
            </tr>
            <tr>
                <td>Loại thiết bị</td>
                <td><input type="text" value="<?php echo $thiet_bi['loai']; ?>" class="uneditable-input" /></td>
                <td>Ngày sử dụng</td>
                <td><input type="text" value="<?php echo $thiet_bi['ngay_su_dung']; ?>" class="uneditable-input" /></td>
            </tr>
            <tr>
                <td>Khu nhà</td>
                <td><input type="text" class="uneditable-input" value="<?php echo $thiet_bi['khu_nha']; ?>" /></td>
                <td>Số hóa đơn xuất</td>
                <td><input type="text" class="uneditable-input" value="<?php echo $so_hoa_don['so_hoa_don']; ?>" /></td>
            </tr>
            <tr>
                <td>Phòng</td>
                <td><input type="text" name="phong" value="<?php echo $thiet_bi['phong']; ?>" /></td>
                <td>Trạng thái</td>
                <td>
                    <?php
                         $trangthai = array(
                            '' => 'Không xác định',
                            0 => 'Chưa thanh lý',
                            1 => 'Đã thanh lý',
                         );
                         if (is_numeric($thiet_bi['trang_thai'])){
                            echo form_dropdown('trang_thai', $trangthai, $thiet_bi['trang_thai']);
                         }else{
                            echo form_dropdown('trang_thai', $trangthai, '');
                         }
                    ?>
                </td>
            </tr>
            <tr>
                <td>Mô tả</td>
                <td colspan="3">
                    <textarea class="cleditor span6" rows="3" name="mo_ta"><?php echo $thiet_bi['mo_ta']; ?></textarea>
                </td>
            </tr>
        </table>
    </div>
    <div class="button-box">
    	<input type="submit" name="submit" class="btn btn-success" value="Lưu thông tin" />
    </div>
</div>
    <?php
        echo form_close();
    ?>
<div>
    <label id="info" style="color: blue;font-size: 20px;"><?php if (isset($info)) echo $info;?></label>
    <label id="error" style="color: red;font-size: 20px;"><?php if (isset($error)) echo $error;?></label>
</div>
<!-- Begin script-->
<script type="text/javascript">
    $('document').ready(function(){
        $('#info').hide(7000);
        $('#error').hide(7000);
    });
</script>
<!-- End script-->