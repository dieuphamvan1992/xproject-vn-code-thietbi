function getXmlHttpRequest(){
	var xmlhttp;
	if (window.XMLHttpRequest){
		xmlhttp = new XMLHttpRequest();
	}else{
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}

	return xmlhttp;
}

function getform(url){
    var xmlhttp = getXmlHttpRequest();
	xmlhttp.onreadystatechange = function(){
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
			document.getElementById("result").innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET", url, true);
	xmlhttp.send("");
}