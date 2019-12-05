<?php
$id=$_GET['id'];

$ler=file_get_contents('./includes/usuarios.json');

$transarray=json_decode($ler,true);

foreach($transarray as $arr => $value){
    if(in_array($id, $value)){

        unset($transarray[$arr]);

    }

}

$transjson=json_encode($transarray);

$guarda=file_put_contents('./includes/usuarios.json', $transjson);

if($guarda){

    header('Location:createUsuario.php');

}
?>