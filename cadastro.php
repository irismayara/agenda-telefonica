<?php
//conexão
require_once 'db_connect.php';

//sessão
session_start();

    if(isset($_POST['cadastrar'])):
        $erros = array();
        $nome = mysqli_escape_string($connect, $_POST['nome']);
        $sobrenome = mysqli_escape_string($connect, $_POST['sobrenome']);
        $sexo = mysqli_escape_string($connect, $_POST['sexo']);
        $email = mysqli_escape_string($connect, $_POST['email']);
        $senha = mysqli_escape_string($connect, $_POST['senha']);
        $c_senha = mysqli_escape_string($connect, $_POST['c_senha']);

        if(empty($nome) or empty($sobrenome) or empty($sexo)
        or empty($email) or empty($senha) or empty($c_senha)):
            $erros[] = "Preencha todos os campos 
            obrigatórios!";
        elseif($senha!=$c_senha):
            $erros[] = "Os campos senha e confirme a senha
             não conferem";
        else:
            $senha = md5($senha);
            $sql = "INSERT INTO `usuarios`(`nome`, 
            `sobrenome`, `sexo`, `email`, `senha`)
             VALUES ('$nome','$sobrenome','$sexo',
             '$email','$senha')";
            mysqli_query($connect, $sql);
            header('Location: index.php');
        endif;
    endif;
?>

<head>
    <title>Cadastro</title>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;700&amp;family=Poppins:wght@400;600&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body id="landing-page">
    <header>
        <img src="logo-temp.png" alt="Logo">
        <h3>SEUS CONTATOS</h3>
    </header>
    <div class="body">
        <div class="container-form">
            <div class="title">
                <h1> Cadastro </h1>
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

            <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
            
                <label>Nome:</label>
                <input type="text" name="nome">

                <label>Sobrenome:</label>
                <input type="text" name="sobrenome">

                <label>Sexo: </label>
                <select name="sexo">
                    <option selected value=""></option>
                    <option value="masculino">Masculino</option>
                    <option value="feminino">Feminino</option>
                </select>

                <label>Email:</label>
                <input type="email" name="email">

                <label>Senha:</label>
                <input type="password" name="senha">

                <label>Confirme a senha:</label>
                <input type="password" name="c_senha">

                <button type="submit" name="cadastrar">Cadastrar</button>
            </form>

            <div class="footer">
            <a href="index.php">Já tem cadastro?</a>
            </div>
        </div>
    </div>
</body>