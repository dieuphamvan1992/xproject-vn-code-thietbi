function appendText(index){
    var ten = $("#ten").val();
    var qg = $("#qg").val();
    var sl = $("#sl").val();
    var stbh = $("#stbh").val();
    var cpld = $("#cpld").val();
    var cpvc = $("#cpvc").val();
    var cpct = $("#cpct").val();
    var kh = $("#kh").val();
    var dg = $("#dg").val();
    
    /**
     * Kiểm tra thiết bị nhập có thiếu thông tin số lượng hay không?
     */
    var test_sl = parseInt(sl);
    if (!isNaN(test_sl)){
        if (test_sl <= 0){
            alert("Số lượng thiết bị phải lớn hơn 0");
            return;
        }
    }else{
        alert("Số lượng thiết bị chưa được nhập!");
        return;
    }
    var cp = cpld + " , " + cpvc + " , " + cpct;
    var txt =   '<tr id="' + index + '">'
                    + '<td data="' + ten + '">' + $("#ten option:selected").text() + '</td>'
                    + '<td data="' + qg + '">' + $("#qg option:selected").text() + '</td>'
                    + '<td>' + sl + '</td>'
                    + '<td>' + stbh + '</td>'
                    + '<td>' + cpld + '</td>'
                    + '<td>' + cpvc + '</td>'
                    + '<td>' + cpct + '</td>'
                    + '<td>' + kh + '</td>'
                    + '<td>' + dg + '</td>'
                    + '<td>'
                    +    '<input type="button" onclick="readText(' + index + ')" value=Sửa name="sua" class="btn" />'
					+ '</td>'
					+ '<td>'
                    +    '<input type="button" onclick="removeText(' + index + ')" value="Xóa" name="xoa" class="btn" />'
                    + '</td>'
                + '</tr>';
    $("#customers").children("tbody").append(txt);
}

function removeText(id){
    var x = document.getElementById(id);
    x.parentNode.removeChild(x);
}

function readText(id){
    var tb = document.getElementById(id);
    var tag_tb = tb.getElementsByTagName('td');
    var ten = tag_tb[0].getAttribute("data");
    var qg = tag_tb[1].getAttribute("data");
    var sl = tag_tb[2].innerHTML;
    var stbh = tag_tb[3].innerHTML;
    var cpld = tag_tb[4].innerHTML;
    var cpvc = tag_tb[5].innerHTML;
    var cpct = tag_tb[6].innerHTML;
    var kh = tag_tb[7].innerHTML;
    var dg = tag_tb[8].innerHTML;
    
    $("#ma").val(id);
    $("#ten").val(ten);
    $("#qg").val(qg);
    $("#sl").val(sl);
    $("#stbh").val(stbh);
    $("#cpld").val(cpld);
    $("#cpvc").val(cpvc);
    $("#cpct").val(cpct);
    $("#kh").val(kh);
    $("#dg").val(dg);
    
    $("#edit").show();
}

function editText(){
    var ma = $("#ma").val();
    var ten = $("#ten").val();
    var qg = $("#qg").val();
    var sl = $("#sl").val();
    var stbh = $("#stbh").val();
    var cpld = $("#cpld").val();
    var cpvc = $("#cpvc").val();
    var cpct = $("#cpct").val();
    var kh = $("#kh").val();
    var dg = $("#dg").val();
    
    var cp = cpld + " , " + cpvc + " , " + cpct;
    var tb = document.getElementById(ma);
    var tag_tb = tb.getElementsByTagName('td');
    tag_tb[0].setAttribute("data", ten);
    tag_tb[0].innerHTML = $("#ten option:selected").text();
    tag_tb[1].setAttribute("data", qg);
    tag_tb[1].innerHTML = $("#qg option:selected").text();
    tag_tb[2].innerHTML = sl;
    tag_tb[3].innerHTML = stbh;
    tag_tb[4].innerHTML = cpld;
    tag_tb[5].innerHTML = cpvc;
    tag_tb[6].innerHTML = cpct;
    tag_tb[7].innerHTML = kh;
    tag_tb[8].innerHTML = dg;
    
    $("#edit").hide();
}

function changeKhuNha(){
    var tt = $("#khu_nha option:selected").attr("tt");
    $("#kh1, #kh2").remove();
    if (tt == 0){
        var txt = '<td id="kh1"><label>Phòng</label></td>' +
                '<td id="kh2"><input type="text" name="phong" id="phong" /></td>';
        $("#change").append(txt);
    }else{
        var txt = '<td id="kh1"><label>Cho mượn</label></td>' +
                '<td id="kh2"><input type="checkbox" name="cho_muon" id="cho_muon" /></td>';
        $("#change").append(txt);
    }
}

function onlyNumber(evt){
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    if (key == 8) return;
    key = String.fromCharCode(key);
    var regex = /[0-9]|\./;
    if (!regex.test(key)){
        theEvent.returnValue = false;
        if (theEvent.preventDefault) theEvent.preventDefault();
    }
}

function onlyInteger(evt){
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    if (key == 8) return;
    key = String.fromCharCode(key);
    var regex = /[0-9]/;
    if (!regex.test(key)){
        theEvent.returnValue = false;
        if (theEvent.preventDefault) theEvent.preventDefault();
    }
}

