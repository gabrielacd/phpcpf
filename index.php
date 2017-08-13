<?php
$resultado_api = file_get_contents('https://api.punkapi.com/v2/beers/random');
$dados = json_decode($resultado_api);
$name = $dados[0]->name;
$value = $dados[0]->method->fermentation->temp->value;
$malt = $dados[0]->ingredients->malt[0]->name;
echo 'Name: ' . $name . '<br/>';
echo 'Value: ' . $value . '<br/>';
echo 'Malt: ' . $malt . '<br/>';

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"http://atualizando-cpf-gabrielacdiogo384199.codeanyapp.com/post.php");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
            "user=valor");

//include 'post.php';*
// in real life you should use something like:
// curl_setopt($ch, CURLOPT_POSTFIELDS, 
//          http_build_query(array('postvar1' => 'value1')));

// receive server response ...
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec ($ch);
$dado = json_decode($server_output);
//var_dump($dado->token);
curl_close ($ch);
?>
<form method="post"> 
   <div>
    <label for="cpf">CPF</label>
  </div>
  <div>
    <input type="text" name="cpf" id="cpf" />
  </div>
  <div class="button">
    <button type="submit">Validar</button>
  </div>
</form>
<?php
function validar_cpf($cpf)
{
	$cpf = preg_replace('/[^0-9]/', '', (string) $cpf);
	// Valida tamanho
	if (strlen($cpf) != 11)
		return false;
	// Calcula e confere primeiro dígito verificador
	for ($i = 0, $j = 10, $soma = 0; $i < 9; $i++, $j--)
		$soma += $cpf{$i} * $j;
	$resto = $soma % 11;
	if ($cpf{9} != ($resto < 2 ? 0 : 11 - $resto))
		return false;
	// Calcula e confere segundo dígito verificador
	for ($i = 0, $j = 11, $soma = 0; $i < 10; $i++, $j--)
		$soma += $cpf{$i} * $j;
	$resto = $soma % 11;
	return $cpf{10} == ($resto < 2 ? 0 : 11 - $resto);
}
?>
<?php
if(isset($_POST['cpf'])){
  $cpf = $_POST['cpf'];
 if(validar_cpf($cpf)){
   echo 'cpf valido';
 }
}
?>
