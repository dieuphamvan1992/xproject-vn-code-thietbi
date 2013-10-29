
<style type="text/css" media="screen">
    #error{
        font-size: 12pt;
        color: red;

    }
</style>
<script type="text/javascript">
$(document).ready(function()
{
    $("#loaitaikhoan").select2();
    $("#donvi").select2({allowClear: true});
    if ($("#loaitaikhoan").val() > 3)
    {
         $("#donvi").select2("readonly", false);
    }
    else {
         $("#donvi").select2("val", "0");
         $("#donvi").select2("readonly", true);
    }
    $("#loaitaikhoan").change(function(){
        var id = $("#loaitaikhoan").val();

       // alert(id);
        $.ajax({
            type: "POST",
            dataType:'json',
            data: "id="+id,
            url: '<?php echo site_url("users/ajax/getUserType"); ?>',

            success: function (data) {
                //console.log(data);
                if (data.donvi != "")
                {
                    var value = data.donvi;
                   // alert(1);
                   // $("#loaitaikhoan").val("3");
                    //$('#donvi option[value=' + value + ']').attr('selected','selected');
                    //$("#donvi").select2({tags:["red"]});
                    //alert( $('#donvi').val());
                   // $('#loaitaikhoan')
                  // $("#donvi").val("0204");
                    //  $('#donvi').prop("selected",false);
                 //   $("#donvi option[value='" + 0 + "']")
                   // .prop("selected",true);
                   $("#donvi").val([value]).trigger("change");
                   $("#donvi").select2("readonly", true);
                }
                else
                {
                    $("#donvi").select2("val", "");

                    $("#donvi").select2("readonly", false);
                }

                if (data.isview == 1)
                {
                    checkX('isviewYes');
                }
                else
                    checkX('isviewNo');
                if (data.isupdate == 1)
                {
                    checkX('isupdateYes');
                }
                else checkX('isupdateNo');
            },
            error: function (data){

            }
         });
    });

});