function nhapThang(link_in, link_out){
        
    /**
     * Kiểm tra số hóa đơn đã được điền đầy đủ chưa
     */
    var shd_str = "Số hóa đơn chưa được nhập";
    if ($('#so_hd').val() == ''){
        alert(shd_str);
        return;
    }
    
    var tbl = document.getElementById('customers');
    var ls = tbl.getElementsByTagName('tr');
    /**
     * Kiểm tra hóa đơn đã có thiết bị hay chưa
     */
    if (ls.length == 1){
        alert("Chưa có thiết bị nào được nhập!");
        return;
    }
    var sl = 0;
    for (i = 1; i < ls.length; i++){
        var ds = ls[i].getElementsByTagName('td');
        var temp = ds[2].innerHTML;
        if (!isNaN(parseInt(temp))){
            sl = sl + parseInt(temp);
        }
    }
    var str = "Bạn có chắc chắn với những thông tin trên?";
    if (sl > 100){
        str = str + "\n\nCảnh báo: Số lượng của thiết bị vượt quá 100!" +
            "\n\nTổng số thiết bị: " + sl;
    }else if (sl == 0){
        str = str + "\n\nCảnh báo: Số lượng của thiết bị bằng 0!";
    }
    var test = confirm(str);
    if (test == false){
        return;
    }
    
    var txt ="{";
    var tbl = document.getElementById('customers');
    var ls = tbl.getElementsByTagName('tr');
    for (i = 1; i < ls.length; i++){
        var ds = ls[i].getElementsByTagName('td');
        var ten_ = ds[0].getAttribute("data");
        var qg_ = ds[1].getAttribute("data");
        var sl_ = ds[2].innerHTML;
        var stbh_ = ds[3].innerHTML;
        var cpld_ = ds[4].innerHTML;
        var cpvc_ = ds[5].innerHTML;
        var cpct_ = ds[6].innerHTML;
        var kh_ = ds[7].innerHTML;
        var dg_ = ds[8].innerHTML;

        txt = txt +
            '"' + i + '"' + ':{' +
            '"ten" : "' + ten_ + '", ' +
            '"qg" : "' + qg_ + '", ' +
            '"sl" : "' + sl_ + '", ' +
            '"stbh" : "' + stbh_ + '", ' +
            '"cpld" : "' + cpld_ + '", ' +
            '"cpvc" : "' + cpvc_ + '", ' +
            '"cpct" : "' + cpct_ + '", ' +
            '"kh" : "' + kh_ + '", ' +
            '"dg" : "' + dg_ + '"' +
            "}";
        if (i != ls.length -1){
            txt = txt + ", ";
        }
    }
    txt = txt + "}";
    var tt = 0;
    if ($("#cho_muon").is(':checked')){
        tt = 1;
    }

    $.post(link_in,
    {
        csrf_test_name : $("input[name='csrf_test_name']").val(),
        so_hd : $("#so_hd").val(),
        nha_cung_cap : $("#nha_cung_cap").val(),
        don_vi_nhan : $("#don_vi_nhan").val(),
        khu_nha : $("#khu_nha").val(),
        nguon_von : $("#nguon_von").val(),
        phong : $("#phong").val(),
        cho_muon : tt,
        thietbi : txt,
        submit : "ok"
    },
    function(data, status){
        alert("Data: " + data + "\nStatus: " + status);
        window.location.assign(link_out);
    });
}

function themTen(link_in){
    var ten_t = $('#ten_moi').val();
    var loai_o = $("#loai").val();
    var loai_n = $('#loai_moi').val();
    
    if (($.trim(ten_t) == "") || ((loai_o == "")&&($.trim(loai_n) == ""))){
        return;
    }
    
    $.post(link_in,
    {
        csrf_test_name : $("input[name='csrf_test_name']").val(),
        ten_thiet_bi : $('#ten_moi').val(),
        don_vi_tinh : $('#don_vi_tinh').val(),
        loai : $("#loai").val(),
        loai_moi : $('#loai_moi').val(),
        new_ten : "new"
    },
    function(data, status){
        if (status = 'success'){
            var obj = eval ("(" + data + ")");
            var ten = '<option value="'+obj.id_ten+'">'+$('#ten_moi').val()+'</option>';
            $("#ten").append(ten);
            if ($("#loai").find("option[value="+obj.id_loai+"]").val() == null){
                var loai = '<option value="'+obj.id_loai+'">'+$('#loai_moi').val()+'</option>';
                $('#loai').append(loai);
            }
            $("#s2id_ten").find("span").html($('#ten_moi').val());
        }else{
            alert("Data: " + data + "\nStatus: " + status);
        }
    });
}

/**
 * Main() tương tác với người dùng
 */
var index = 1;
$(document).ready(function(){
   $("#add").click(function(){
        appendText(index);
        index++;
   });

   $("#edit").hide();

   $("#khu_nha").change(function(){
        changeKhuNha();
   });

   $("#edit").click(function(){
        editText();
   });
   
   $('[chosen]').select2();
   
   $('#new').click(function(){
        $('#them_thiet_bi').modal('show');
   });
   
   $("#loai").click(function(){
        $("#loai_moi").val("");
   });
   
   $("#loai_moi").focus(function(){
        $("#s2id_loai").find("span").html("");
   });
});
