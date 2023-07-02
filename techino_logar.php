<?php
    include('Connection.php');
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    $conn = Connection::getConnection();

    if(isset($_POST['submetido'])) {
        $email = isset($_POST['email']) ? trim($_POST['email']) : null;
        $senha = isset($_POST['senha']) ? trim($_POST['senha']) : null;

        if (isset($_POST['email_login']) || isset($_POST['senha_login'])) {
            if (strlen($_POST['email_login']) == 0) {
                echo "Preencha o e-mail";
            } elseif (strlen($_POST['senha_login']) == 0) {
                echo "Preencha a senha";
            } else {

                $sql_code = "SELECT * FROM pessoas WHERE email = '$email' AND senha = '$senha'";
                $sql_query = $conn->query($sql_code) or die("Falha na execução do código SQL: " . $conn->error);

                $quantidade = $sql_query->num_rows;
            }
        
            if ($quantidade == 1) {
                $pessoas = $sql_query->fetch_assoc();

                if (!isset($_SESSION)) {
                    session_start();
                }

                $_SESSION['id'] = $usuario['id'];

                header("Location: techino_home.php");
            } else {
                echo ("Falha ao logar! E-mail ou senha incorretos");
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Registrar</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="style.css">

    <style type="text/css">@font-face { font-family: Roboto; src: url("chrome-extension://mcgbeeipkmelnpldkobichboakdfaeon/css/Roboto-Regular.ttf"); }</style></
       
</head>
<body>
    <nav class="py-2 bg-dark border-bottom">
        <div class="container d-flex flex-wrap">
        <ul class="nav me-auto">
            <li class="nav-item"><a href="techino_home.php" class="nav-link link-light px-2 active" aria-current="page">Home</a></li>
            <li class="nav-item"><a href="techino_about.php" class="nav-link link-light px-2">About</a></li>
        </ul>
        <ul class="nav">
            <li class="nav-item"><a href="#" class="nav-link text-blue fw-bold px-2">Login</a></li>
            <li class="nav-item"><a href="techino_register.php" class="nav-link text-blue fw-bold px-2">Sign up</a></li>
        </ul>
        </div>
    </nav>

    <header class="py-3 mb-4 border-bottom bg-dark">
        <div class="container d-flex flex-wrap justify-content-center">
            <a class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto text-light text-decoration-none">
                <span class="fs-4 tex">TECH-INO</span>
            </a>
            <form class="col-12 col-lg-auto mb-3 mb-lg-0">
                <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
            </form>
        </div>
    </header>
    <div class="b-example-divider"></div>
    <br><br>

    <main class="form-signin text-center container" >
    <div class="container" >
     
     <div class="content">      
       <!--FORMULÁRIO DE LOGIN-->
       <div id="login">
         <a class="links" id=""></a>
         <a class="links" id=""></a>
         <h1>Login</h1>
 
         <form method="post" action="" id="borda"> 
            <style type="text/css"> 
                #borda{
                    border-style:solid;
                    border-radius: 20px;
                    border-color: rgb(177, 180, 182);
                    border-width: 1.5px;
                    margin-top: 30px;
                }
            </style>
            <div style="margin: 20px;">
                <p> 
                    <label for="email_login" ><strong>Email</strong></label>
                    <input id="email_login" name="email_login" type="text" placeholder="ex. contato@htmlecsspro.com"/>
                </p>
                <br>
                <p> 
                    <label for="senha_login"><strong>Senha</strong></label>
                    <input id="senha_login" name="senha_login" type="password" placeholder="ex. senha" /> 
                </p>
                    
                <p> 
                    <input type="checkbox" name="manterlogado" id="manterlogado" value="" /> 
                    <label for="manterlogado">Manter-me logado</label>
                </p>
                    
                <p> 
                    <input type="submit" value="Logar" /> 
                </p>
            </div>
         </form>
       </div>
     </div>
    </main>
    <br><br>

    <footer class="container">
    <p class="float-end"><a href="#">Back to top</a></p>
    <p>© 2021–2023 Company, Inc. · <a href="#">Privacy</a> · <a href="#">Terms</a></p>
    </footer>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="validacao_register.js">

</body>
</html>