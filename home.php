<?php

//conexão
require_once 'db_connect.php';

//sessão
session_start();

if(!isset($_SESSION['logado'])):
    header('Location: index.php');
endif;

//dados
$id = $_SESSION['id_usuario'];
$sql = "SELECT * FROM usuarios WHERE id = '$id'";
$resultado = mysqli_query($connect, $sql);
$dados = mysqli_fetch_array($resultado);

$nome = $dados['nome'];

if(isset($_GET['add'])):
    header('Location: add.php');
endif;
?>

<head>
    <title>Home Page</title>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;700&amp;family=Poppins:wght@400;600&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body id="landing-page">
    <header>
        <img src="logo-temp.png" alt="Logo">
        <div>
            <h3>SEUS CONTATOS</h3>
            <a href="logout.php">
                <img src="logout-img.png" alt="sair">
            </a>
        </div>
    </header>
    <div class="body">
        <div class="container-form">
            <form action="add_contato.php" method="get">
                <input type="submit" id="add" name="add-contato" value="+">        
            </form>
            <div id="title">
                <h2> Contatos </h2>
            </div>
            
            <div id="lista-contatos">
                <?php
                    $sql = "SELECT * FROM contatos WHERE id_fk = '$id'";
                    $resultado = mysqli_query($connect, $sql);
                    if(mysqli_num_rows($resultado) > 0):
                        while($contato = mysqli_fetch_assoc($resultado)):
                            $nome_contato = $contato['nome'];
                            $sobrenome_contato = $contato['sobrenome'];
                            $telefone_contato = $contato['telefone'];
                            $email_contato = $contato['email'];
                            $instagram_contato = $contato['instagram'];

                            echo " <p> $nome_contato $sobrenome_contato </p>";
                ?>
                <a href="https://wa.me/55<?php echo $telefone_contato ?>">
                    <img src="wpp-icon.png" alt="whatsapp">
                </a>
                <a href="https://www.instagram.com/<?php echo $instagram_contato ?>">
                    <img src="insta-icon.png" alt="">
                </a>
                <hr>
                <?php
                        endwhile;
                    else:
                        echo "<small>Você não adicionou contatos ainda.</small>";
                        
                    endif;
                ?>
                
            </div>
        </div>
    </div>
</body>