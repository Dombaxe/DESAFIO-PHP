<?php
session_start();

if(isset($_POST['enter'])){
    $email=$_POST['email'];
    $senha=$_POST['senha'];
    

    
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

    $ler=file_get_contents('./includes/usuarios.json');

    $transArray=json_decode($ler, true);

    foreach($transArray as $trans){

        if(($email == $trans['email']) && password_verify($senha, $trans['senha'])){

           $_SESSION['trans']=$trans;
           return header('Location:createProduto.php');

        }
        }

           $erro="Email e senha não coincidem";

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
    <a class="navbar-brand text-dark btn btn-outline-info h2" href="#">DESAFIO-PHP</a>
    </div>
   
     <form name="enter" method="post" enctype="multipart/form-data">
       <div class="form-row justify-content-center mt-5">

       <div class="form-group col-sm-4 col-md-1">
       <label for="inputemail">E-mail:</label>
       </div>
       <div class="form-group col-sm-4 col-md-4">
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
       <div class="form-group col-sm-4 col-md-1">
       <label for="inputsenha">Senha:</label>
       </div>
       <div class="form-group col-sm-4 col-md-4">
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
       <div class="form-group col-sm-4 col-md-3">
       <a class="btn btn-color1 text-white" href="cadastro.php">Cadastra-se</a>
       <button type="submit" name="enter" class="btn btn-azul text-white">Logar</button> 
       </div>
       </div>
     </form>
     <?php
     if(isset($erro) && $erro){?>
     <div class="form-row justify-content-center">
     <div class=" form-group col-sm4 col-md-3 alert alert-danger"><?php echo $erro; ?></div>
     </div>
     <?php
     }
     ?>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>