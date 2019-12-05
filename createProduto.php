<?php
  session_start();
  $cadastro=false;
  if(isset($_POST['enter'])){
      $nome=$_POST['nome'];
      $descricao=$_POST['descricao'];
      $preco=$_POST['preco'];
      $foto=$_FILES['foto']['name'];

      if(empty($nome)){
        $_SESSION['vazio_nome']="Campo nome Obrigatório";

    }else if(is_numeric($nome)){
        $_SESSION['vazio_nome']="Não aceita valores inteiro";
    
    }else if(strlen($nome) < 2){
        $_SESSION['vazio_nome']="O nome deve ter no minimo 3 caracteres";

    }else{
        $_SESSION['value_nome']=$nome;
    
    if(empty($descricao)){
        $_SESSION['vazio_descricao']="Campo descrição Obrigatório";
    
    }else if(is_numeric($descricao)){
        $_SESSION['vazio_descricao']="Não aceita valores inteiros";
    
    }else if(strlen($descricao) <=4){
        $_SESSION['vazio_descricao']="O nome deve ter no minimo 5 caracteres";
    
    }else{
        
        $_SESSION['value_descricao']=$descricao;
    
    
    if(empty($preco)){
        $_SESSION['vazio_preco']="Campo preço Obrigatório";

    }else if(!(is_numeric($preco))){
       $_SESSION['vazio_preco']="Não aceita texto";   

    }else if($preco <= 0){
        $_SESSION['vazio_preco']="Valores invalidos"; 

    }else{
        $_SESSION['value_preco']=$preco;
    
    if(empty($foto)){
        $_SESSION['vazio_foto']="Campo upload Obrigatório";
    }else{
        $_SESSION['value_foto']=$foto;
    
   

    if($_FILES['foto']['error'] == 0){

        $foto=$_FILES['foto']['name'];
        $tmp=$_FILES['foto']['tmp_name'];

        move_uploaded_file($tmp, 'assets/img/'.$foto);
           
        if($foto == 0){
            $cadastro=true;
        }else{
            echo"Erro";
        }
    }

    $lerjson=file_get_contents('./includes/produtos.json');

    $transArray=json_decode($lerjson, true);

    //var_dump($transArray);

    $id=random_int(1,1000);


    $novoArray=[
        'id'=>$id,
        'nome'=>$_POST['nome'],
        'descricao'=>$_POST['descricao'],
        'preco'=>$_POST['preco'],
        'foto'=>$_FILES['foto']['name']
    ];

    $transArray[]=$novoArray;

    $transjson=json_encode($transArray);

    $guarda=file_put_contents('./includes/produtos.json', $transjson);

    if($guarda){
        header('Location:indexProdutos.php');

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
  <?php
   include('navegacao.php');
  ?>
  
    <div class="container ">
    <div class="form-row justify-content-center mt-5">
        <h3 class="mt-3">Cadastrar Produtos</h3>
    </div>
     <form name="enter" method="post" enctype="multipart/form-data">
       <div class="form-row justify-content-center mt-5">

       <div class="form-group col-sm-4 col-md-2">
       <label for="inputnome">Nome do Produto:</label>
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
       <label for="inputdescricao">Descrição do Produto:</label>
       </div>
       <div class="form-group col-sm-4 col-md-5">
       <textarea rows="3" cols="50" type="text" name="descricao" class="form-control"><?php
       if(!empty($_SESSION['value_descricao'])){
           echo $_SESSION['value_descricao'];
           unset($_SESSION['value_descricao']);

       }
       ?></textarea>
       </div>
       </div>
       <div class="form-row justify-content-center">
       <?php
        if(!empty($_SESSION['vazio_descricao'])){
            echo'<p class="text-danger">'. $_SESSION['vazio_descricao'].'</p>';
            unset($_SESSION['vazio_descricao']);

        }
       ?>
       </div>
       <div class="form-row justify-content-center">
       <div class="form-group col-sm-4 col-md-2">
       <label for="inputpreco">Preço:</label>
       </div>
       <div class="form-group col-sm-4 col-md-5">
       <input type="text" name="preco" class="form-control" value="<?php
       if(!empty($_SESSION['value_preco'])){
           echo $_SESSION['value_preco'];
           unset($_SESSION['value_preco']);

       }
       ?>">
       </div>
       </div>
       <div class="form-row justify-content-center">
       <?php
       if(!empty($_SESSION['vazio_preco'])){
           echo'<p class="text-danger">'. $_SESSION['vazio_preco'].'</p>';
           unset($_SESSION['vazio_preco']);

       }
       ?>
      </div>
       <div class="form-row justify-content-center">
       <div class="form-group col-sm-4 col-md-2">
       <label for="inputfoto"></label>
       </div>
       <div class="form-group col-sm-4 col-md-5">
       <input type="file" name="foto" class="" accept="image/*" value="
       <?php
       if(!empty($_SESSION['value_foto'])){
           echo $_SESSION['value_foto'];
           unset($_SESSION['value_foto']);

       } 
       ?>">
       </div>
       </div>
       <div class="form-row justify-content-center">
       <?php
       if(!empty($_SESSION['vazio_foto'])){
           echo'<p class="text-danger">'. $_SESSION['vazio_foto'].'</p>';
           unset($_SESSION['vazio_foto']);

       }
       ?>
       </div>
       <div class="form-row justify-content-center">
       <div class="form-group col-sm-4 col-md-3">
       <button type="submit" name="enter" class="btn btn-azul text-white">Cadastrar</button>
       </div>
       </div>
     </form>
     <form>
     <div class="form-row justify-content-center">
     <div class="form-group col-sm-4 col-md-3">
     <input type="submit" value="Limpar Campos" class="btn btn-dark">
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
