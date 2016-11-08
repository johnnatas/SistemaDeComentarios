$(function(){
    
    //página perfil.php

    $('a#excluir').click(function(e){
      e.preventDefault();

      var cd = $(this).attr('href');
      $(this).parents('div.comentario').remove();

      $.post("arquivosphp/excluircoment.php", {id: cd}, function(retorno){});

    });

    $('a#editar').click(function(ev){
      ev.preventDefault();
      var cd = $(this).attr('href');

      $.post('arquivosphp/views/editarcomentario.php', {id: cd}, function(retorno){
        $('section#exibicao').html(retorno);
      });
    });

    //retorna à exibição de comentários dos usuários
    $('input#cancelar').click(function(){
      $('body').load('perfil.php');
    });

    $('input#atualizar').click(function(){
      var cdcomentario = $('div.comentario').attr('id');
      var coment = $('textarea#comentario').val();
      var cdedicao = $('div.comentario').attr('rel');

      $.post('arquivosphp/editarcoment.php', 
        {idcomentario: cdcomentario, comentario: coment, idedicao: cdedicao},
        function(retorno){
          $('body').html(retorno)
        });

    });



    //exibe opção de editar a foto do perfil
    $('label').click(function(){
       $.ajax({
           type: 'POST',
           url: 'arquivosphp/views/editarfoto.php',

           success: function(data) {
               $('section#exibicao').html(data);
           }
       });
    });
    
    //opção de alterar dados do perfil
    $('a.op').click(function(e){
        e.preventDefault();
        
       $.ajax({
          type: 'POST',
          url: 'arquivosphp/views/alterarDados.php',
          
          success: function(data){
              $('section#exibicao').html(data);
          }
       });
    });
    
    //envio de comentários index.php(logado)
    $('#enviar').click(function(){
      var coment = $('textarea#comentario').val();
      
      if(coment == ""){
        $('p#notcoment').show()
      }
      else{
        $.post("arquivosphp/action.php", {comentario: coment}, function(retorno){
           $('div#novo-comentario').append(retorno);
           $('textarea#comentario').val("");
        });
      }
    });

    $('textarea#comentario').click(function(){
        $('p#notcoment').hide();
    });
    
    //página logar.php
    //validação dos campos necessários para acessar a página
    $('form#logar').validate({
       rules:{
            email: {required: true},
            senha: {required: true}
           },
       messages:{
            email: {required: "Este campo não foi preenchido"},
            senha:{required: "Este campo não foi preenchido"}
       }
    });
    
    //página cadastrar.php
    //validação dos campos necessários para se cadastrar na página
    $('form#cadastrar').validate({
       rules:{
           nome: {required: true},
           email: {required: true},
           senha: {required: true},
           repetirsenha: {required: true}
           },
       messages:{
           nome: {required: "Este campo não foi preenchido"},
           email: {required: "Este campo não foi preenchido"},
           senha:{required: "Este campo não foi preenchido"},
           repetirsenha: {required: "Este campo não foi preenchido"}
       }
    });
    
    //alterarDados.php
    //validação dos campos necessários para alterar o email
    
    $('form#alterar-email').validate({
       rules:{
           novoemail: {required: true}
       },
       messages:{
           novoemail: {required: "Este campo não foi preenchido"}
       }
    });
    
    $('form#alterar-senha').validate({
       rules:{
           senhaatual: {required: true},
           novasenha: {required: true},
           repetirnova: {required: true}           
       },
       messages:{
           senhaatual: {required: "Este campo não foi preenchido"},
           novasenha: {required: "Este campo não foi preenchido"},
           repetirnova: {required: "Este campo não foi preenchido"}
       }
    });    
});


