<?php
    echo form_open('search/index', array('name' => "timkiem", "id" => "timkiem"));
    echo form_fieldset();
?>
    <div class="container-box">
            <!--Hai cột-->
            <div class="two-column">    	
                <div class="box-horizontal">
                	<label for="">Mã thiết bị</label>
                    <div class="input-box">
                    <input type="text" name="ma" style="width: 200px;" onkeypress="onlyNumber(event)" />
                    </div>
                </div>
                <div class="box-horizontal">
                	<label for="" >Trạng thái</label>
                    <div class="input-box">
                    <select name="tt" style="width: 200px;">
                    <option value=""></option>
                    <option value="0">Chưa thanh lý</option>
                    <option value="1">Đã thanh lý</option>
                </select>
                    </div>
                </div>
                 <div class="clearfix"></div>
            </div>
             <!--Một cột-->
        	<div class="one-column">    	
                <div class="box-horizontal">
                	<label for="">Đơn vị quản lý</label>
                    <div class="input-box">
                   		<?php
                            $don_vi = array('' => 'Tất cả các đơn vị quản lý');
                            foreach($list_don_vi as $item){
                                $don_vi[$item['id']] = $item['ten'];
                            }
                            echo form_dropdown("don_vi", $don_vi, null, 'style="width:200px"');
                        ?>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>  
            <!--Hai cột-->
            <div class="two-column">    	
                <div class="box-horizontal">
                	<label for="">Tên thiết bị</label>
                    <div class="input-box">
        				<select name="ten" id="ten" style="width: 200px;">
                            <option value="" loai="first"></option>
                            <?php
                                foreach ($list_ten_thiet_bi as $item){
                                    echo '<option value="'.$item['id'].'" loai="'.$item['id_loai_thiet_bi'] 
                                    .'">' . $item['ten'] . '</option>';
                                }
                            ?>
                        </select>                   
                      </div>
                </div>
                <div class="box-horizontal">
                	<label for="" >Loại thiết bị</label>
                    <div class="input-box">
                    	<?php
                            $loai = array('' => '');
                            foreach ($list_loai_thiet_bi as $item){
                                $loai[$item['id']] = $item['ten'];
                            }
                            echo form_dropdown("loai_thiet_bi", $loai, null, 'style="width:200px" id="loai"');
                		?>
                    </div>
                </div>
                 <div class="clearfix"></div>
            </div>
            <!--Hai cột-->
            <div class="two-column">    	
                <div class="box-horizontal">
                	<label for="">Từ năm</label>
                    <div class="input-box">
						<select name="tu" id="tu" class="span1">
                            <option value=""></option>
                            <?php
                                $year = (int) date('Y');
                                for ($i = $year; $i > $year - 10; $i--){
                                    echo '<option value="' . $i . '">' . $i . '</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="box-horizontal">
                	<label for="" >Đến năm</label>
                    <div class="input-box">
                    	<select name="den" id="den" class="span1">
                    <option value=""></option>
                    <?php
                        for ($i = $year; $i > $year - 10; $i--){
                            echo '<option value="' . $i . '">' . $i . '</option>';
                        }
                    ?>
                </select>
                    </div>
                </div>
                 <div class="clearfix"></div>
            </div>
            <!--Hai cột-->
            <div class="two-column">    	
                <div class="box-horizontal">
                	<label for="">Phòng</label>
                    <div class="input-box">
						<input type="text" name="phong" class="sea" />
                    </div>
                </div>
                <div class="box-horizontal">
                	<label for="" >Khu nhà</label>
                    <div class="input-box">
                    	<?php
                            $khu_nha = array('' => 'Tất cả các khu nhà');
                            foreach($list_khu_nha as $item){
                                $khu_nha[$item['id']] = $item['ten'];
                            }
                            echo form_dropdown("khu_nha", $khu_nha, null, 'style="width:200px"');
                        ?>
                    </div>
                </div>
                 <div class="clearfix"></div>
            </div>
             <!--Ba cột
			<div class="three-column">    	
                <div class="box-horizontal">
                	<label for="">Cột 1</label>
                    <div class="input-box">
                    <select>
                    </select>
                    </div>
                </div>
                <div class="box-horizontal">
                	<label for="" >Cột 2</label>
                    <div class="input-box">
                    <input type="text" />
                    </div>
                </div>
                <div class="box-horizontal">
                	<label for="" >Cột 3</label>
                    <div class="input-box">
                    <input type="text" />
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            -->
            <div class="button-box">
            	<button class="btn btn-success" type="submit" name="submit">Tìm kiếm</button>
            </div>
          </div>
<?php
    echo form_fieldset_close();
    echo form_close();
?>
    <!-- Begin javascript -->
    <script type="text/javascript" src="<?php echo base_url('public/js/datetimepicker_css.js'); ?>"></script>
    <!-- End javascript -->
    <!--Bảng-->
            <div class="table-box">
                    <?php
            if (isset($list_thiet_bi) && count($list_thiet_bi) > 0){
        ?>
            <h3 align="center">Danh sách thiết bị</h3>
            <label>Tổng số thiết bị: <?php echo count($list_thiet_bi); ?></label>
            <table id="customers" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Mã thiết bị</th>
                        <th>Tên thiết bị</th>
                        <th>Đơn vị quản lý</th>
                        <th>Phòng</th>
                        <th>Khu nhà</th>
                        <th>Ngày sử dụng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $index = 0; 
                        foreach($list_thiet_bi as $thiet_bi){
                            $index++;
                            if (($index%2) == 0){
                                echo '<tr class="alt">';
                            }else{
                                echo '<tr>';
                            }
                    ?>
                            <td><?php echo $thiet_bi['id']; ?></td>
                            <td><?php echo $thiet_bi['ten']; ?></td>
                            <td><?php echo $thiet_bi['don_vi']; ?></td>
                            <td><?php echo $thiet_bi['phong']; ?></td>
                            <td><?php echo $thiet_bi['khu_nha']; ?></td>
                            <td><?php echo $thiet_bi['ngay_su_dung']; ?></td>
                        </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        <?php
            }else if(!isset($is_first)){
                echo '<p class="notfound">No matches were found</p>';
            }
        ?>
            </div>     
    
    <script type="text/javascript" src="<?php echo base_url('public/js/nhapthang.js'); ?>"></script>
    <script type="text/javascript">
        $("#tu").click(function(){
           var den = $("#den").val();
           var tu = $("#tu").val();
           if (den != ''){
                if (tu > den){
                    $("#tu").val(den);
                }
           } 
        });
        $("#den").click(function(){
           var tu = $("#tu").val();
           var den = $("#den").val();
           if (tu != ''){
            if (den < tu){
                $("#den").val(tu);
            }
           } 
        });
        $("#loai").click(function(){
           var loai = $("#loai").val();
           if (loai != ""){
                $("#ten").children("option[loai!='" + loai + "']").hide();
                $("#ten").children("option[loai='" + loai + "']").show();
                $("#ten").val("");
           }else{
                $("#ten").children("option").show();
           } 
        });
    </script>