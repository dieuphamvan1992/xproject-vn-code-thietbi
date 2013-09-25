<style type="text/css">
		* { margin: 0; padding: 0;}
	   	body {
			font-family: helvetica, arial, sans-serif; 
			font-size: 13px;
			
		}
		.cangiua {
			width:1000px;
			margin: auto;
			
		}
		.ddv1 {
			background:#FFF;
            width: 450px;
            margin: 20px auto;
			height:570px;
			border:#333 solid 1px;
			
			overflow:scroll;
        }
		.ddv2 {
			background:#FFF;
            width: 450px;
            margin: 20px auto;
			height:570px;		
			overflow:scroll;
			margin-left:20px;
			border:#333 solid 1px;
        }
		.active {
            background: #fff url(images/right.png) no-repeat 5px center;
			
        }
 
		dl  {
            width: 250px;
        }
		
		dt{
            background: url(images/down.png) no-repeat 5px center;
            border-bottom: 1px solid white;
            font-size: 13.5px; 
			padding:3px;
			border-bottom:#E2FFC6 solid 1px;
			
            
        }
		
		dt .muc2{
            background:url(images/down.png) no-repeat 5px center;
            border-bottom: 1px solid white;
            font-size: 14px; 
            padding: 5px 0px;
        }
	   
		 dt div {
            color: #000;
            text-decoration: none;
            padding: 0px 18px;
        }
		  dd a {
            color: black;
        }
		
		 ul {
            list-style: none; padding: 5px;
				
        }
		li {
			margin-left:10px;
			padding-right:3px;

		}
		.li1 {
			border-bottom:#E2FFC6 solid 1px;
		}
		
		.active1 {
		background:#8dc63f;
		border:#FFF;
		width:60px;
		height:30px;
		color:#FFF;
		font-weight:bold;
		visibility:visible;
}
		#nut {
		background:#8dc63f;
		border:#FFF;
		width:60px;
		height:30px;
		color:#FFF;
		
		font-weight:bold;
}
		.huy{
			visibility:hidden;
		}
		#nut:hover {
		border:#448ccb solid 1px;
		background:#598527;
	
}
</style>

<script type="text/javascript">
        $(document).ready(function() {
            $('dd').hide();
			// doi don vi 1
            $('.ddv1 dt.muc1 div').click(function()  {
                $('.ddv1 dd:visible').slideUp('fast');
                $('.ddv1 .active').removeClass('active');
				if($(this).parent().next().is(':hidden') == true)
                $(this).parent().addClass('active').next().slideDown('fast');
                return false;
            });
			$('.ddv1 dt.muc2 div').click(function(){
				$('.ddv1 dd.muc2:visible').slideUp('fast');
				$('.ddv1 .muc2.active').removeClass('active');
				if($(this).parent().next().is(':hidden') == true)
				$(this).parent().addClass('active').next().slideDown('fast');
				return false;
			});
        });
</script>

<form method="post" name="formExport" action='<?php echo site_url(); ?>/exportdata/kktaisan/export'>

<div class="ddv1" style="float:left">


<?php
	$this->load->Model('Mdv');
	foreach ($listDVLevel as $key => $value) {
		$ten = $value['dv'];
		$cap = $value['cap'];
		$ma = $value['ma_dv'];
		echo "<dt class= 'muc1'><div>".$ten."</div></dt>
            <dd class='muc1'>
                <ul>";

            $listDVLevel2 = $this->Mdv->getCha(2,$ma);
            foreach ($listDVLevel2 as $key2 => $value2) {
            	$ten2 = $value2['dv'];
            	$cap2 = $value2['cap'];
            	$ma2 = $value2['ma_dv'];

            	$listDVLevel3 = $this->Mdv->getCha(3,$ma2);
            	if($listDVLevel3 != null)
            	{
            		echo "<li class='li1'><dt class = 'muc2'><div class= 'active'>".$ten2."</div></dt>";
            		echo "<dd class= 'muc2'>";
            		echo "<ul>";

            		foreach ($listDVLevel3 as $key3 => $value3) {
            			$ten3 = $value3['dv'];
            			$cap3 = $value3['cap'];
            			$ma3 = $value3['ma_dv'];

            			echo "<li>&nbsp;&nbsp;&nbsp;&nbsp;<input type='radio' name='madv' value='$ma3'>".$ten3."</li>";
            		}

            		echo "</ul>";
            		echo "</dd>";
            		echo "</li>";
            	}

            	else
            	{
            		echo "<li class='li1'>&nbsp;&nbsp;<input type='radio' name='madv' value='$ma2'>".$ten2."&nbsp;</li>";	
            	}
            }
        echo "</ul>
        </dd>"; 
	}

	$year = array(1998,1999,2000,2001,2002,2003,2004,2005,2006,2007,2008,2009,2010,2011,2012,2013);
?>
</div>

<div style="float:left; margin-top:200px; margin-left:14px">
	<select name="year">
		<option value= '0'>---Chọn năm---</option>
		<?php
			for($i=1;$i<count($year);$i++)
			{
				echo "<option value='$year[$i]'>".$year[$i]."</option>";
			}
		?>
	</select>
	<input type="submit" id="nut" name="btExport" value="Xuất báo cáo"/>

</div>

</form>