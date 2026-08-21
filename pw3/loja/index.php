<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <title>Formulario de Cadastro de Produtos</title>
</head>
<body>
    <section>
        <a href="produtos.php" class = "sombra">Ver todos os produtos </a> 

        <form action="" method = "post" enctype = "multipart/form-data">
            <h1>Envio de imagens</h1>
            
            <label for="nome">Nome do Produto</label>
            <input type="text" name = "nome" class = "sombra">
            
            <label for="desc">Descrição</label>
            <textarea name="desc" class="sombra"></textarea>
            
            <label for="valor">Valor</label>
            <input type="text" name = "valor" class = "sombra">

            <input type="file" name = "foto[]" multiple class = "sombra meuInput">
            <input type="submit" id = "botao">
        
        </form>
    </section>
    
</body>
</html>
<?php
if( isset($_POST['nome']) ){
    #previne injection
    $nome      = addsLashes( $_POST['nome'] );
    $valor     = addsLashes( $_POST['valor'] );
    $descricao = addsLashes( $_POST['desc'] ); 
    

    #cria o vetor pra guardar o nome das fotos se o usuario enviar
    $fotos = array();

    #checa se foi enviada alguma foto
    if ( isset($_FILES['foto']) ){
        $tipo = '';
        for( $i = 0; $i < count($_FILES['foto']['name']);$i++ ){
            if( $_FILES['foto']['type'][$i] == 'image/jpeg'){
                $tipo  = ".jpg";
            }elseif( $_FILES['foto']['type'][$i] == 'image/png'){
                $tipo  = ".png";
            }else{
                $tipo = "outro";
            }

            if( $tipo == "outro"){
                echo"<script>alert('Só é possível enviar arquivos JPG e PNG')</script>"; 
            }else{
                $nome_arquivo = $_FILES['foto']['name'][$i].rand(1,999).$tipo;
                move_uploaded_file($_FILES['foto']['tmp_name'][$i], 'imagens/'.$nome_arquivo);
            }

            array_push($fotos, $nome_arquivo);
        }
    }


}

