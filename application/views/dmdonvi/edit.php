<?php
	if(!empty($datas))
	{	
		$id = $datas->id;
		$ma = $datas->ma;
		$ten = $datas->ten;
		$idlanhdao = $datas->id_lanh_dao;
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
								<td class=row1>Mã ĐV</td>
								<td class=row2><input type='text' name ='ma' value="<?php echo $ma; ?>"/>
								</td>
							</tr>
							<tr>
								<td class=row1>Tên ĐV</td>
								<td class=row2><input type='text' name ='ten' size=70 value="<?php echo $ten; ?>"/></td>
							</tr>
							<tr>
								<td class=row1>Lãnh đạo</td>
								<td class=row2><input type='text' name ='id_lanh_dao' size=70 value="<?php echo $idlanhdao; ?>"/></td>
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
