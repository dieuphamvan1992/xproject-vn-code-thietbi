<div class="container-box">
    <div class="box-title">
        <h2>Hóa đơn xuất</h2>
    </div>
    <div class="alert alert-success">Chọn hóa đơn nhập từ danh sách bên dưới</div>
    <?php echo form_open(''); ?>

    <!--Bảng-->
    <div class="table-box">
        <table class="table table-bordered table-dark-blue">
            <tr>
                <th>STT </th>
                <th>Mã hoá đơn</th>
                <th>Ngày tạo</th>
                <th>Mô tả</th>
                <th>Cán bộ tạo</th>
                <th>Cán bộ duyệt</th>
                <th>Trạng thái</th>
                <th colspan="2"></th>
            </tr>

            <?php
            $stt = 0;
            foreach ($list_hoadonnhap as $item) {
                $stt ++;
                echo "<tr>";

                echo "<td>$stt </td>";
                echo "<td> " . $item['so_hoa_don'] . " </td>";
                echo "<td> " . convertDate($item['ngay_thuc_hien']) . " </td>";
                echo "<td> " . $item['mo_ta'] . " </td>";
                echo "<td> " . " " . " </td>";
                echo "<td> " . " " . " </td>";
                if ($item['trang_thai'] == 0)
                echo "<td> Chưa duyệt </td>";
            else
                 if ($item['trang_thai'] == 1)
                    echo "<td> Đã duyệt </td>";
                $linkEdit = site_url("hoadon/xuat/create2/".$item['id']);
                echo "<td><a href='$linkEdit'> Tạo hoá đơn xuất</a>  </td>";

                echo "</tr>";
            }
            ?>



        </table>
    </div>
    <?php echo form_close(); ?>
</div>