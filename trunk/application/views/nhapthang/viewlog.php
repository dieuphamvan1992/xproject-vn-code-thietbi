<div class="container-box">
    <div class="">
        <h2 style="text-align: center;margin-top: 20px;margin-bottom: 40px;">Danh sách các hóa đơn nhập thẳng</h2>
    </div>
    <div class="table-box">
        <table class="table table-striped table-dark-blue ">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Số hóa đơn</th>
                    <th>Người thực hiện</th>
                    <th>Ngày</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $index = 0;
                    foreach ($list as $item){
                        $index++;
                ?>
                    <tr>
                        <td><?php echo $index; ?></td>
                        <td>
                            <a href="#"><?php echo $item['so_hoa_don']; ?></a>
                        </td>
                        <td><?php echo $item['ho_ten']; ?></td>
                        <td><?php echo $item['ngay']; ?></td>
                        <td style="width: 150px;">
                            <a href="<?php echo base_url('index.php/nhapthang/backup/'.$item['id']); ?>">
                                <button class="btn btn-danger"
                                onclick="return confirm('Bạn có chắc chắn muốn xóa những thiết bị nhập thẳng của hóa đơn <?php echo $item['so_hoa_don']; ?>?\n\nNote: Thông tin đã xóa không thể khôi phục')">
                                Hủy bỏ</button>
                            </a>
                            <a href="<?php echo base_url('index.php/nhapthang/deleteLog/'.$item['id']); ?>">
                                <button class="btn" onclick="return confirm('Bạn có chắc chắn muốn duyệt thông tin này?\n\nNote: Thông tin đã duyệt không được xóa!');">Duyệt</button>
                            </a>
                        </td>
                    </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>