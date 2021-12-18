
<div class="container">
     <div class="col-md-6 col-md-offset-6 ">
         <p class="h3">Primeiro precisa fazer login</p>
         <form action="?k=login_post" method="post">

             <div class=" mt-4">
                 <label for="">email:</label>
             <input type="email" name="email" placeholder="Digite o seu email" class="form-control"  id="">
             </div>
             <div class=" mt-4">
                 <label for="">Senha:</label>

                 <input type="password" placeholder="Digite a sua senha" class="form-control" name="senha" id="">
             </div>
             <?php if(isset($_SESSION['erro'])):?> 
             <div class="col-6">
                 <div class="text-center text-danger">
                  <p><?=$_SESSION['erro']?> </p>  
                 </div>
               </div>
            <?php endif;  unset($_SESSION['erro'])?>

             
              <br>
              <button class=" btn btn-outline-primary">Logar</button>
         </form>
     </div>          
</div>
