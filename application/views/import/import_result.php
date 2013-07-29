<div style="font-size: 10px;">
    <h2><a href="../import">Back</a></h2>
    <h2 style="text-align: center;">Kết quả Import </h2>
    <div style="font-size: 12px;">Tổng số dòng chưa được Import là : <span style="color: red;"><?php echo count($array_import_fail); ?> </span></div>
    <table style="border: solid; ">
        <tr style="text-align: center;">
            <th>STT</th>
            <th>Dòng</th>
            <th>Số hóa đơn</th>
            <th>Nhà cung cấp</th>
            <th>Đơn vị nhận</th>
            <th>Khu nhà</th>
            <th>Nguồn vốn</th>
            <th>Cho mượn</th>
            <th>Tên thiết bị</th>
            <th>Loại thiết bị</th>
            <th>Quốc gia</th>
            <th>Số lượng</th>
            <th>Bảo hành</th>
            <th>Chi phí lắp đặt</th>
            <th>Chi phí vận chuyển</th>
            <th>Chi phí chạy thử</th>
            <th>Số năm khấu hao</th>
            <th>Đơn giá</th>
            <th>Phòng</th>
            <th>Lỗi</th>
        </tr>
        <?php
        if(count($array_import_fail)){
            for($i=0; $i<count($array_import_fail); $i++) {
        ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $array_import_fail[$i]['id']; ?></td>
            <td><?php echo $array_import_fail[$i]['data']['so_hoa_don']; ?></td>
            <td><?php echo $array_import_fail[$i]['data']['nha_cung_cap']; ?></td>
            <td><?php echo $array_import_fail[$i]['data']['don_vi_nhan']; ?></td>
            <td><?php echo $array_import_fail[$i]['data']['khu_nha']; ?></td>
            <td><?php echo $array_import_fail[$i]['data']['nguon_von']; ?></td>
            <td><?php echo $array_import_fail[$i]['data']['cho_muon']; ?></td>
            <td><?php echo $array_import_fail[$i]['data']['ten_thiet_bi']; ?></td>
            <td><?php echo $array_import_fail[$i]['data']['loai_thiet_bi']; ?></td>
            <td><?php echo $array_import_fail[$i]['data']['quoc_gia']; ?></td>
            <td><?php echo $array_import_fail[$i]['data']['so_luong']; ?></td>
            <td><?php echo $array_import_fail[$i]['data']['so_thang_bao_hanh']; ?></td>
            <td><?php echo $array_import_fail[$i]['data']['chi_phi_lap_dat']; ?></td>
            <td><?php echo $array_import_fail[$i]['data']['chi_phi_van_chuyen']; ?></td>
            <td><?php echo $array_import_fail[$i]['data']['chi_phi_chay_thu']; ?></td>
            <td><?php echo $array_import_fail[$i]['data']['so_nam_khau_hao']; ?></td>
            <td><?php echo $array_import_fail[$i]['data']['don_gia']; ?></td>
            <td><?php echo $array_import_fail[$i]['data']['phong']; ?></td>
            <td><?php echo $array_import_fail[$i]['fail']; ?></td>
        </tr>
        <?php
            }
        }     
        ?>
    </table>    
</div>

