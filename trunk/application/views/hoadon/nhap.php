<?php
    if ($this->session->flashdata('error'))
    {
        ?>
        <div class="alert alert-error"><?php echo $this->session->flashdata('error'); ?></div>
        <?php
    }
    else
        if ($this->session->flashdata('success'))
    {
        ?>
        <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
        <?php
    }


 echo form_open(''); ?>
<div class="container-box">
    <div class="box-title">
        <h2>Quản lý hóa đơn nhập</h2>
    </div>

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
            echo "<td> " . $item['nguoi_tao'] . " </td>";
            echo "<td> " .$item['nguoi_duyet'] . " </td>";
            $linkDuyet = site_url("hoadon/quanlynhap/duyet/".$item['id']);
            if ($item['trang_thai'] == 0)
            echo "<td> <a href='$linkDuyet' onclick=\"return confirm('Bạn có muốn duyệt hoá đơn này không?');\">Chưa duyệt </a></td>";
        else
             if ($item['trang_thai'] == 1)
                echo "<td> Đã duyệt </td>";
            $linkEdit = site_url("hoadon/quanlynhap/edit/".$item['id']);
             if ($item['trang_thai'] == 0)
            echo "<td width='60px'><a href='$linkEdit'><button class='btn btn-success btn-mini' type='button'><i class='icon icon-asterisk icon-white'></i> Sửa</button></a>  </td>";
        else echo "<td></td>";
         if ($item['trang_thai'] == 0)
            echo "<td width='60px'><button class='btn btn-warning btn-mini'><i class='icon icon-remove-circle icon-white' type='button'></i> Xóa</button></td>";
           else echo "<td></td>";
            echo "</tr>";
        }
        ?>



    </table>
</div>
<?php echo form_close(); ?>
