function ajaxInit(){
var objetoAjax = false;
if(window.XMLHttpRequest){
	objetoAjax = new XMLHttpRequest();
	}
	else if(window.ActiveXObject){
			try{
		objetoAjax = new ActiveXObject("Msxml2.XMLHTTP");
	}catch(e){
		try{
			objetoAjax = new ActiveXObject("Microsoft.XMLHTTP");
		}catch(ex){
			objetoAjax = false;
			}
		}
	}

return objetoAjax;
}