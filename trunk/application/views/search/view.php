<div class="container-box">
    <div>
        <h2 style="margin-bottom: 30px;text-align: center;">Danh sách thiết bị</h2>
    </div>
    <div style="margin: 10px;">
        <table>
            <tr>
                <td><i>Tên thiết bị:</i></td>
                <td>
                    <?php
                        if (count($list_thiet_bi) > 0){
                            echo $list_thiet_bi[0]['ten'];
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td><i>Số lượng:</i></td>
                <td><?php echo count($list_thiet_bi); ?></td>
            </tr>
            <tr>
                <td><i>Đơn vị quản lý:</i></td>
                <td>
                    <?php
                        if (count($list_thiet_bi) > 0){
                            echo $list_thiet_bi[0]['don_vi'];
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td><i>Số hóa đơn xuất:</i></td>
                <td>
                    <?php
                        if (isset($so_hoa_don)){
                            echo $so_hoa_don['so_hoa_don'];
                        }
                    ?>
                </td>
            </tr>
        </table>
    </div>
    <div class="table-box">
        <table id="customers" class="table table-dark-blue table-striped">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Mã thiết bị</th>
                        <th>Ngày sử dụng</th>
                        <th>Phòng</th>
                        <th>Khu nhà</th>
                        <th>Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $index = 0; 
                        foreach($list_thiet_bi as $thiet_bi){
                            $index++;
                    ?>
                        <tr>
                            <td><?php echo $index; ?></td>
                            <td>
                                <a href="<?php echo base_url('index.php/search/detail/'. $thiet_bi['id']); ?>">
                                    <?php echo $thiet_bi['id']; ?>
                                </a>
                            </td>
                            <td><?php echo $thiet_bi['ngay_su_dung']; ?></td>
                            <td><?php echo $thiet_bi['phong']; ?></td>
                            <td><?php echo $thiet_bi['khu_nha']; ?></td>
                            <td>
                                <?php 
                                    if ($thiet_bi['trang_thai'] == 0){
                                        echo 'Chưa thanh lý';
                                    }else if ($thiet_bi['trang_thai'] == 1){
                                        echo 'Đã thanh lý';
                                    }else{
                                        echo $thiet_bi['trang_thai'];
                                    }
                                ?>
                            </td>
                        </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
    </div>
</div>