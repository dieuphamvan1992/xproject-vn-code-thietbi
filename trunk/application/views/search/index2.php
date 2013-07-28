<?php
  echo form_open('search/index2', array('name' => 'timkiem', 'id' => 'timkiem'));
   echo form_fieldset();
?>

<div class="container-box">
  
    <style type="text/css">
        .pad td{
            padding-left: 20px;
        }
    </style>
    <div style="margin-top: 30px;">
        <table class="pad">
            <tr>
                <td>Số hóa đơn nhập</td>
                <td><input type="text" name="shdn" id="shdn" /></td>
                <td>Số hóa đơn xuất</td>
                <td><input type="text" name="shdx" id="shdx" /></td>
                <td>Đơn vị quản lý</td>
                <td>
                    <?php
                        $don_vi = array('' => 'Tất cả các đơn vị quản lý');
                        foreach($list_don_vi as $item){
                            $don_vi[$item['id']] = $item['ten'];
                        }
                        echo form_dropdown("don_vi", $don_vi, null, '');
                    ?>
                </td>
            </tr>
            <tr>
                <td>Loại thiết bị</td>
                <td>
                    <?php
                        $loai = array('' => '');
                        foreach ($list_loai_thiet_bi as $item){
                            $loai[$item['id']] = $item['ten'];
                        }
                        echo form_dropdown("loai_thiet_bi", $loai, null, 'id="loai"');
            		?>
                </td>
                <td>Từ năm</td>
                <td>
                    <select name="tu" id="tu" class="span1">
                        <option value=""></option>
                        <?php
                            $year = (int) date('Y');
                            for ($i = $year; $i > $year - 10; $i--){
                                echo '<option value="' . $i . '">' . $i . '</option>';
                            }
                        ?>
                    </select>
                </td>
                <td>Đến năm</td>
                <td>
                    <select name="den" id="den" class="span1">
                        <option value=""></option>
                        <?php
                            for ($i = $year; $i > $year - 10; $i--){
                                echo '<option value="' . $i . '">' . $i . '</option>';
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Phòng</td>
                <td><input type="text" name="phong" id="phong" /></td>
                <td>Khu nhà</td>
                <td>
                    <?php
                        $khu_nha = array('' => 'Tất cả các khu nhà');
                        foreach($list_khu_nha as $item){
                            $khu_nha[$item['id']] = $item['ten'];
                        }
                        echo form_dropdown("khu_nha", $khu_nha, null, '');
                    ?>
                </td>
                <td>Trạng thái</td>
                <td>
                    <select name="tt" id="tt">
                        <option value=""></option>
                        <option value="0">Chưa thanh lý</option>
                        <option>Đã thanh lý</option>
                    </select>
                </td>
            </tr>
        </table>
        <hr />
        <div class="">
            <input type="submit" name="submit" value="Tìm kiếm" class="btn btn-success" />
        </div>
    </div>
    <?php
        echo form_fieldset_close();
        echo form_close();
    ?>
</div>
<div class="table-box">
    <?php
        if (isset($list_thiet_bi) && count($list_thiet_bi) > 0){
    ?>
        <h3 style="text-align: center;margin-top: 20px;margin-bottom: 30px;">Danh sách thiết bị</h3>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên thiết bị</th>
                    <th>Số lượng</th>
                    <th>Loại thiết bị</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $index = 0;
                    foreach ($list_thiet_bi as $item){
                        $index++;
                ?>
                <tr>
                    <td><?php echo $index; ?></td>
                    <td><?php echo $item['ten']; ?></td>
                    <td><?php echo $item['COUNT(thiet_bi_su_dung.id)']; ?></td>
                    <td><?php echo $item['loai']; ?></td>
                    <td>
                        <a href="<?php echo base_url('index.php/search/view/' . $item['id']); ?>">
                            <span class="btn">Xem</span>
                        </a>
                    </td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    <?php     
        }else if (!isset($is_first)){
            echo '<p style="color:red;">No matches were found</p>';
        }
    ?>
</div>
<!-- Begin script -->
<script type="text/javascript" src="<?php echo base_url('public/js/search.js'); ?>"></script>
<!-- End script -->