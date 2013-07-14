<script>
	function edit_dmtentb(id){
		//alert(id);
		domain = $("#domain").val();
		url = domain + '/dmtentb/edit/'+id;
		$("#formnew").load(url);
		$("#formnew").fadeIn();
	}

	function removeFormEdit(){
		$("#formnew").empty();
	}


	function add_dmtentb(){
		//alert(id);
		domain = $("#domain").val();
		url = domain + '/dmtentb/add';
		$("#formnew").load(url);
		$("#formnew").fadeIn();
	}
	function delete_dmtentb(id){
		//alert(id);
		var comfirmBox;
		domain = $("#domain").val();
		 comfirmBox = confirm("Bạn có chác chắn muốn xóa không ?");
		 if(comfirmBox == true)
		  {
			 $.ajax(
				      {
				    	  type:"POST",
						  url: domain + "/dmtentb/delete/" + id,
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

<table border=0 cellPadding=10 cellSpacing=0 width="100%" height="100%" style="border-collapse: collapse" bordercolor="#111111">
	<tbody>
		<tr>
			<td class='' valign='top'>
				<table width='100%'>
					<tr>
						<td><strong><?php echo $title; ?></strong></td>
						<td align='right'>
							<input type='button' class="" value="Thêm dữ liệu" onclick='add_dmtentb()'>
						</td>
					</tr>
				</table>
				<table border=0 cellPadding=4 cellSpacing=1 class=forumline
        width="100%">
        			<thead>
						<tr>
							<th class='' height='30'>
								Thiết bị
							</th>
							<th class='' height='30'>
								Ảnh
							</th>
							<th class='' height='30'>
								Loại
							</th>
							<th class='' height='30'>
								Đơn vị tính
							</th>
							<th class='' height='30'>
								Trạng thái
							</th>
							<th class='' height='30'>
								Mô tả
							</th>
							<th class='' height='30'>
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
								$ten = $value['ten'];
								$anh = $value['anh'];
								$idloaitb = $value['id_loai_thiet_bi'];
								$donvitinh = $value['don_vi_tinh'];
								$trangthai = $value['trang_thai'];
								$mota = $value['mo_ta'];

								echo "<tr id='".$id."'>";
								echo "<td class=''>".$ten."</td>";
								echo "<td class=''>".$anh."</td>";
						?>
								<td class=''>
									<?php foreach ($listtb as $key => $value1) {
											if($idloaitb == $value1['id'])
												echo $value1['ten'];
											else
												echo "Chưa có";
									} ?>
								</td>
						<?php
								echo "<td class=''>".$donvitinh."</td>";
								echo "<td class=''>".$trangthai."</td>";
								echo "<td class=''>".$mota."</td>";
						?>
								<td class=''>
									<img src="<?php echo base_url(); ?>public/images/edit.png" width="20" height="20" onclick="edit_dmtentb('<?php echo $id; ?>')">
									<img src="<?php echo base_url(); ?>public/images/delete.png" width="20" height="20" onclick="delete_dmtentb('<?php echo $id; ?>')">
								</td>
						<?php
								echo "</tr>";
							}
						?>
					</tbody>
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