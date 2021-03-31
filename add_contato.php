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

if(isset($_POST['adicionar'])):
    $erros = array();
    $nome = mysqli_escape_string($connect, $_POST['nome']);
    $sobrenome = mysqli_escape_string($connect, $_POST['sobrenome']);
    $telefone = mysqli_escape_string($connect, $_POST['telefone']);
    $email = mysqli_escape_string($connect, $_POST['email']);
    $endereco = mysqli_escape_string($connect, $_POST['endereco']);
    $aniversario = mysqli_escape_string($connect, $_POST['aniversario']);
    $instagram = mysqli_escape_string($connect, $_POST['instagram']);

    if(empty($nome)):
        $erros[] = "Preencha todos os campos 
        obrigatórios!";
    elseif(!empty($telefone) or !empty($email) or !empty($endereco)
    or !empty($instagram)):
        $sql = "INSERT INTO `contatos`(`id_fk`, `nome`, `sobrenome`, `telefone`,
        `email`, `endereco`, `aniversario`, `instagram`) VALUES
         ('$id','$nome','$sobrenome','$telefone',
         '$email','$endereco','$aniversario','$instagram')";
        mysqli_query($connect, $sql);
        header('Location: home.php');
    endif;
endif;

?>

<head>
    <title>Novo contato</title>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;700&amp;family=Poppins:wght@400;600&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body id="landing-page">
    <header>
        <img src="logo-temp.png" alt="Logo">
        <div>
            <a href="home.php">
                <h3>SEUS CONTATOS</h3>
            </a>
            <a href="logout.php">
                <img src="logout-img.png" alt="sair">
            </a>
        </div>
    </header>
    <div class="body">
        <div class="container-form">
            <div class="title">
                <h2> Novo contato </h2>
            </div>
            <?php
                if(!empty($erros)):
            ?>
            <div class="info"> 
                <?php
                    foreach($erros as $erro):
                        echo $erro;
                    endforeach;
                ?>
            </div>
            <?php
                endif;
            ?>
            <form method="POST" action="">
                <label>Nome:</label>
                <input type="text" name="nome">

                <label>Sobrenome:</label>
                <input type="text" name="sobrenome">

                <label>Telefone:</label>
                <input type="text" name="telefone">

                <label>Email:</label>
                <input type="email" name="email">

                <label>Endereço:</label>
                <input type="text" name="endereco">

                <label>Aniversário:</label>
                <input type="date" name="aniversario">

                <label>Instagram:</label>
                <input type="text" name="instagram">

                <button type="submit" name="adicionar">Adicionar</button>
            </form>
        </div>
    </div>
</body>