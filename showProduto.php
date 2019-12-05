<?php
$id=$_GET['id'];


//echo $id;

$ler=file_get_contents('./includes/produtos.json');

$arrayjson=json_decode($ler, true);

echo('<pre>');
var_dump($arrayjson);
echo('</pre>');

foreach( $arrayjson as $arr => $value){
   if(in_array($id, $value)){
      
        unset($arrayjson[$arr]);
   }
}
$json=json_encode($arrayjson);
var_dump($json);

$guarda=file_put_contents('./includes/produtos.json',$json);

if($guarda){
    header('Location:indexProdutos.php');

}


?>