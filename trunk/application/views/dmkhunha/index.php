<script>
	function edit_dmkhunha(id){
		//alert(id);
		domain = $("#domain").val();
		url = domain + '/dmkhunha/edit/'+id;
		$("#formnew").load(url);
		$("#formnew").fadeIn();
	}

	function removeFormEdit(){
		$("#formnew").empty();
	}


	function add_dmkhunha(){
		//alert(id);
		domain = $("#domain").val();
		url = domain + '/dmkhunha/add';
		$("#formnew").load(url);
		$("#formnew").fadeIn();
	}
	function delete_dmkhunha(id){
		//alert(id);
		var comfirmBox;
		domain = $("#domain").val();
		 comfirmBox = confirm("Bạn có chác chắn muốn xóa không ?");
		 if(comfirmBox == true)
		  {
			 $.ajax(
				      {
				    	  type:"POST",
						  url: domain + "/dmkhunha/delete/" + id,
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
		<div class="alert alert-success" >
			<span class="strong">Thao tác thành công.</span>
			<span class="close" title="Dismiss"></span>
		</div>
		<?php
	}

	if($warning){
		?>
			<div class="alert alert-danger" >
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
        	<input type='button' class=" btn btn-success" value="Thêm dữ liệu" onclick='add_dmkhunha()'>
        </div>
    	
</div>
<table class="table table-dark-blue">
    <thead>
        <tr>
            <th width='45%'>
                Tên Khu  nhà
            </th>
            <th>
                Trạng thái
            </th>
            <th>
                Mô tả
            </th>
            <th width='65px' >
                Sửa
            </th>
            <th width='65px' >
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
                $ten = $value['ten'];
                $trangthai = $value['trang_thai'];
                $mota = $value['mo_ta'];
                echo "<tr id='".$id."'>";
		echo "<td class=''>".$ten."</td>";
		echo "<td class=''>".$trangthai."</td>";
                echo "<td class=''>".$mota."</td>";
        ?>
                <td>
                	<button type="button" class="btn btn-small" onclick="edit_dmkhunha('<?php echo $id; ?>')"><i class="icon-edit"></i>&nbsp;<strong>Sửa</strong></button>   
                </td>
                <td>
                	<button type="button" class="btn btn-small" onclick="delete_dmkhunha('<?php echo $id; ?>')"><i class="icon-trash"></i>&nbsp;<strong>Xóa</strong></button>           	
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
