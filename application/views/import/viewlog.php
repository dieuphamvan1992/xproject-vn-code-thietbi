<div class="container-box">
    <div class="">
        <h2 style="text-align: center;margin-top: 20px;margin-bottom: 40px;">Danh sách import</h2>
    </div>
    <div class="table-box">
        <table class="table table-striped table-dark-blue ">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Thời gian</th>
                    <th>Người dùng</th>
                    <th>Tổng số</th>
                    <th>Số dòng lỗi</th>
                    <th>File</th>
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
                        <td><?php echo $item['thoi_gian']; ?></td>                       
                        <td><?php echo $item['username']; ?></td>
                        <td><?php echo $item['total']; ?></td>
                        <td><?php echo $item['total_fail']; ?></td>
                        <td style="width: 150px;">
                            <a href="../../<?php echo $item['file']; ?>">
                                <button class="btn">Tải về</button>
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