<?php
function fix_Pontuacao($texto){
$texto_semi = "";
$char_semi = "";
	for($i=0;$i<strlen($texto);$i++){
		$char_semi = substr($texto,$i,1);
		if($char_semi=="Á"){
			$char_semi="&Aacute;";
		}
		
		$texto_semi .= $char_semi;
	}
	
	return $texto_semi;
}
?>
