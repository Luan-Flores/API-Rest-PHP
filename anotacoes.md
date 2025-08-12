$valor = '';

null coalescing operator (?:)
**se a variavel $valor != null, use esse o valor dela**
**se $valor = null, use a string "Sem Valor"**
$teste = json_encode(["chave" => $valor ?: "Sem Valor"]);

echo $teste; // resultado: "Sem Valor"

if ($method == "POST" && $\_POST['_method'] == "PUT"){
include_once "put.php";
}

segurança / login
import JWT (JSON Web Token) - Autenticação
