<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Identificador de url</title>
<script src="jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="ajaxInit.js"></script>
<script type="text/javascript" src="script/jquery.scrollTo.js"></script>
<script type="text/javascript" src="script/script_galeria_link.js"></script>
<script type="text/javascript" src="script/url_recog.js"></script>
</head>
<style>
textarea{resize:none;}
body{font-family:Arial, Helvetica, sans-serif; font-size:16px;}
#link{overflow:hidden;}
#link img{width:300px; height:200px; margin-left:-40px; margin-top:-50px;}

/*Estilo do conteudo*/
#conteudo{ height:210px; width:660px; /*background:#CCCCCC;*/box-shadow: 0 5px 20px #888;-webkit-box-shadow: 0 5px 20px #888;-moz-box-shadow: 0 5px 20px #888;}
#conteudo #identifier{float:left; height:auto; width:auto; /*background:#39c;*/ margin-right:4px; position:relative}
#fechar{ font-family:Verdana, Arial, Helvetica, sans-serif; font-size:15px; width:15px; height:15px; float:right; margin-top:-50px; left:655px; position:absolute; font-weight:bold; color:#000;}
#fechar a{ text-decoration:none; color:#000; cursor:pointer}
#fechar a:hover{ color:#036;}
#conteudo #titulo{padding-top:10px; margin-right:15px;}
#conteudo #titulo a{font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#006633; padding:5px;top:8px; text-decoration:none;}
#conteudo #texto{ font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000;padding:2px;}

#btn-prev{width:20px; height:15px; position:absolute; overflow:visible; margin-left:10px; cursor:pointer; float:left; font-size:18px; margin-top:-38px;}
#contador{width:70px; height:15px;  position:relative; margin-left:40px; cursor:pointer; font-size:16px; margin-top:-38px; overflow:visible; text-align:center;}
#btn-next{width:20px; height:12px;  position:relative; margin-left:120px; cursor:pointer; font-size:18px; margin-top:-15px; overflow:visible;}
#btn-next:hover{color:#FF0000;}
#slider {
	/* You MUST specify the width and height */
	padding-top:0px;
	width:200px;
	height:185px;
	position:relative;	
	overflow:hidden;
}
#mask-gallery {	
	overflow:visible;
}

#gallery {
	/* Clear the list style */
	list-style:none;
	margin:0;
	padding:0;	
	/* width = total items multiply with #mask gallery width */
	width:700px;
	
	overflow:hidden;
}
#gallery li {
		/* float left, so that the items are arrangged horizontally */
		float:left;
		list-style:none;
		width:200px;
		height:170px;
	
	}
#gallery li img{
margin-top:0px;
margin-left:5px;
overflow:hidden;
}
.chk{ font-size:13px; font-family:Arial, Helvetica, sans-serif;}
</style>
<body>
Publicar
<br />
<form  id="form-act" action="load.php" method="get">
<textarea id="post-ini" rows="2" cols="45" onblur="pegaDados();" onfocus="pegaDados();" onclick="pegaDados();" onpaste="pegaDados();" onkeyup="limpa();"></textarea><br />
</form>

<div id="link"></div><br />
<div id='btn-prev'>&laquo;</div><div id="contador" align="center">1/5</div><div id='btn-next'>&raquo;</div>
</body>
</html>
