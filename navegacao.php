<?php
   $ler=file_get_contents('./includes/usuarios.json');
   $transArray=json_decode($ler, true);

   if(!isset($_SESSION['trans'])){
    header('Location:index.php');	

   }

  ?>
  <nav class="navbar navbar-expand-lg navbar-light btn-azul">
  <a class="navbar-brand text-dark btn btn-outline-info h2" href="#">DESAFIO-PHP</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
    <a class="nav-item nav-link active text-white h6" href="createUsuario.php">USUÁRIOS <span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link text-white h6" href="createProduto.php">CADASTRAR PRODUTOS</a>
      <a class="nav-item nav-link text-white h6" href="indexProdutos.php">CONSULTAR PRODUTOS</a>
      
    </ul>
    <form class="form-inline my-2 my-lg-0">
    Ola,<a class="nav-item nav-link text-white lead"><?php echo $_SESSION['trans']['nome']; ?></a>
     <button class="btn btn-outline-info  my-2 my-sm-0 h6" type="submit"> <a href="logout.php" class="text-white">Sair</a></button>
    </form>
  </div>
</nav>
