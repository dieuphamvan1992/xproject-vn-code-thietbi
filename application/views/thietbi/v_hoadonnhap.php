 <script>
 $(document).ready(function() {
 	$("#nha_cung_cap").select2();
 	$("#loaithietbi").select2();
 	$("#tenthietbi").select2();

 });
 </script>


 <?php
 if($this->session->flashdata('editThietBiID'))
 {
 	?>
 	<script>
 	$(document).ready(function() {
 		$('#themThietBi').modal("show");
 	});
 	</script>
 	<?php
 }
 ?>
 <script type="text/javascript">// <![CDATA[
 $(document).ready(function(){
 	$('#loaithietbi').change(function(){
 		$('#tenthietbi option:gt(0)').remove();

 		var loaithietbi_ID = $('#loaithietbi').val();
		// alert("<?php echo site_url('ajax/getListThietBiByIDLoai/'); ?>/"+loaithietbi_ID);
		$.ajax({
			type: "GET",
			url: "<?php echo site_url('ajax/getListThietBiByIDLoai/'); ?>/"+loaithietbi_ID,
			dataType: "json",
			success: function(data)
			{

				$.each(data,function(id,ten)
				{
					$('#tenthietbi').append($("<option></option>")
						.attr("value", id) .text(ten));
				});
			},
			error: function(error){
				console.log(error);
			}

		});

	});
 });
 // ]]>
 </script>
 <h3><?php echo $title; ?></h3>
 <?php
 echo form_open('hoadon/doCreateHoaDonNhap');

 ?>
 <div style="float: left; width: 30%; padding: 1% 0px 0px 4%;">
 	<label>Số hoá đơn nhập</label>
 	<input type="text" name="sohoadon" value="">
 </div>
 <div style="float: left; width: 30%; padding: 1% 0px 0px 1%;">
 	<label>Nhà cung cấp</label>
 	<select name="nha_cung_cap" id="nha_cung_cap">
 		<?php
 		foreach ($list_nhacungcap as $item)
 		{
 			echo "<option value= ".$item['id'].">".$item['ten']."</option>";

 		}
 		?>

 	</select>
 </div>
 <div style="float: left; width: 30%; padding: 1% 0px 0px 1%;">
 	<label>Ngày thực hiện</label>
 	<input type="text" name="ngaythuchien">
 </div>
 <div style="float: left; width: 30%; padding: 1% 0px 0px 4%;">
 	<label>Cán bộ thực hiện</label>
 	<select name="id_can_bo_thuc_hien">
 		<option value=""></option>
 	</select>
 </div>
 <div style="float: left; width: 65%; padding: 1% 0px 1% 1%;">
 	<label>Mô tả</label>
 	<textarea name="mota" style="width:80%">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</textarea>
 </div>
 <?php if($this->session->flashdata('ketqua'))
 {
 	?>
 	<div style="float: left; width: 86%; padding: 1% 0px 1% 1%;">
 		<div class="alert">
 			<a class="close" data-dismiss="alert">×</a>
 			<?php echo $this->session->flashdata('ketqua'); ?>
 		</div>
 		<?

 	}

 	?>
 	<div style="float: left; width: 87%; padding: 1% 0px 1% 1%;">
 		<a class="btn btn-primary" href="#themThietBi" data-toggle="modal" style="float:right"><i class="icon-plus"></i>Thêm thiết bị</a>
 	</div>
 	<div style="float: left; width: 85%; padding: 1% 0px 1% 4%;">
 		<table class="table table-bordered" style="">
 			<thead>
 				<tr>
 					<th width="25%">Tên Thiết Bị</th>
 					
 					<th width="65px">Số lượng</th>
                                        <th width="25%">Đơn giá</th>
                                        
                                        <th width="25%">Quốc gia</th>
 					<th colspan="2"></th>
 				</tr>
 			</thead>
 			<tbody>

 				<?php
 				if (!empty($mycart))
 				{
 					foreach ($mycart as $item)
                                        {
                                            ?>
                            <tr>
                           <td> <input type="text" name="ten_thiet_bis[<?php echo $item[0]; ?>]" value="<?php echo $item[1]; ?>" /></td>
                            <td> <input type="text" name="so_luongs[<?php echo $item[0]; ?>]" value="<?php echo $item[2]; ?>" /></td>
                            <td> <input type="text" name="don_gias[<?php echo $item[0]; ?>]" value="<?php echo $item[3]; ?>" /></td>
                            
                           <td> <input type="text" name="quoc_gias[<?php echo $item[0]; ?>]" value="<?php echo $item[4]; ?>" /></td>
                           
                           
                           
                            </tr>
                            <?php
                                        }
 				}
 				?>
 			</tbody>
 		</table>
 	</div>
 	<input type="submit" name="btnCreateHoaDon" class="btn btn-inverse add_data" value="Hoàn thành Hoá đơn" style="margin-left: auto; margin-right: auto; display: block">
 </div>
 <div style="clear:both"></div>
 <?php echo form_close();?>


 <!-- Button to trigger modal -->


 <!-- Modal -->
 <div id="themThietBi" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 	<div class="modal-header">
 		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
 		<?php if (! ($this->session->flashdata('editThietBiID') != '')) { ?>
 		<h3>Thêm thiết bị</h3>
 		<?php } else {?>
 		<h3>Sửa thông tin thiết bị</h3> <?php }?>
 	</div>
 	<div class="modal-body">
 		<div class="span5">
 			<?php if ($this->session->flashdata('editThietBiID') == '')
 			echo form_open('hoadon/doAddThietBi');
 			else
 				echo form_open('hoadon/doEditThietBi');

 			?>
 			<label>Loại thiết bị</label>
 			<select name="loai_thiet_bi" id="loaithietbi">
 				<option value=""></option>
 				<?php foreach ($list_loaithietbi as $item) {
 					echo "<option value = ".$item['id'].">".$item['ten']."</option>";
 				}?>
 			</select>
 			<label>Thiết bị</label>
 			<select name="ten_thiet_bi" id="tenthietbi">
 				<option value=""></option>
 				<?php foreach ($list_tenthietbi as $item) {
 					if (($this->session->flashdata('editThietBiID')) &&($this->session->flashdata('editThietBiID') == $item['id']))
 					{
 						echo "<option value = ".$item['id']." selected>".$item['ten']."</option>";
 					}
 					else
 						echo "<option value = ".$item['id'].">".$item['ten']."</option>";
 				} ?>
 			</select>
 			<label>Số lượng</label>
 			<input type="text" name="so_luong" value="<?php if ($this->session->flashdata('editThietBiSoLuong')) echo $this->session->flashdata('editThietBiSoLuong'); ?>" placeholder="">
 			<br />
 			<label>Đơn giá</label>
 			<input type="text" name="don_gia" value="">
 			<label>Đơn vị tính</label>
 			<input type="text" name="don_vi_tinh" value="">
                        <label>Thời gian bảo hành</label>
 			<input type="text" name="bao_hanh" value="">
 			<input type="submit" name="btnThemThietBi" class="btn btn-primary" value="Thêm Thiết bị" />
 			<?php echo form_close();?>
 		</div>
 	</div>
 	<div class="modal-footer">
 		<button class="btn" data-dismiss="modal" aria-hidden="true" id="closePopup">Đóng</button>
 	</div>
 </div>