function checkX(id)
{
    //$('#'+id).attr('checked', true);
    document.getElementById(id).checked=true;
}
function trim(str) {
    str = str.toString();
    var begin = 0;
    var end = str.length - 1;
    while (begin <= end && str.charCodeAt(begin) < 33) { ++begin; }
    while (end > begin && str.charCodeAt(end) < 33) { --end; }
    return str.substr(begin, end - begin + 1);
}
function submitform()
{
   // alert(1);
   //alert($("#donvi").val());
   document.getElementById('donvi').enable=true;
   var isFormOK = validateForm();
   if(isFormOK) {

    document.myform.submit();
    }else {
    return false;
    }
}
function validateForm(){
    var isOK = true;
    var error = "";
    var notify_place = document.getElementById('error');
    var username=document.forms["myform"]["username"];
    if (username != null){
        username = username.value;
        username = trim(username);
    }
    var pass1=document.forms["myform"]["pass1"];
    if (pass1 != null){
        pass1 = pass1.value;

    }
    var pass2=document.forms["myform"]["pass2"];
    if (pass2 != null){
        pass2 = pass2.value;

    }
    var role=document.forms["myform"]["role"];
    if (role != null){
        role = role.value;
    }
    var name=document.forms["myform"]["name"];
    if (name != null){
        name = name.value;
        name = trim(name);
    }
    var donvi = $("#donvi").val();

    //console.log(donvi);
    var isview=document.forms["myform"]["isview"];
    if (isview != null){
        isview = isview.value;
    }
    var isupdate=document.forms["myform"]["isupdate"];
    if (isupdate != null){
        isupdate = isupdate.value;
    }
    var status=document.forms["myform"]["status"];
    if (status != null){
        status = status.value;
    }
    if (username == null || username == "" || username.length == 0){
        error = "Tên tài khoản không được để trống!";
        isOK = false;
    }
    else if (name == null || name == "" || name.length == 0){
        error = "Họ tên không được để trống!";
        isOK = false;
    }
    else
        if (($('#id_cu').val() == 0) || (($('#id_cu').val() > 0)) && (pass1.length > 0))
        {
            if (pass1 == null || pass1 == "" || pass1.length <6){
            error = "Mật khẩu phải dài từ 6 ký tự trở lên!";
            isOK = false;
            }
            else if (pass2 == null || pass2 == "" || pass2.length == 0 || pass2 != pass1){
                error = "Mật khẩu phải giống nhau!";
                isOK = false;
            }
        }
    else if (role == null || role == ""){
        error = "Chưa chọn loại tài khoản!";
        isOK = false;
    }
    else if (donvi == null || donvi.length == 0){
        error = "Chưa chọn đơn vị!";
        isOK = false;
    }

    if(!isOK) {
        notify_place.innerHTML = error;
        return false;
    }else{
        notify_place.innerHTML = "";
    }
    return true;

}
</script>
<div class="container-box">
    <div class="box-title">
        <h2>User Manager</h2>
    </div>

    <div class="table-box-title alert-info">
        <div style="float:left">
            <h3><i class=" icon-chevron-right">&nbsp;</i>&nbsp;<strong>Danh sách tài khoản</strong></h3>
        </div>

        <div class="clear"></div>
    </div>

    <table id="customers" class="table table-striped table-dark-blue ">
        <thead>
            <tr>
                <th width="40px">STT</th>
                <th width="90px">Tài khoản</th>
                <th>Họ và tên</th>

                <th>Loại user</th>
                <th>Đơn vị</th>
                <th>Quyền xem</th>
                <th>Quyền cập nhật</th>
                <th >Trạng thái</th>
                <th colspan="2"></th>
            </tr>
        </thead>

        <tbody>
            <?php

            $stt =0;
          //  var_dump($list_donvi);
            foreach ($list_user as $item) {
                $stt++;
                    //$isadmin = $item['isadmin'];
                $isview = $item['isview'];
                $isupdate = $item['isupdate'];
                $donvi = $item['donvi'];
                $id = $item['id'];
                $donvis = explode(';', $donvi);
                $dv = "";
                foreach ($donvis as $itemx) {
                    foreach ($list_donvi as $a)
                    {
                        if ($a['ma_dv'] == $itemx)
                        {
                            if (strlen($dv) >0)  $dv .= ",<br />";
                            $dv .= $a['dv'];
                        }
                    }
                }


                ?>
                <tr>
                 <td><?php echo $stt; ?></td>
                 <td><?php echo $item['username']; ?></td>
                 <td><?php echo $item['name']; ?></td>

                 <td><?php echo $item['role_name']; ?></td>
                 <td><?php echo $dv; ?></td>
                 <td><?php if ($isview ==1 ) echo "<font color='blue'>Có</font>"; else echo "Không"; ?></td>
                 <td><?php if ($isupdate ==1 ) echo "<font color='blue'>Có</font>"; else echo "Không"; ?></td>

                 <td><?php if ($item['status'] ==1 ) echo "<font color='red'>Đang khoá</font>"; else echo "<font color='blue'>Đang hoạt động</font>"; ?></td>
                <td><a href="<?php echo site_url("users/manage/edit/$id"); ?>">Sửa</a></td>
                <td>Xoá</td>
            </tr>
             <?php

         }
         ?>
     </tbody>


    </table>


    <div class="box-show">
       <span class="box-show-icon">
        <i class="icon-chevron-down"></i>
    </span>
    <?php
        function indexOf($var, $arr)
        {
            $ketqua = false;
            foreach ($arr as $item)
            {
                if ($var == $item)
                {
                    $ketqua = true;
                    break;
                }
            }
            return $ketqua;
        }

        $name = "";
        $user = "";
        $role = "";
        $donvi = "";
        $donvixs = array();
        $isview= 0;
        $isupdate = 0;
        $status = 0;
        $isEdit = 0;
        if (!empty($edit))
        {
            $isEdit =1;
            if (!empty($edit->username))
            {
                $user = $edit->username;
            }
            if (!empty($edit->name))
            {
                $name = $edit->name;
            }
            if (!empty($edit->role))
            {
                $role = $edit->role;
            }
            if (!empty($edit->donvi))
            {
                $donvi = $edit->donvi;
                $donvixs = explode(';', $donvi);
            }
            if (!empty($edit->isview))
            {
                $isview = $edit->isview;
            }
            if (!empty($edit->isupdate))
            {
                $isupdate = $edit->isupdate;
            }
            if (!empty($edit->status))
            {
                $status = $edit->status;
            }
        }
    ?>
    <strong><?php
    echo ($isEdit == 0 ? "Thêm tài khoản mới" : 'Sửa tài khoản');
    ?></strong>
    <?php
        $attributes = array('name' => 'myform', 'id' => 'myform');
        if ($isEdit == 0)
     echo form_open('users/manage/add', $attributes);
     else  echo form_open('users/manage/doEdit/', $attributes);?>

     <?php
      if ($isEdit == 1)
      {
        echo '<input type="hidden" name="id_cu" id="id_cu" value="'.$edit->id.'"> ';
      }
      else echo '<input type="hidden" name="id_cu" id="id_cu" value="0"> ';
      ?>
    <div class="box-show-content">
       <table width="100%">
         <tbody><tr>
           <td>Tên tài khoản</td>
           <td><input type="text" name="username" value="<?php echo $user; ?>" autocomplete="off" placeholder="Nhập tên tài khoản"> </td>
           <td>Họ tên</td>
           <td><input type="text" name="name" value="<?php echo $name; ?>" autocomplete="off" placeholder="Nhập họ tên người dùng"> </td>
            <td rowspan="2" colspan="2"><span id="error"><?php if ($this->session->flashdata('error'))
            {
                echo $this->session->flashdata('error');
            }
            ?> </span>
            </td>
       </tr>
       <tr>
           <td>Mật khẩu</td>
           <td><input type="password" name="pass1"  value="" class="" placeholder="Nhập mật khẩu" autocomplete="off" >
           </td>
           <td>Nhập lại MK</td>
           <td><input type="password" name="pass2"  value="" class=""placeholder="Nhập lại mật khẩu">
           </td>

         <!-- <td>Nhà cung cấp</td>
          <td><div class="select2-container" id="s2id_nhacungcap" style="width: 220px;"><a href="javascript:void(0)" onclick="return false;" class="select2-choice" tabindex="-1">   <span></span><abbr class="select2-search-choice-close"></abbr>   <div><b></b></div></a><input class="select2-focusser select2-offscreen" type="text" id="s2id_autogen1"><div class="select2-drop select2-display-none">   <div class="select2-search select2-search-hidden select2-offscreen">       <input type="text" autocomplete="off" autocorrect="off" autocapitilize="off" spellcheck="false" class="select2-input">   </div>   <ul class="select2-results">   </ul></div></div><select name="nhaCungCap" id="nhacungcap" tabindex="-1" class="select2-offscreen">
            <option value=""></option>
            <option value="3">Apple</option><option value="1">Dell</option><option value="2">HP</option>
        </select>
    </td> -->
    </tr>
    <tr>
     <td>Loại tài khoản</td>
     <td><select id="loaitaikhoan" name="role" placeholder="Chọn loại tài khoản">
        <option value=""></option>}
        option
        <?php foreach ($list_role as $abc) {
            if ($abc['role_id'] == $role)
                 echo "<option value='".$abc['role_id']."' selected>".$abc['role_name']."</option>"; else
            echo "<option value='".$abc['role_id']."'>".$abc['role_name']."</option>";
        }?>
    </select></td>
    <td>Đơn vị</td>
    <td colspan="3"><select style="width: 600px;" id="donvi" name="donvis[]" multiple placeholder="Chọn đơn vị (cần chọn loại tài khoản trước)" readonly="readonly" >

        <?php foreach ($list_donvi as $abc) {
            $donvix = "";
            for ($i = 1; $i < $abc['cap']; $i ++)
            {
                $donvix.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
            }
            $donvix.= $abc['dv'];
            if (indexOf($abc['ma_dv'],$donvixs))
                echo "<option value='".$abc['ma_dv']."' selected>".$donvix."</option>";
            else

            echo "<option value='".$abc['ma_dv']."'>".$donvix."</option>";
        }?>
    </select></td>
    </tr>
    <tr>
        <td>Quyền xem</td>
        <td><input type="radio" name="isview" value="0" id= "isviewNo" checked> <a href="javascript:;" onclick="checkX('isviewNo');"><font color='red'>Không</font></a> &nbsp;&nbsp;&nbsp;<input type="radio" name="isview" id="isviewYes" value="1"> <a href="javascript:;" onclick="checkX('isviewYes');"><font color='blue'>Có</font></a></td>
        <td>Quyền cập nhật</td>
        <td><input type="radio" name="isupdate" value="0" id= "isupdateNo" checked> <a href="javascript:;" onclick="checkX('isupdateNo');"><font color='red'>Không</font></a> &nbsp;&nbsp;&nbsp;<input type="radio" name="isupdate" id= "isupdateYes" value="1"> <a href="javascript:;" onclick="checkX('isupdateYes');"><font color='blue'>Có</font></a></td>
        <td>Trạng thái</td>
        <td><input type="radio" name="status" value="0" id= "statusNo" checked> <a href="javascript:;" onclick="checkX('statusNo');"><font color='blue'>Hoạt động</font></a> &nbsp;&nbsp;<input type="radio" name="status" id= "statusYes" value="1"> <a href="javascript:;" onclick="checkX('statusYes');"><font color='red'>Không hoạt động</font></a></td>

    </tr>
    </tbody></table>
    <div style=" text-align:center"><button class="btn btn-success" type="button" name="btnOK" value="Thêm" onclick="submitform();"> Thêm</button></div>
    </div>
    <?php echo form_close(); ?>

    </div>
</div>