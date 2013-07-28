Ở đây thì có thông báo lưu thành công hoặc lưu lỗi
<div class="container-box">
    <div class="box-title">
        <h2>Chi tiết thiết bị sử dụng</h2>
    </div>
    EM đổi tất cả thành thẻ select với input cho anh rồi cho thêm chức năng lưu nữa nhé
    <div class="table-box">
        <table width="100%">
            <tr>
                <td width="140px">Mã thiết bị</td>
                <td><input type="text" value="<?php echo $thiet_bi['id']; ?>"/></td>
                <td width="140px">Tên thiết bị</td>
                <td ><input type="text" value="<?php echo $thiet_bi['ten'] ?>"/></td>
            </tr>
            <tr>
                <td>Đơn vị quản lý</td>
                <td colspan="3"><?php echo $thiet_bi['don_vi']; ?>
                </td>
            </tr>
            <tr>
                <td>Loại thiết bị</td>
                <td><?php echo $thiet_bi['loai']; ?></td>
                <td>Ngày sử dụng</td>
                <td><?php echo $thiet_bi['ngay_su_dung']; ?></td>
            </tr>
            <tr>
                <td>Khu nhà</td>
                <td><?php echo $thiet_bi['khu_nha']; ?></td>
                <td>Phòng</td>
                <td><?php echo $thiet_bi['phong']; ?></td>
            </tr>
            <tr>
                <td>Số hóa đơn xuất</td>
                <td><?php echo $so_hoa_don['so_hoa_don']; ?></td>
                <td>Trạng thái</td>
                <td>
                    <?php
                        if ($thiet_bi['trang_thai'] == 0){
                            echo 'Chưa thanh lý';
                        }else if ($thiet_bi['trang_thai'] == 1){
                            echo 'Đã thang lý';
                        }else{
                            echo '';
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td>Tình trạng</td>
                <td><?php echo $thiet_bi['tinh_trang']; ?></td>
                <td>Mô tả</td>
                <td><?php echo $thiet_bi['mo_ta']; ?></td>
            </tr>
        </table>
    </div>
    <div class="button-box">
    	<button class="btn btn-success">Lưu thông tin</button>
    </div>
</div>