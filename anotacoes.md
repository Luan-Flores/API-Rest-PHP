$valor = '';

null coalescing operator (?:)
**se a variavel $valor != null, use esse o valor dela**
**se $valor = null, use a string "Sem Valor"**
$teste = json_encode(["chave" => $valor ?: "Sem Valor"]);

echo $teste; // resultado: "Sem Valor"

// método UPDATE
if ($method == "POST" && $\_POST['_method'] == "PUT"){
include_once "put.php";
}

segurança / login
import JWT (JSON Web Token) - Autenticação

trocando o Insomnia pela extensão REST Client - testar, simular e depurar requisições HTTP
arquivo (.http)

//update - simulacao usando o arquivo .http + extensao REST client
POST http://localhost/api/clientes/atualizar/13 HTTP/1.1
Content-Type: application/x-www-form-urlencoded
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MSwibmFtZSI6Im5ldG8gZnJlbnRlIiwiZXhwaXJlc19pbiI6MTc1NTQyNDEwOH0.
UJaZCUS7NyZYVMaQ7osXCL1-cMySQrgja52YYJhIGck

\_method=PUT&nome=Novo%20Nome%20do%20Cliente&email=novo.email@exemplo.com

teste urlencoding oi
teste%20urlencoding%20oi
Note: The JavaScript function encodes space as %20.

para fazer o deploy
usando RENDER + DOCKER
conecta o arquivo da minha API
com dois arquivos adicionais na raiz: Dockerfile e .dockerignore
como o RENDER não suporta diretamente o MYSQL(database inicial do projeto)
migrar para o POSTGRESQL

psql "postgresql://banco1_ezys_user:Vckemrx37TjQjFfIv4obZFGJ56aRZwKW@dpg-d2hhdrjipnbc73dqvf50-a.oregon-postgres.render.com/banco1_ezys?sslmode=require"

no terminal ^^^^^^ gitbash para entrar no banco
banco1_ezys=>
banco1_ezys=> \dt mostra as tabelas
\dt, \q, CREATE TABLE ...
