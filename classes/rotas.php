<?php

class Rotas {
    private $listaRotas = [''];
    private $listaCallback = [''];
    private $listaProtecao = [''];

    public function add($method, $route, $callback, $protection){
        $this->listaRotas[] = strtoupper($method).':'.$route;     
        $this->listaCallback[] = $callback;
        $this->listaProtecao[] = $protection;
        
        return $this;
    }
    public function ir($route){
        $param = '';
        $callback = '';
        $protection = '';
        $methodServer = $_SERVER['REQUEST_METHOD'];
        
        // $methodServer = isset($_POST['_method']) ? $_POST['_method'] : $methodServer;
        // null coalescing operator 

        
        // $methodServer = $_POST['_method'] ?? $methodServer;
        $route = $methodServer.':/'.$route;
       

        
        if (substr_count($route, '/') >= 3){
            $param = substr($route, strrpos($route, "/") + 1);
            $route = substr($route, 0, strrpos($route, "/"))."/[PARAM]";
        }

        $index = array_search($route, $this->listaRotas);
        if ($index > 0) {
            $callback = explode('::', $this->listaCallback[$index]);
            $protection = $this->listaProtecao[$index];
        }
        
        $class = $callback[0] ?? '';
        $method = $callback[1] ?? '';


        
        if (class_exists($class))
            {
            if(method_exists($class, $method))
                {
                $instanciaClass = new $class();
                if($protection){
                    $verify = new Usuarios();
                    if($verify->verificar()){
                        return call_user_func_array(
                            array($instanciaClass, $method),
                            array($param)
                        );
                    } else{
                        echo json_encode(["DADOS" => "Token inválido"]);
                    }
                }else{
                    return call_user_func_array(
                        array($instanciaClass, $method),
                        array($param)
                    );
                }
            } else{
                $this->naoExiste();
            }
        }else{
            $this->naoExiste();
        }
    }
    public function naoExiste(){
        http_response_code(404);
    }
}