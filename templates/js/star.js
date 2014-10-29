window.onload = function(){
	$("#show_indes").show(500);
	$("#show_add").hide(500);
	$("#show_changePass").hide(500);
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange = function(){
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
			document.getElementById("result_index").innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("get","./ajax.php?action=table",true);
	xmlhttp.send();
}
$(document).ready(function(){
	$("#JQ_index").click(function(){
		$("#show_add").hide(500);
		$("#show_changePass").hide(500);
		$("#show_index").show(500);
	});
	$("#JQ_add").click(function(){
		$("#show_index").hide(500);
		$("#show_changePass").hide(500);
		$("#show_add").show(500);
	});
	$("#JQ_changePass").click(function(){
		$("#show_index").hide(500);
		$("#show_add").hide(500);
		$("#show_changePass").show(500);
	});
	$("#ajax_addNumber").click(function(){
		var xmlhttp=new XMLHttpRequest();
		xmlhttp.onreadystatechange = function(){
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
				$("#resukt_add").html(xmlhttp.responseText);
				$("#ajax_number").val("");
			}
		}
		xmlhttp.open("get","./ajax.php?action=add&number="+$("#ajax_number").val(),true);
		xmlhttp.send();
	});
	$("#ajax_changePass").click(function(){
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function(){
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
				$("#result_changePass").html(xmlhttp.responseText);
			}
		}
		xmlhttp.open("get","./ajax.php?action=changepass&oldpass="+$("#ajax_oldPass").val()+"&newpass="+$("#ajax_newPwd").val(),true);
		xmlhttp.send();
	});
});

