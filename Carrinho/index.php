<?php
/**
 * Criar um script que guarda um carrinho de compras onde o usuario
 * Vai selecionar os produtos e guardar na sessao 
 */
 require_once 'vendor/autoload.php';

 session_start();

 /**
  * Obj : Criar uma rota para as requisições e chamar um controlador para executar tal request
  * 1 - Pegar a Query String   |  |______
  * 2 - Verificar se ele existe|  |______|
  *                            |__| 
  *2.1 - Se não existir Atribui por padão a rota index
        * 2.2 - Se existir fazer o cenario      ;)  (:-()
  */
 $rotas = [
     'index' => 'main@montra',
     'login' =>  'main@index',
     'login_post' => 'main@login_post',
     'sobre' => 'main@sobre',
     'add_produto' => 'main@AddProduto',
     'checkout' => 'main@checkout',
     'apagar_sessao' => 'main@apagar_sessao',
     'pagamento_insert_db' => 'main@pagamento_insert_db'
 ];

 $query = @$_GET['k'];
 $def = $query;
 if(!key_exists($query,$rotas) || !isset($query))
 { //
    $def = "index";
 }
  //Variavel para guardar o metodo e o seu Controller
     $intermediario = explode("@",$rotas[$def]);
     $controler = "src\\controller\\".ucfirst($intermediario[0]);
     $action = $intermediario[1];
     (new $controler)->$action();

 