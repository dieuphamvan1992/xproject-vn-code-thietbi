<div class="container-box">
	<div class="box-title">
    	<h2>Chi tiết lô thiết bị</h2>
    </div>
        <table>
            <tr>
                <td><i>Tên thiết bị:</i></td>
                <td>
                    <font color="#42515f">
                       <strong> 
					   <?php
                            if (count($list_thiet_bi) > 0){
                                echo $list_thiet_bi[0]['ten'];
                            }
                        ?>
                        </strong>
                     </font>
                </td>
            </tr>
            <tr>
                <td><i>Số lượng:</i></td>
                <td><font color="#42515f"><strong><?php echo count($list_thiet_bi); ?></strong></font></td>
            </tr>
            <tr>
                <td><i>Đơn vị quản lý:</i></td>
                <td>
                    <font color="#42515f">
                        <strong>
						<?php
                            if (count($list_thiet_bi) > 0){
                                echo $list_thiet_bi[0]['don_vi'];
                            }
                        ?>
                    	</strong>
                   </font>     
                </td>
            </tr>
            <tr>
                <td><i>Số hóa đơn xuất:</i></td>
                <td>
                <font color="#42515f">
                        <strong>
                    <?php
                        if (isset($so_hoa_don)){
                            echo $so_hoa_don['so_hoa_don'];
                        }
                    ?>
                    </strong>
                   </font>     
                </td>
            </tr>
        </table>
    </div>
    <div class="table-box">
    <div class="table-box-title">
        <div style="float:left">
            <h3><i class=" icon-chevron-right">&nbsp;</i>&nbsp;Danh sách thiết bị trong lô</h3>
        </div>
        <div class="clear"></div>
   		 </div>
        <table id="customers" class="table table-dark-blue table-striped">
                <thead>
                    <tr>
                        <th width="50px">STT</th>
                        <th width="90px">Mã thiết bị</th>
                        <th>Tên thiết bị</th>
                        <th width="120px">Ngày sử dụng</th>
                        <th>Phòng</th>
                        <th>Khu nhà</th>
                        <th width="120px">Trạng thái</th>
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
                                
                                    <?php echo $thiet_bi['ma_thiet_bi']; ?>
                                
                            </td>
                            <td><a target="_blank" href="<?php echo base_url('index.php/search/detail/'. $thiet_bi['id']); ?>"><?php echo $thiet_bi['ten']; ?></a></td>
                            <td><?php echo $thiet_bi['ngay_su_dung']; ?></td>
                            <td><?php echo $thiet_bi['phong']; ?></td>
                            <td><?php echo $thiet_bi['khu_nha']; ?></td>
                            <td>
                                <?php 
                                    if (($thiet_bi['trang_thai'] !== null) && ($thiet_bi['trang_thai'] == 0)){
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