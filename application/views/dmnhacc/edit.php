<?php
	if(!empty($datas))
	{	
		$id = $datas->id;
		$ten = $datas->ten;
		$sdt = $datas->so_dien_thoai;
		$email = $datas->email;
		$diachi = $datas->dia_chi;
		$idquocgia = $datas->id_quoc_gia;
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
								<td class=row1>Nhà cung cấp</td>
								<td class=row2><input type='text' name ='ten' size=70 value="<?php echo $ten; ?>"/></td>
							</tr>
							<tr>
								<td class=row1>Điện thoại</td>
								<td class=row2><input type='text' name ='so_dien_thoai' size=70 value="<?php echo $sdt; ?>"/></td>
							</tr>
							<tr>
								<td class=row1>Email</td>
								<td class=row2><input type='text' name ='email' size=70 value="<?php echo $email; ?>"/></td>
							</tr>
							<tr>
								<td class=row1>Địa chỉ</td>
								<td class=row2><input type='text' name ='dia_chi' size=70 value="<?php echo $diachi; ?>"/></td>
							</tr>
							<tr>
								<td class=row1>Quốc gia</td>
								<td class=row2><input type='text' name ='id_quoc_gia' size=70 value="<?php echo $idquocgia; ?>"/></td>
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
