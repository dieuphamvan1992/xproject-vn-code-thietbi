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
    var cp = 0;
    if (!isNaN(parseInt(cpld))){
        cpld = parseInt(cpld);
        cp = cp + cpld;
    }else{
        cpld = 0;
    }
    if (!isNaN(parseInt(cpvc))){
        cpvc = parseInt(cpvc);
        cp = cp + cpvc;
    }else{
        cpvc = 0;
    }
    if (!isNaN(parseInt(cpct))){
        cpct = parseInt(cpct);
        cp = cp + cpct;
    }else{
        cpct = 0;
    }
    
    var txt =   '<tr id="' + index + '">'
                    + '<td data="' + ten + '">' + $("#ten option:selected").text() + '</td>'
                    + '<td data="' + qg + '">' + $("#qg option:selected").text() + '</td>'
                    + '<td>' + sl + '</td>'
                    + '<td>' + stbh + '</td>'
                    + '<td ld="' + cpld + '" vc="' + cpvc + '" ct="' + cpct + '">' + (cp == 0? '' : cp) + '</td>'
                    + '<td>' + kh + '</td>'
                    + '<td>' + dg + '</td>'
                    + '<td>'
                    +    '<input type="button" onclick="readText(' + index + ')" value=Sửa name="sua" />'
                    +    '<input type="button" onclick="removeText(' + index + ')" value="Xóa" name="xoa" />'
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
    var cpld = tag_tb[4].getAttribute('ld');
    var cpvc = tag_tb[4].getAttribute('vc');
    var cpct = tag_tb[4].getAttribute('ct');
    var kh = tag_tb[5].innerHTML;
    var dg = tag_tb[6].innerHTML;
    
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
    var cp = 0;
    if (!isNaN(parseInt(cpld))){
        cpld = parseInt(cpld);
        cp = cp + cpld;
    }else{
        cpld = 0;
    }
    if (!isNaN(parseInt(cpvc))){
        cpvc = parseInt(cpvc);
        cp = cp + cpvc;
    }else{
        cpvc = 0;
    }
    if (!isNaN(parseInt(cpct))){
        cpct = parseInt(cpct);
        cp = cp + cpct;
    }else{
        cpct = 0;
    }
    
    var tb = document.getElementById(ma);
    var tag_tb = tb.getElementsByTagName('td');
    tag_tb[0].setAttribute("data", ten);
    tag_tb[0].innerHTML = $("#ten option:selected").text();
    tag_tb[1].setAttribute("data", qg);
    tag_tb[1].innerHTML = $("#qg option:selected").text();
    tag_tb[2].innerHTML = sl;
    tag_tb[3].innerHTML = stbh;
    tag_tb[4].innerHTML = cp;
    tag_tb[4].setAttribute("ld", cpld);
    tag_tb[4].setAttribute("vc", cpvc);
    tag_tb[4].setAttribute("ct", cpct);
    tag_tb[5].innerHTML = kh;
    tag_tb[6].innerHTML = dg;
    
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
    var key = theEvent.keyCode || theEvent.which
    key = String.fromCharCode(key);
    var regex = /[0-9]|\./;
    if (!regex.test(key)){
        theEvent.returnValue = false;
        if (theEvent.preventDefault) theEvent.preventDefault();
    }
}