<form method="post" class="" action="" enctype="multipart/form-data">
    <table border=0 cellPadding=10 cellSpacing=0 width="100%" height="100%" style="border-collapse: collapse" bordercolor="#111111">
    	<tbody>
    		<tr>
    			<td class='' valign='top'>
    				<table border=0 cellPadding=4 cellSpacing=1 class= width="100%">
						<tr>
							<th class='' height='30' colspan='2'>
								<?php echo $title; ?>
							</th>
						</tr>
						<tr>
							<td class=>Thiết bị</td>
							<td class=><input type='text' name='ten' size=70/></td>
						</tr>
						<tr>
							<td class=>Ảnh</td>
							<td class=><input type='text' name='anh' size=70/></td>
						</tr>
						<tr>
							<td class=>Loại</td>
							<td class=>
								<select name='id_loai_thiet_bi'>
									<option value=0 selected><?php echo "---Chọn loại thiết bị---"?></option>
									<?php 
										foreach ($listtb as $key => $value) {
									?>
										<option value="<?php echo $value['id'] ?>"><?php echo $value['ten']; ?></option>
									<?php
										}
									?>	
								</select>
							</td>
						</tr>
						<tr>
							<td class=>Đơn vị tính</td>
							<td class=><input type='text' name='don_vi_tinh' size=70/></td>
						</tr>
						<tr>
							<td class=>Trạng thái</td>
							<td class=><textarea name='trang_thai' cols='52'></textarea></td>
						</tr>
						<tr>
							<td class=>Mô tả</td>
							<td class=><textarea name='mo_ta' cols='52'></textarea></td>
						</tr>
						<tr>
							<td class=></td>
							<td class=><input class="" type="submit" name="submit" value="Thêm">
							<input class="" type='button' value='Hủy' onclick = 'removeFormEdit()'></td>
						</tr>
					</table>
    			</td>
    		</tr>
    	</tbody>
    </table>
</form>