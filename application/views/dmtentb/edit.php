<?php
	if(!empty($datas))
	{	
		$id = $datas->id;
		$ten = $datas->ten;
		$anh = $datas->anh;
		$idloaitb = $datas->id_loai_thiet_bi;
		$donvitinh = $datas->don_vi_tinh;
		$trangthai = $datas->trang_thai;
		$mota = $datas->mo_ta;
	}
?>
<div id='formedit'>
	<form method="post" class="form" action="" enctype="multipart/form-data">
      	<table border=0 cellPadding=10 cellSpacing=0 width="100%" height="100%" style="border-collapse: collapse" bordercolor="#111111">
	    	<tbody>
	    		<tr>
	    			<td class='bodytop' valign='top'>
	    				<table border=0 cellPadding=4 cellSpacing=1 class=forumline width="100%">
							<tr>
								<th class='thHead' height='30' colspan='2'>
									<?php echo $title; ?>
								</th>
							</tr>
							<tr>
								<input type='hidden' name='id' value="<?php echo $id; ?>">
								<td class=row1>Thiết bị</td>
								<td class=row2><input type='text' name ='ten' size=70 value="<?php echo $ten; ?>"/></td>
							</tr>
							<tr>
								<td class=row1>Ảnh</td>
								<td class=row2><input type='text' name ='anh' size=70 value="<?php echo $anh; ?>"/></td>
							</tr>
							<tr>
								<td class=row1>Loại</td>
								<td class=row2>
									<select name='id_loai_thiet_bi'>
									<option value=0><?php echo "---Chọn loại thiết bị---"?></option>
									<?php 
										foreach ($listtb as $key => $value) {
									?>
										<option <?php if($idloaitb == $value['id']) echo "selected='selected'" ?> value="<?php echo $value['id'] ?>"><?php echo $value['ten']; ?></option>
									<?php
										}
									?>	
								</select>
								</td>
							</tr>
							<tr>
								<td class=row1>Đơn vị tính</td>
								<td class=row2><input type='text' name ='don_vi_tinh' size=70 value="<?php echo $donvitinh; ?>"/></td>
							</tr>
							<tr>
								<td class=row1>Trạng thái</td>
								<td class=row2><input type='text' name ='trang_thai' size=70 value="<?php echo $trangthai; ?>"/></td>
							</tr>
							<tr>
								<td class=row1>Mô tả</td>
								<td class=row2><input type='text' name ='mo_ta' size=70 value="<?php echo $mota; ?>"/></td>
							</tr>
							<tr>
								<td class=row1></td>
								<td class=row2><input class="blue" type="submit" name="submit" value="Cập nhật">
								<input class="blue" type='button' value='Hủy' onclick = 'removeFormEdit()'>
								</td>
							</tr>
						</table>
	    			</td>
	    		</tr>
	    	</tbody>
    	</table>
	</form>
</div>
