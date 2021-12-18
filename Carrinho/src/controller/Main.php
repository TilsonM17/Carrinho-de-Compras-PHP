<?php

namespace src\controller;

use src\helpers\Database;
use src\helpers\Views;
use src\models\Usuarios;


class Main
{

    public function index()
    {

        Views::layout([
            'fragmentos/header',
            'index',
            'fragmentos/footer',
        ]);

    }
    public function login_post()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            $_SESSION['erro'] = "Submeta o formulario! Idiota";
            header('location:?k=index');
            return;
        }
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $senha = $_POST['senha'];
        $index = (new Usuarios)->Logar($email, $senha);
        if ($index != true) {
            $_SESSION['erro'] = "O seu Logi esta errado!";
            header("location:?k=index");
            return;
        } else {
            $_SESSION['id_usuario'] = $index[0]['id_usuario'];
            header("location:?k=pagamento_insert_db");
        }
    }

      public function pagamento_insert_db(){
           if(!isset($_SESSION['compra_final']))
                  header("location:?k=index");
        $total_compra = 0;
            //=============================================
      foreach ($_SESSION['compra_final'] as $key => $value) {
            $total_compra += $value['sub_total'];      
         }

      Database::insert("INSERT INTO tb_venda VALUES(
                  0,
                 :id,
                 :montante,
                 :data_at
             )",[
                 ':id' => $_SESSION['id_usuario'],
                 ':montante' => $total_compra,
                 ':data_at' => date('Y:m:d G:s:i')
                 ]);

     $venda = Database::select("SELECT MAX(id_venda) as venda FROM tb_venda ORDER BY id_venda DESC ");    
                    
    foreach ($_SESSION['compra_final'] as $key => $value) {
              Database::insert("INSERT INTO tb_item VALUES(
                  0,
                  :id,
                  :nome,
                  :preco,
                  :sub_total
              );",[
                  ':id' => $venda[0]['venda'],
                  ':nome' => $value['nome'],
                  ':preco' => $value['preco'],
                  ':sub_total' => $value['sub_total']
              ]);
             }

                echo <<<FINAL
<h2>Compra realizada com sucesso!</h2>
<br>
<a href='?k=index'>Voltar para o home</a>

FINAL;

session_destroy();
session_unset();


        }

    public function montra()
    {

        $dado = Database::select("SELECT * FROM tb_produtos");

        Views::layout([
            'fragmentos/header',
            'loja',
            'fragmentos/footer',
        ]);

    }

    public function sobre()
    {
        /*unset($_SESSION['carrinho']);
        unset($_SESSION['Total_Carinho']);*/

        if (isset($_SESSION['carrinho']) or @$_SESSION['Total_Carinho']) {
            print_r($_SESSION['carrinho']);
            echo "<hr>";
            print_r($_SESSION['Total_Carinho']);
        } else {
            echo "<h1>Nada a Relatar </h1>";
        }

    }

    public function AddProduto()
    {
        //Recebemos o id
        $id = $_POST['id'];
        // Criamos uma variavel @array carrinho
        $carrinho = [];

        //Se não verificar se o array e a SeSSAO ja esxistem
        //Ele vai apagar o array e criar outro
        if (is_array($carrinho) && isset($_SESSION['carrinho'])) {
            $carrinho = $_SESSION['carrinho'];
        }
        //Se ja existir o id como chave no array
        if (key_exists($id, $carrinho)) {
            $carrinho[$id]++; //Incrementa no valor
        } else { //Se não add no array
            $carrinho[$id] = 1;
        }

        //No final de tudo guarda os dados na sessao!
        $_SESSION['carrinho'] = $carrinho;

        //Retorna on Total No carrinho
        $_SESSION['Total_Carinho'] = count($carrinho);
        return print_r($_SESSION['Total_Carinho']);

    }
    public function checkout()
    {
        if(!isset($_SESSION['carrinho']) or !isset($_SESSION['Total_Carinho']))
        {
            echo "<h1>Preencha o carrinho e depois volte! Seu Burro ;)</h1>";
            return;
        }

         Views::layout(
            [
                'fragmentos/header',
                'checkout',
                'fragmentos/footer',
            ]
        );
    }

    public function apagar_sessao(){
        session_unset();
        session_destroy();
        header('location:?k=index');
    }

}
