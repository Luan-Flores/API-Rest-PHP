<?php

class Autoload{
    public function __construct()
    {
        $files = scandir(__DIR__ . "/");

        foreach($files as $file){
            if (!in_array($file, ['.', '..'])){
                include_once $file; 
            }
        }
    }
}
// listar todos os arquivos e diretórios em um determinado diretório, excluindo as entradas especiais . e ..
// scandir() - lê um diretório e retorna um array contendo os nomes de todos os arquivos e diretórios dentro dele
// __DIR__ - constante mágica do PHP que retorna o caminho completo do diretório do arquivo em execução
//
