<?php

session_start();
$cadastro=false;
if(isset($_POST['enter'])){
    $nome=$_POST['nome'];
    $email=$_POST['email'];
    $senha=$_POST['senha'];
    $confsenha=$_POST['confsenha'];

    if(empty($nome)){
        $_SESSION['vazio_nome']="Campo nome obrigatório";

    }else if(is_numeric($nome)){
        $_SESSION['vazio_nome']="Não aceita valores inteiros";

    }else if(strlen($nome) < 2){
        $_SESSION['vazio_nome']="Minimo 3 letras";

    }else{
        $_SESSION['value_nome']=$nome;
    
    if(empty($email)){
        $_SESSION['vazio_email']="Campo email obrigatório";

    }else if(strlen($email) < 2){
        $_SESSION['vazio_email']="O email deve ter no minimo 3 caracteres";

    }else{
        $_SESSION['value_email']=$email;

    if(empty($senha)){
        $_SESSION['vazio_senha']="Campo senha obrigatório";

    }else if(strlen($senha) < 5){
        $_SESSION['vazio_senha']="A senha deve ter no mínimo 6 caracteres";

    }else{
        $_SESSION['value_senha']=$senha;

    if(empty($confsenha)){
        $_SESSION['vazio_confsenha']="Campo confirmação de senha obrigatório";

    }else if($senha !== $confsenha){
        $_SESSION['vazio_confsenha']="A senha e a confirmação de senha devem ser iguais";

    }else{ 
        $_SESSION['value_confsenha']=$confsenha;

    
    $ler=file_get_contents('./includes/usuarios.json');

    $arrayassoc=json_decode($ler, true);

    //var_dump($arrayassoc);

    $id=random_int(1,1000);

    $novoarray=[
        'id'=>$id,
        'nome'=>$_POST['nome'],
        'email'=>$_POST['email'],
        'senha'=>password_hash($_POST['senha'], PASSWORD_DEFAULT),
        'Confirmar senha'=>password_hash($_POST['confsenha'], PASSWORD_DEFAULT)

    ];

    $arrayassoc[]=$novoarray;

    $transjson=json_encode($arrayassoc);

    $guarda=file_put_contents('./includes/usuarios.json',$transjson);

   if($guarda){
       $cadastro=true;
   }else{
       echo"Erro!..";
   }

    
      

    }

    }
    
    }
    
    }

}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <title>Desafio PHP</title>
  </head>
  <body class="bg-light">
  
  
  <div class="container">
    <div class="form-row justify-content-center mt-5">
        <h3 class="mt-3">Criar uma nova conta</h3>
    </div>
     <form name="enter" method="post" enctype="multipart/form-data">
       <div class="form-row justify-content-center mt-5">

       <div class="form-group col-sm-4 col-md-2">
       <label for="inputnome">Nome:</label>
       </div>
       <div class="form-group col-sm-4 col-md-5">
       <input type="text" name="nome" class="form-control" value="<?php 
       if(!empty($_SESSION['value_nome'])){
           echo $_SESSION['value_nome'];
           unset($_SESSION['value_nome']);

       }
       
       ?>">
       </div>
       </div>
       <div class="form-row justify-content-center">
       <?php
       if(!empty($_SESSION['vazio_nome'])){
           echo'<p class="text-danger">'. $_SESSION['vazio_nome'].'</p>';
           unset($_SESSION['vazio_nome']);

       }
       ?>
      </div>
       <div class="form-row justify-content-center">
       <div class="form-group col-sm-4 col-md-2">
       <label for="inputemail">E-mail:</label>
       </div>
       <div class="form-group col-sm-4 col-md-5">
       <input type="email" name="email" class="form-control" value="<?php
       if(!empty($_SESSION['value_email'])){
           echo $_SESSION['value_email'];
           unset($_SESSION['value_email']);

       }
       ?>
       ">
       </div>
       </div>
       <div class="form-row justify-content-center">
       <?php
        if(!empty($_SESSION['vazio_email'])){
            echo'<p class="text-danger">'. $_SESSION['vazio_email'].'</p>';
            unset($_SESSION['vazio_email']);

        }
       ?>
       </div>
       <div class="form-row justify-content-center">
       <div class="form-group col-sm-4 col-md-2">
       <label for="inputsenha">Senha:</label>
       </div>
       <div class="form-group col-sm-4 col-md-5">
       <input type="password" name="senha" class="form-control" value="<?php
       if(!empty($_SESSION['value_senha'])){
           echo $_SESSION['value_senha'];
           unset($_SESSION['value_senha']);

       }
       ?>">
       </div>
       </div>
       <div class="form-row justify-content-center">
       <?php
       if(!empty($_SESSION['vazio_senha'])){
           echo'<p class="text-danger">'. $_SESSION['vazio_senha'].'</p>';
           unset($_SESSION['vazio_senha']);

       }
       ?>
      </div>
       <div class="form-row justify-content-center">
       <div class="form-group col-sm-4 col-md-2">
       <label for="inputconfsenha">Confirmar Senha:</label>
       </div>
       <div class="form-group col-sm-4 col-md-5">
       <input type="password" name="confsenha" class="form-control" value="<?php
       if(!empty($_SESSION['value_confsenha'])){
           echo $_SESSION['value_confsenha'];
           unset($_SESSION['value_confsenha']);

       }
       ?>">
       </div>
       </div>
       <div class="form-row justify-content-center">
       <?php
       if(!empty($_SESSION['vazio_confsenha'])){
           echo'<p class="text-danger">'. $_SESSION['vazio_confsenha'].'</p>';
           unset($_SESSION['vazio_confsenha']);

       }
       ?>
       </div>
       <div class="form-row justify-content-center">
       <div class="form-group col-sm-4 col-md-3">
       <a class="btn btn-color1 text-white" href="index.php">Login</a>
       <button type="submit" name="enter" class="btn btn-azul text-white">Cadastra-se</button>
       </div>
       </div>
     </form>
     
    <?php if($cadastro): ?>
     <div class="form-row justify-content-center">
     <div class="text-info">Cadastrado com Sucesso!..</div>
     </div>
<?php endif; ?>
    </div>

  
  
  
   

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
