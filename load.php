<?php
if(isset($_GET['q'])){
$tex = $_GET['q'];

$temp_1 = pegaTitulo($tex);
$result = fix_Pontuacao($temp_1);
$img_s = pegaImagens($tex);
$descricao = pegaDescricao($tex);
if($descricao==''){
$descricao='Sem descricao... :P';
}
print("
<div id='conteudo'>
	<div id='identifier'></div>
	<div id='titulo'><a href='".$tex."'>".$result."</a></div>
	<div id='texto'>".$descricao."</div>
	<div id='fechar'><a title='Cancelar' onclick='cancelaComment();' href=''>x</a></div>
</div>");

print("<script type='text/javascript'>$img_s</script>");
}

else if(isset($_GET['v'])){
	$link_video = $_GET['v'];
	$temp_1 = pegaTitulo($link_video);
	$result = fix_Pontuacao($temp_1);
	$descricao = pegaDescricao($link_video);
	if($descricao==''){
	$descricao='Sem descricao... :P';
	}
	print("
	<div id='conteudo'>
		<div id='identifier'></div>
		<div id='titulo'><a href='".$link_video."'>".$result."</a></div>
		<div id='texto'>".$descricao."</div>
		<div id='fechar'><a title='Cancelar' onclick='cancelaComment();' href=''>x</a></div>
	</div>");
	
}
else{
echo "Texto vazio...";
}
unset($_GET['q']);

function pegaTitulo($pagina){
$ch = curl_init();
// informar URL e outras fun��es ao CURL
curl_setopt($ch, CURLOPT_URL, $pagina);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Acessar a URL e retornar a sa�da
$arquivo = curl_exec($ch);
// liberar
curl_close($ch);

// Imprimir a saída

$tam = strlen($arquivo);
$titulo = "";
$aux=0;
$i=0;

while($i<$tam){
	if(substr($arquivo,$i,7)=="<title>"){
		$i+=7;
		$temp = substr($arquivo,$i,1);
		$index_char = $temp;
		
		do{
			$i+=1;
			$index_char = substr($arquivo,$i,8);
				if($index_char=="</title>"){
					break;
				}
				else{
					$temp .= substr($arquivo,$i,1);
				}
		}while($index_char!="<");
		
		break;
	}
	$i++;
}

$titulo = $temp;
return $titulo;
}

function fix_Pontuacao($texto){
$texto_semi = "";
$char_semi = "";
	for($i=0;$i<strlen($texto);$i++){
		$char_semi = substr($texto,$i,1);
		$char_semi = ($char_semi=="�")? "&Aacute;": $char_semi;
		$char_semi = ($char_semi=="�")? "&Eacute;": $char_semi;
		$char_semi = ($char_semi=="�")? "&Ecirc;" : $char_semi;
		$char_semi = ($char_semi=="�")? "&Iacute;": $char_semi;
		$char_semi = ($char_semi=="�")? "&Oacute;": $char_semi;
		$char_semi = ($char_semi=="�")? "&Uacute;": $char_semi;
		
		$char_semi = ($char_semi=="�")? "&aacute;": $char_semi;
		$char_semi = ($char_semi=="�")? "&eacute;": $char_semi;
		$char_semi = ($char_semi=="�")? "&ecirc;" : $char_semi;
		$char_semi = ($char_semi=="�")? "&iacute;": $char_semi;
		$char_semi = ($char_semi=="�")? "&oacute;": $char_semi;
		$char_semi = ($char_semi=="�")? "&uacute;": $char_semi;
		
		$texto_semi .= $char_semi;
	}
	
	return $texto_semi;
}

function pegaImagens($pagina){
    //carrega as imagens do site
$ch = curl_init();
// informar URL e outras funções ao CURL
curl_setopt($ch, CURLOPT_URL, $pagina);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Acessar a URL e retornar a sa�da
$arquivo = curl_exec($ch);
// liberar
curl_close($ch);
// Imprimir a saida
//echo $output;
//$arquivo = file_get_contents($pagina);
$tam = strlen($arquivo);
$i=0;
$vetor_js ="var imagens = new Array('";
$qtd_img=0;
$tam-=1;
	while($i<$tam && $qtd_img!=-1){
	
		if(substr($arquivo,$i,4)=="<img"){
			
			$temp = substr($arquivo,$i,1);
			$temp_aux = $temp;
			do{
				$i++;
				$temp_aux = substr($arquivo,$i,1);
				if($temp_aux==">"){
				$temp .= substr($arquivo,$i,1);
					//break;
				}
				else{
				$temp .= substr($arquivo,$i,1);
				}
				
			}while($temp_aux!=">");
			
			if($qtd_img==0){
				$vetor_js.=$temp;
			}
			else{
				$vetor_js .=" ' , ' " .$temp;
			}
			$qtd_img++;
		}
		$i++;
	}
$vetor_js .="');";

return $vetor_js;
}

function pegaDescricao($pagina){
$ch = curl_init();
// informar URL e outras fun��es ao CURL
curl_setopt($ch, CURLOPT_URL, $pagina);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Acessar a URL e retornar a sa�da
$arquivo = curl_exec($ch);
// liberar
curl_close($ch);
// Imprimir a saída
//echo $output;
//$arquivo = file_get_contents($pagina);
$tam = strlen($arquivo);
$i=0;
$desc_inicial = '';
	while($i<$tam){
	
			if(substr($arquivo,$i,22)=='description" content="'){
				$i+=22;
				do{
					$temp = substr($arquivo,$i,1);
					
					if($temp=='"'){
						break;
					}
					else{
						$desc_inicial.=$temp;
					}
					$i++;
				}while($temp!='"');
				
				break;
			}//fim if
			else if(substr($arquivo,$i,21)=='description content="'){
				$i+=21;
				do{
					$temp = substr($arquivo,$i,1);
					
					if($temp=='"'){
						break;
					}
					else{
						$desc_inicial.=$temp;
					}
					$i++;
				}while($temp!='"');
				
				break;
			}
			$i++;
	}//fim while
	
	return $desc_inicial;
}//fim pegaDescricao
?>
