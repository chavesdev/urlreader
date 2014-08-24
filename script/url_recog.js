var tipo_conteudo =0;//define o conteudo neutro; 0-neutro, 1-home, 2-artigo, 3-video, 4-imagem;

function ident_Conteudo(texto_box){
var c=0;
var tam = texto_box.length;

	if((texto_box.indexOf("http")==0 && texto_box.lastIndexOf("/")==tam-1)||texto_box.lastIndexOf("index.")!=-1 || texto_box.lastIndexOf("home.")!=-1 || texto_box.lastIndexOf("file")==0 || texto_box.lastIndexOf(".php")!=-1 ||texto_box.lastIndexOf(".htm")!=-1){
	if(texto_box.lastIndexOf("youtube.com/watch")==-1 && texto_box.lastIndexOf("vimeo.com")==-1){
		c = 1;
		}
		
	}
	else if(texto_box.lastIndexOf("youtube.com/watch")!=-1 || texto_box.lastIndexOf("vimeo.com")!=-1){
		c=3;
	}
	return c;
}

var cont=0;
function reconheceKey(){
		tipo_conteudo = ident_Conteudo($("textarea#post-ini").val());

		var objetoAjax = ajaxInit();
		
		var texto = "<img src='img/loading.gif'></img>";
		var qtd = $("#link img").length;
		if(qtd==0){
			if(tipo_conteudo==1){//home
				if($("textarea#post-ini").val()!=""){
				//clearInterval();
				$("#link").append(texto);			
					objetoAjax.onreadystatechange = function(){
						carregaHome(objetoAjax);
						cont=1;
					};
				
					objetoAjax.open("GET","load.php?q="+$("textarea#post-ini").val(),true);
					objetoAjax.send(null);
				}
			}//fim home
			else if(tipo_conteudo==2){}
			else if(tipo_conteudo==3){//video
				if($("textarea#post-ini").val()!=""){
				//clearInterval();
				$("#link").append(texto);
				objetoAjax.onreadystatechange = function(){
						carregaVideo($("textarea#post-ini").val(),objetoAjax);
						cont=1;
					};
				
					objetoAjax.open("GET","load.php?v="+$("textarea#post-ini").val(),true);
					objetoAjax.send(null);

				//loadVideo($("textarea#post-ini").val());
			}
			}
		}
		else{
			return false;
			}
		
		
	
	
}

function carregaHome(requisicao){
	if(requisicao.readyState==4){
		if(requisicao.status==200 || requisicao.status==304){
			var texto_end = requisicao.responseText;
			$("#link img").fadeOut();
			$("#link").children("img").remove();
			$("#link").after(texto_end).fadeIn("slow");
			mostraImg();
			
			
		}
		else{
			
			$("#link").text("Problema na comunicação...");
		}
	}
}
function carregaVideo(url,requisicao){
	if(requisicao.readyState==4){
		if(requisicao.status==200 || requisicao.status==304){
			var texto_end = requisicao.responseText;
			$("#link img").fadeOut();
			$("#link").children("img").remove();
			$("#link").after(texto_end).fadeIn("slow");
			mostraVideo(url);
			
			
		}
		else{
			
			$("#link").text("Problema na comunicação...");
		}
	}
}

function limpa(){
	if($("textarea").val()==""){
		
		$("#link").remove("img").fadeOut().text("").fadeIn();
		//$("#conteudo").fadeOut();
		$("#btn-next, #btn-prev, #contador").fadeOut("slow");
	}
	i=0;
}
function cancelaComment(){
	$("textarea").val()=="";
	$("#link").remove("img").fadeOut().text("").fadeIn();
	$("#conteudo").fadeOut();
	$("#btn-next, #btn-prev, #contador").fadeOut("slow");
}
var i=0;
function pegaDados(){
var texto = $("#link").text();
var conteudo = $("#conteudo").length;
//alert(conteudo);
	if(conteudo==0){
		
		if(i<1){
			reconheceKey();
			window.clearInterval();
			i=1;
		}
	}
	else {
		return false;
	}

}
var tam =0;
function mostraImg(){

tam = imagens.length;

if(tam!=1 && imagens[0]!=undefined){
var locale = $("#titulo a").attr("href");
if(locale.lastIndexOf("index.")!=-1){
	var posix = locale.lastIndexOf("/")+1;
	locale = locale.substr(0,posix);
	
}

var texto_final = "<div id='slider'><div id='mask-gallery'>";
 texto_final += "<span class='chk'><input onclick='mostrainput();' type='checkbox' name='img_sel' value='"+i+"' />Sem miniaturas</span><ul id='gallery'>";
	for(var i=0;i<tam;i++){
		var texto_img = "<li id='"+i+"'><img src='";
		var obj = imagens[i];
		var source = $(obj).attr("src");
		
		var textos_url = source.split("/");
		var texto_temp = textos_url[0];
		
		if(texto_temp=="http:"){
			texto_img+=source;
			
		}
		else{
		
			partes = locale.split("/");
			var index_barra = locale.lastIndexOf("/");
			var tam_locale = locale.length;
			var source_temp = "";
			var a=0;
			for(a=0;a<tam_locale;a++){
				if(a<index_barra){
					source_temp+=locale.charAt(a);
				}
				
			}//fim for
			
			source_temp+="/"+source;
			texto_img+=source_temp;
			

		}
		
		texto_img+="' width='170'/></li>";
		texto_final+=texto_img;
	}
	texto_final+="</ul></div></div>";
	$("div#identifier").append(texto_final);
	var contagem = 1+" de "+tam;
	$("#contador").text(contagem);
	$("#btn-next, #btn-prev, #contador").show();
	}
}

function mostraVideo(url){
	if(url.lastIndexOf("youtube.com")!=-1){//youtube
	var texto_embed = "<iframe allowfullscreen='' frameborder='0' height='200' src='http://www.youtube.com/embed/";
	var codigo_video = url.split("v=");
	var link_final = "";
	if(codigo_video[1].lastIndexOf("&feature")!=-1){
		link_temp = codigo_video[1].split("&feature");
		link_final = link_temp[0];
	}
	else{link_final = codigo_video[1];}
	
	texto_embed+=link_final+"' ";
	texto_embed+="title='YouTube video player' width='300'></iframe>";
	}//fim youtube
	
	else if(url.lastIndexOf("vimeo.com")!=-1){
		var partes = url.split("/");
		var tam = partes.length;
		//alert(tam);
		var code=partes[tam-1];
		var texto_embed = "<iframe src='http://player.vimeo.com/video/"+code+"'  width='300' height='200' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>";//<p><a href='"+url+"'></a>  <a href='http://vimeo.com/g2filmes'></a> <a href='http://vimeo.com'></a>.</p>";
	}
	$("div#identifier").append(texto_embed);
}

var img_selecionada = 0;

$(document).ready(function(){
	window.setInterval("pegaDados()",10);
	$("#btn-next, #btn-prev, #contador").hide();
	$("textarea#post-ini").focus(function(){pegaDados()});
});
//setInterval(pegaDados(),1)
function mostrainput(id){
	var cs = $("input:checkbox").attr("checked");
	if(cs=="checked"){
					var img_selecionada = id;
					$("#btn-next, #btn-prev, #contador").fadeOut("slow");
					$("div#identifier").fadeOut("slow");
		}
	else{
		var img_selecionada = 0;
		$("#btn-next, #btn-prev, #contador").show();
	}
}