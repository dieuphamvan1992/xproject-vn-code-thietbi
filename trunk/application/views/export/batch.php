<script language="JavaScript">
<!-- 

function formsubmit() {	
//	alert('Extract');
	rvalue="";
	j=parseInt(document.formExport.length);
	for ( i=1 ; i < j ; i++)
		if ( formExport.elements[i].type=='checkbox' && formExport.elements[i].checked && (formExport.elements[i].value =='field') ) 
		{
			rvalue += formExport.elements[i].name + " ,"
		}	
	formExport.listoexport.value=rvalue;
	formExport.submit();
	}

function selectall() {
	j=parseInt(document.formExport.length);
	for (i=1; i< j; i++ )
		if (formExport.elements[i].type=='checkbox') 
			if (formExport.elements[i].value =='field')
					formExport.elements[i].checked = formExport.checkAll.checked;
	}


-->
</SCRIPT>
<body topmargin="5" leftmargin="5">
<center>
<form method="post" name="formExport" action='<?php echo site_url(); ?>/export/exportBatch'>
<input type="hidden" name="listoexport">

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td><br>
	<table cellpadding="4" cellspacing="1" border="0" class="" align="center">
		<tr>
			<th class="" colspan="6"><?php echo $title; ?></th>
		</tr>
		<tr>
			<td class="" colspan="6" align="center">
				<input type="button" value='<?php echo "Xuất thông tin"?>' onClick="formsubmit();" >
				<input type="button" value='<?php echo "Quay lại"?>' onClick="back();" >
			</td>
		</tr>
		<tr>
			<td class="">
		  		<input name="checkAll" type="Checkbox" onClick="selectall();">
		  	</td>
		  	<td class=""  colspan="3">
		  		<font color="#ff0000" face="Verdana"><b>Chọn tất cả</b></font>
		  	</td>
		 </tr>	
		
		<?php
			$i=0;
			foreach ($list_batch as $key => $value)
			{
				if (($i % 2) == 0) {
				echo "<tr>";
			}
		?>
        
		<td class="">
			<?php
				if($key == "chi_tiet_nhap.id_ten_thiet_bi as tentb")
				{
					echo "<input type='checkbox' name='".$key."' value='field' checked>";
				}
				else
				{
					echo "<input type='checkbox' name='".$key."' value='field'>";
				}
			?>
		</td>
		<td class=""><?php echo $value?></td>
		
		<?php
			if (($i % 2) == 1) { 
				echo "</tr>";
			}
			$i++;
		}
		?>
		</table>
	</form>
</td></tr>
</table>
</center>

