
<?php
use src\helpers\Database;

$dado = Database::select("SELECT * FROM tb_produtos");
/**
 *  [id_produto] => 1
 * [nome] => Camisa
 * [preco] => 20000
 *  [estoque] => 500
 *  [imagem] => 1.jpg
 */


?>
       <div class="container">
           <div class="col-12">
               Bem Vindo a nossa loja! - Voce tem <p class="Total_produto text-danger"><?php $retorno = ""; echo $retorno ? isset($_SESSION['Total_Carinho']) : 0 ?></p> Produtos no carrinho ;) 
               <div class="col-md-3 text-center">
                   <button class="btn btn-outline-primary" id ="redirect" data-target = "?k=checkout">Fechar Conta</button>
                </div>
           </div>
           <hr>
            <fieldset>
                <legend>Montra de Produtos</legend>
            <!-- #region Primeiro Produto -->
            <?php foreach ($dado as $k => $v): ?>
                <div class="col-6">
                    <div class="title"><?=$v['nome']?></div>
                     <div class="image">
                       <img src="<?=URL?>/assets/img/<?=$v['imagem']?>" alt="Imagem do produto" sizes="40" srcset="">
                    </div>
                     <div class="preco"><p> <?=$v['preco']?> </p> </div>
                     <div class="button"> 
                       <button onclick="AddCarrinho(<?=$v['id_produto']?>)" >Adiçionar</button>
                     </div>
                </div>
             <?php endforeach;?>
           <!-- #endregion -->
            </fieldset>
       </div>
