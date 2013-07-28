<script>
	function edit_dmdonvi(id){
		//alert(id);
		domain = $("#domain").val();
		url = domain + '/dmdonvi/edit/'+id;
		$("#formnew").load(url);
		$("#formnew").fadeIn();
	}

	function removeFormEdit(){
		$("#formnew").empty();
	}


	function add_dmdonvi(){
		//alert(id);
		domain = $("#domain").val();
		url = domain + '/dmdonvi/add';
		$("#formnew").load(url);
		$("#formnew").fadeIn();
	}
	function delete_dmdonvi(id){
		//alert(id);
		var comfirmBox;
		domain = $("#domain").val();
		 comfirmBox = confirm("Bạn có chác chắn muốn xóa không ?");
		 if(comfirmBox == true)
		  {
			 $.ajax(
				      {
				    	  type:"POST",
						  url: domain + "/dmdonvi/delete/" + id,
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
		<div class="notification success">
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

<table class="table table-dark-blue">
		<tr>
			<td class='' valign='top'>
				<table width='100%'>
					<tr>
						<td><strong><?php echo $title; ?></strong></td>
						<td align='right'>
							<input type='button' class="" value="Thêm dữ liệu" onclick='add_dmdonvi()'>
						</td>
					</tr>
				</table>

				<table class="table table-bordered">
        			<thead>
						<tr>
							<th width='15%' class='' height='30'>
								Mã ĐV
							</th>
							<th width='25%' class='' height='30'>
								Tên Đơn vị
							</th>
							<th width='25%' class='' height='30'>
								Trạng thái
							</th>
							<th width='25%' class='' height='30'>
								Mô tả
							</th>
							<th width='10%' class='' height='30'>
								Thao tác
							</th>
						</tr>
					</thead>
					<?php

					$list = $datas;
					if($list){
					?>



					<tbody>
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
									<img src="<?php echo base_url(); ?>public/images/edit.png" width="20" height="20" onclick="edit_dmdonvi('<?php echo $id; ?>')">
									<img src="<?php echo base_url(); ?>public/images/delete.png" width="20" height="20" onclick="delete_dmdonvi('<?php echo $id; ?>')">
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
			</td>
		</tr>
	</tbody>
</table>