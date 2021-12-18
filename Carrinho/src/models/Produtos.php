<?php

namespace src\models;

use src\helpers\Database;

use function PHPSTORM_META\type;

class Produtos
{
    /**
     * OBJ -> Retirar os Ids do array e usar para fazer consulta na base de dados
     * para pegar os restantes dados(Preço,nome,estoque)
     *
     *Depois de pegar vamos juntar um campo a mas que vai conter a quantidade
     *
     */
    public function Desfragmentar()
    {
        if(!isset($_SESSION['carrinho'])){
             error_reporting(E_ERROR);
              return;
        }
        $items = $_SESSION['carrinho'];
        $compra = [];

        foreach ($items as $key => $value) {
            //Consultar
            $retorno = Database::select("SELECT * FROM tb_produtos WHERE id_produto = {$key}");
            // Antes de pazer pushs adda o campo quantidade 
            $retorno[0]['quantidade'] = $value;

            $retorno[0]['sub_total'] = $value *  $retorno[0]['preco'] ;
            //Vai add cada elemento do retorno ao array compra
            foreach ($retorno as $chave => $val) {
                array_push($compra, $val);
              
            }
    
         }
        //Ja tenho o array com as informações do banco de Dados
         //===============================================================
   
         return $compra;
    }

    public function Salvar()
    {

    }
}
