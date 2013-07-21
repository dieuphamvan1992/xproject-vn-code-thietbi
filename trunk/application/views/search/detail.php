<div class="container-box">
    <div>
        <h2 style="text-align: center;">Chi tiết thiết bị sử dụng</h2>
    </div>
    <div class="table-box">
        <table id="customer">
            <tr class="alt">
                <td>Mã thiết bị</td>
                <td><?php echo $thiet_bi['id']; ?></td>
            </tr>
            <tr>
                <td>Tên thiết bị</td>
                <td><?php echo $thiet_bi['ten'] ?></td>
            </tr>
            <tr class="alt">
                <td>Đơn vị quản lý</td>
                <td><?php echo $thiet_bi['don_vi']; ?></td>
            </tr>
            <tr>
                <td>Loại thiết bị</td>
                <td><?php echo $thiet_bi['loai']; ?></td>
            </tr>
            <tr class="alt">
                <td>Ngày sử dụng</td>
                <td><?php echo $thiet_bi['ngay_su_dung']; ?></td>
            </tr>
            <tr>
                <td>Khu nhà</td>
                <td><?php echo $thiet_bi['khu_nha']; ?></td>
            </tr>
            <tr class="alt">
                <td>Phòng</td>
                <td><?php echo $thiet_bi['phong']; ?></td>
            </tr>
            <tr>
                <td>Số hóa đơn xuất</td>
                <td><?php echo $so_hoa_don['so_hoa_don']; ?></td>
            </tr>
            <tr>
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
            <tr class="alt">
                <td>Tình trạng</td>
                <td><?php echo $thiet_bi['tinh_trang']; ?></td>
            </tr>
            <tr>
                <td>Mô tả</td>
                <td><?php echo $thiet_bi['mo_ta']; ?></td>
            </tr>
        </table>
    </div>
</div>