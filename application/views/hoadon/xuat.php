
<?php echo form_open(''); ?>

<div class="container-box">
    <div class="box-title">
        <h2>Quản lý hóa đơn xuất</h2>
    </div>
<!--Bảng-->
<div class="table-box">
    <table class="table table-bordered">
        <tr>
            <th><input type="checkbox"> </th>
            <th>Mã hoá đơn</th>
            <th>Ngày tạo</th>
            <th>Nguồn vốn</th>
            <th>Đơn vị nhận</th>
            <th>Cán bộ tạo</th>
            <th>Cán bộ duyệt</th>
            <th>Trạng thái</th>
            <th></th>
        </tr>

        <?php
        foreach ($list_hoadonxuat as $item) {
            echo "<tr>";
            echo '<td><input type="checkbox"> </td>';
            echo "<td> " . $item['so_hoa_don'] . " </td>";
            echo "<td> " . convertDate($item['ngay_thuc_hien']) . " </td>";
            echo "<td> " . $item['nguonvon'] . " </td>";
            echo "<td> " . $item['donvi'] . " </td>";
            echo "<td> " . $item['nguoi_tao'] . " </td>";
            echo "<td> " .$item['nguoi_duyet'] . " </td>";
            if ($item['trang_thai'] == 0)
            echo "<td> Chưa duyệt </td>";
        else
             if ($item['trang_thai'] == 1)
                echo "<td> Đã duyệt </td>";
            $linkEdit = site_url("quanlyhoadonxuat/edit/".$item['id']);
           echo "<td width='60px'><a href='$linkEdit'><button class='btn btn-success btn-mini'><i class='icon icon-asterisk icon-white'></i> Sửa</button></a>  </td>";
            echo "<td width='60px'><button class='btn btn-warning btn-mini'><i class='icon icon-remove-circle icon-white'></i> Xóa</button></td>";

            echo "</tr>";
        }
        ?>



    </table>
</div>
</div>
<?php echo form_close(); ?>
