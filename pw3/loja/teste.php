

<?php
require 'classes\Produto.class.php';
$produto = new Produto();
$retorno = $produto->conecta();

if( $retorno ){
    echo "<script>
        alert('Conectado ao banco!')
    </script>";
}else{
    echo "<h1>Banco indisponivel. Tente mais tarde!!";
    echo "<hr>";
}
echo "</h1>";
