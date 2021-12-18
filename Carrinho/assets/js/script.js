

   function AddCarrinho(id){

          $.ajax({

               url:"?k=add_produto",
               type:"POST",
               data:{id: id },
               beforeSend:function() {
                   console.log("Ja foi enviado");}
           }).done(function (data) {
      
            console.log(data);
            $('.Total_produto').text(data);
         
             
         }).fail(function (jqXHR, textSatus, data) {
            console.log(data)
            console.log(textSatus)
    
        });


    }

//======================================================================================
    $("#redirect").click(function(){
        var rota =  $("#redirect").attr("data-target");
        //Redirecionar para outra rota
        setInterval(() => {
            window.location.href = rota;    
        }, 300);
        
    });

    //======================================================================
    $(".cancelar").click( ()=>{
          var resposta = window.confirm("Deseja apagar o registro de compras?");

          if(resposta == true)
             window.location.href = "?k=apagar_sessao";
    })

    //============================================================================
    $('.fechar').click( () =>{
          window.location.href = "?k=login";
    });



