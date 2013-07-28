<script>
	function edit_dmnguonvon(id){
		//alert(id);
		domain = $("#domain").val();
		url = domain + '/dmnguonvon/edit/'+id;
		$("#formnew").load(url);
		$("#formnew").fadeIn();
	}

	function removeFormEdit(){
		$("#formnew").empty();
	}


	function add_dmnguonvon(){
		//alert(id);
		domain = $("#domain").val();
		url = domain + '/dmnguonvon/add';
		$("#formnew").load(url);
		$("#formnew").fadeIn();
	}
	function delete_dmnguonvon(id){
		//alert(id);
		var comfirmBox;
		domain = $("#domain").val();
		 comfirmBox = confirm("Bạn có chác chắn muốn xóa không ?");
		 if(comfirmBox == true)
		  {
			 $.ajax(
				      {
				    	  type:"POST",
						  url: domain + "/dmnguonvon/delete/" + id,
						  datatype: "html",
						  success: function(html)
						     {
							  $("#" + id).remove();
						     }
				      }
				      );
		  }
	}
</script>
<input type="hidden" value="<?php echo site_url(); ?>" id="domain">

<?php 
	if($success){
	?>
		<div class="notification success" >
			<span class="strong">Thao tác thành công.</span>
			<span class="close" title="Dismiss"></span>
		</div>
		<?php
	}
	
	if($warning){
		?>
			<div class="notification warning" >
				<span class="strong">Dữ liệu bạn nhập còn thiếu. Xin vui lòng kiểm tra lại!</span>
				<span class="close" title="Dismiss"></span>
			</div>
			<?php
		}
	/*
	if($this->error){
		?>
			<div class="notification error" >
				<span class="strong">Lỗi dữ liệu. Vui lòng kiểm tra lại</span>
				<span class="close" title="Dismiss"></span>
			</div>
			<?php
	}*/
?>

<div id='formnew'></div>
<div class="row">
	<div class="span12">
    	<h2><?php echo $title; ?></h2>
    </div>
        <div style="float:right; padding:3px 0;">
        	<input type='button' class=" btn btn-success" value="Thêm dữ liệu" onclick='add_dmnguonvon()'>
        </div>
    	
</div>


<table class="table table-dark-blue">
    <thead>
        <tr>
            <th width='15%' >
                Mã NV
            </th>
            <th width='25%' >
                Nguồn vốn
            </th>
            <th width='25%' >
                Trạng thái
            </th>
            <th width='25%' >
                Mô tả
            </th>
            <th width='50px' >
               Sửa
            </th>
            <th width='50px' >
              	Xóa
            </th>
        </tr>
    </thead>
    <?php

    $list = $datas;
    if($list){
    ?>
        <?php
            foreach($list as $key => $value)
            {	
                $id = $value['id'];
                $ma = $value['ma'];
                $ten = $value['ten'];
                $trangthai = $value['trang_thai'];
                $mota = $value['mo_ta'];
                echo "<tr id='".$id."'><td class=''>".$ma."</td>";
                echo "<td class=''>".$ten."</td>";
                echo "<td class=''>".$trangthai."</td>";
                echo "<td class=''>".$mota."</td>";
        ?>
                <td class=''>
                    <img src="<?php echo base_url(); ?>public/images/edit.png" width="20" height="20" onclick="edit_dmnguonvon('<?php echo $id; ?>')">
                </td>
                <td>
                	 <img src="<?php echo base_url(); ?>public/images/delete.png" width="20" height="20" onclick="delete_dmnguonvon('<?php echo $id; ?>')">
                </td>
        <?php
                echo "</tr>";
            }
        ?>
    <?php 
    }
    else{
    ?>
    
        <tr align='center'>
            <td colspan='5' class='row1'>
                <strong><font color='red'>Không có dữ liệu</font></strong>
            </td>
        </tr>
    
    <?php 	
     } 
    ?>
</table>
