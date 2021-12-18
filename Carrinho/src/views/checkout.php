<?php

use src\models\Produtos;
$compras = (new Produtos)->Desfragmentar();
$_SESSION['compra_final'] = $compras;
echo "<pre>";
//print_r($compras);
echo "</pre>";
?>

<div class="container">

<p class="h3 text-center"> Finalisar checkout.</p>
 <div class="col-md-12 text-center">

 <table class=" table-bordered table-primary p-5"> .
       <thead class="">
          <tr class="table-active">
             <th>Nome</th>
             <th>Preço</th>
             <th>Quantidade</th>
             <th>Sub-Total</th>
          </tr>
       </thead>
       <tbody>
         
            <?php foreach($compras as $item): ?>
                    <tr>
                       <td><?=$item['nome']?></td>
                       <td><?=$item['preco']?></td>
                       <td><?=$item['quantidade']?></td>
                       <td><?=$item['sub_total']?></td>
                     </tr>
            <?php  endforeach; ?>
         
       </tbody>

       </table>
 </div>


 <div class="col-sm-12 mt-5 my-4 p-5">
    <button class="btn btn-outline-primary my-4 fechar">Fechar conta</button>
  
  
    <button class="btn btn-outline-danger cancelar">Cancelar pagamento</button>
 </div>
</div>
