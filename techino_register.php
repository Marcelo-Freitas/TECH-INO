<?php

    $msgErro = "";
    $msgSucesso = "";

    $email = "";
    $senha = "";
    $confirmSenha = "";
    $endereco = "";
    $cidade = "";
    $estado = "";
    $cep = "";
    $termos = "";

    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    require_once("Connection.php");

    $conn = Connection::getConnection();

    if(isset($_POST['submetido'])) {
        $email = isset($_POST['email']) ? trim($_POST['email']) : null;
        $senha = isset($_POST['senha']) ? trim($_POST['senha']) : null;
        $confirmSenha = isset($_POST['confirmSenha']) ? trim($_POST['confirmSenha']) : null;
        $endereco = isset($_POST['endereco']) ? trim($_POST['endereco']) : null;
        $cidade = isset($_POST['cidade']) ? trim($_POST['cidade']) : null;
        $estado = isset($_POST['estado']) ? trim($_POST['estado']) : null;
        $cep = isset($_POST['cep']) ? trim($_POST['cep']) : null;
        $termos = isset($_POST['termos']) ? trim($_POST['termos']) : null;

        if (! $email) {
            $msgErro = "Informe um email válido!";
        } else if (! $senha){
            $msgErro = "Informe uma senha válida!";
        } else if ($confirmSenha != $senha) {
            $msgErro = "Confirmação de senha inválida!"; 
        } else if (! $endereco){
            $msgErro = "Informe um endereço válido!";
        } else if (! $cidade){
            $msgErro = "Informe uma cidade válida!";
        } else if (! $estado){
            $msgErro = "Informe um estado válido!";
        } else if (! $cep){
            $msgErro = "Informe um CEP válido!";
        } else if ($termos == 0){
            $msgErro = "Você precisa aceitar os termos!";
        }
        
        else {
            $msgSucesso = "Você foi registrado com sucesso!";

            $sql = 'INSERT INTO pessoas (email, senha, confirmSenha, endereco, cidade, estado, cep, termos)' . 
               ' VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
            $stmt = $conn->prepare($sql);
            $stmt->execute([$email, $senha, $confirmSenha, $endereco, $cidade, $estado, $cep, $termos]);

            header("location: techino_register.php");
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

    <title>Document</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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

    <main role="main" class="container" > 

        <legend align="center">Registre-se</legend>
        <br>
    
        <form id="borda" class="container" action="" method="POST" onsubmit="return validar();"> 
            <style type="text/css"> 
                #borda{
                    border-style:solid;
                    border-radius: 20px;
                    border-color: rgb(177, 180, 182);
                    border-width: 1.5px;
                    margin-top: 30px;
                }
            </style>
            <br><br> 
            <div class="row"> 
                <div class="col-md-4">
                    <label for="inputEmail4">Email</label>
                    <input type="email" class="form-control" id="inputEmail4" placeholder="Email" name="email" value="<?php echo $email;?>" />
                </div>
                <div class="col-md-4">
                    <label for="inputPassword4">Senha</label>
                    <input type="password" class="form-control" id="inputPassword4" placeholder="Senha" name="senha" value="<?php echo $senha;?>" />
                </div>
                <div class="col-md-4">
                    <label for="input_confPassword4">Confirme a senha</label>
                    <input type="password" class="form-control" id="input_confPassword4" placeholder="Senha" name="confirmSenha" value="<?php echo $confirmSenha;?>">
                </div>
            </div>
            <br>
            <div class="form-group">
                <label for="inputAddress">Endereço</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="Rua dos Trouxas, nº 0" name="endereco" value="<?php echo $endereco;?>" />
            </div>
            <br>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="inputCity">Cidade</label>
                    <input type="text" class="form-control" id="inputCity" name="cidade" value="<?php echo $cidade;?>" />
                </div>
                    <div class="form-group col-md-4">
                    <label for="inputEstado">Estado</label>
                    <select id="inputEstado" class="form-control" name="estado" value="<?php echo $estado;?>" />
                        <option value="">Escolher...</option>
                        <option value="AC" <?php echo ($estado == 'AC' ? 'selected' : '') ?>>Acre</option>
                        <option value="AL" <?php echo ($estado == 'AL' ? 'selected' : '') ?>>Alagoas</option>
                        <option value="AP" <?php echo ($estado == 'AP' ? 'selected' : '') ?>>Amapá</option>
                        <option value="AM" <?php echo ($estado == 'AM' ? 'selected' : '') ?>>Amazonas</option>
                        <option value="BA" <?php echo ($estado == 'BA' ? 'selected' : '') ?>>Bahia</option>
                        <option value="CE" <?php echo ($estado == 'CE' ? 'selected' : '') ?>>Ceará</option>
                        <option value="ES" <?php echo ($estado == 'ES' ? 'selected' : '') ?>>Espírito Santo</option>
                        <option value="GO" <?php echo ($estado == 'GO' ? 'selected' : '') ?>>Goiás</option>
                        <option value="MA" <?php echo ($estado == 'MA' ? 'selected' : '') ?>>Maranhão</option>
                        <option value="MT" <?php echo ($estado == 'MT' ? 'selected' : '') ?>>Mato Grosso</option>
                        <option value="MS" <?php echo ($estado == 'MS' ? 'selected' : '') ?>>Mato Grosso do Sul</option>
                        <option value="MG" <?php echo ($estado == 'MG' ? 'selected' : '') ?>>Minas Gerais</option>
                        <option value="PA" <?php echo ($estado == 'PA' ? 'selected' : '') ?>>Pará</option>
                        <option value="PB" <?php echo ($estado == 'PB' ? 'selected' : '') ?>>Paraíba</option>
                        <option value="PR" <?php echo ($estado == 'PR' ? 'selected' : '') ?>>Paraná</option>
                        <option value="PE" <?php echo ($estado == 'PE' ? 'selected' : '') ?>>Pernambuco</option>
                        <option value="PI" <?php echo ($estado == 'PI' ? 'selected' : '') ?>>Piauí</option>
                        <option value="RJ" <?php echo ($estado == 'RJ' ? 'selected' : '') ?>>Rio de Janeiro</option>
                        <option value="RN" <?php echo ($estado == 'RN' ? 'selected' : '') ?>>Rio Grande do Norte</option>
                        <option value="RS" <?php echo ($estado == 'RS' ? 'selected' : '') ?>>Rio Grande do Sul</option>
                        <option value="RO" <?php echo ($estado == 'RO' ? 'selected' : '') ?>>Rondônia</option>
                        <option value="RR" <?php echo ($estado == 'RR' ? 'selected' : '') ?>>Roraima</option>
                        <option value="SC" <?php echo ($estado == 'SC' ? 'selected' : '') ?>>Santa Catarina</option>
                        <option value="SP" <?php echo ($estado == 'SP' ? 'selected' : '') ?>>São Paulo</option>
                        <option value="SE" <?php echo ($estado == 'SE' ? 'selected' : '') ?>>Sergipe</option>
                        <option value="TO" <?php echo ($estado == 'TO' ? 'selected' : '') ?>>Tocantins</option>
                        <option value="DF" <?php echo ($estado == 'DF' ? 'selected' : '') ?>>Distrito Federal</option>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="inputCEP">CEP</label>
                    <input type="text" class="form-control" id="inputCEP" name="cep" value="<?php echo $cep;?>" />
                </div>
            </div>
            <br>
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck" name="termos" value="<?php echo $termos;?>">
                    <label class="form-check-label" for="gridCheck">Concordo com os termos de segurança</label>
                </div>
                <br>
            </div>
            <div class="row">
                <div class="col-1">
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </div>
                <div class="col 1">
                    <div id="mensagem" style="color: red;"> 
                    <?php echo $msgErro;?>
                    </div>
                    <div id="mensagemSucesso" style="color: green;"> 
                    <?php echo $msgSucesso;?>
                    </div>
                </div>
            </div>
            <input type="hidden" name="submetido" value="1"/>
            <br><br>
        </form>
        <br><br>
    </main>

    <footer class="text-center text-lg-start bg-white text-muted">
        <!-- Section: Social media -->
        <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
          <!-- Left -->
          <div class="me-5 d-none d-lg-block">
            <span>Mantenha-se conectado às nossas redes sociais</span>
          </div>
          <!-- Left -->
      
          <!-- Right -->
          <div>
            <a href="" class="me-4 link-secondary">
                <i class="fa-brands fa-facebook"></i>
            </a>
            <a href="" class="me-4 link-secondary">
                <i class="fa-brands fa-twitter"></i>
            </a>
            <a href="" class="me-4 link-secondary">
                <i class="fa-brands fa-google"></i>
            </a>
            <a href="" class="me-4 link-secondary">
                <i class="fa-brands fa-instagram"></i>
            </a>
            <a href="" class="me-4 link-secondary">
                <i class="fa-brands fa-linkedin"></i>
            </a>
            <a href="" class="me-4 link-secondary">
                <i class="fa-brands fa-github"></i>
            </a>
          </div>
          <!-- Right -->
        </section>
        <!-- Section: Social media -->
      
        <!-- Section: Links  -->
        <section class="">
          <div class="container text-center text-md-start mt-5">
            <!-- Grid row -->
            <div class="row mt-3">
              <!-- Grid column -->
              <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                <!-- Content -->
                <h6 class="text-uppercase fw-bold mb-4">
                  <i class="fas fa-gem me-3 text-secondary"></i>TECH-INO
                </h6>
                <p>
                  Tudo, em todo lugar, ao mesmo tempo
                </p>
              </div>
              <!-- Grid column -->
      
              <!-- Grid column -->
              <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                <!-- Links -->
                <h6 class="text-uppercase fw-bold mb-4">
                  PRODUTOS
                </h6>
                <p>
                  <a href="#!" class="text-reset">Termos</a>
                </p>
                <p>
                  <a href="#!" class="text-reset">Acessibilidade</a>
                </p>
                <p>
                  <a href="#!" class="text-reset">Visite</a>
                </p>
              </div>
              <!-- Grid column -->
      
              <!-- Grid column -->
              <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                <!-- Links -->
                <h6 class="text-uppercase fw-bold mb-4">
                  LINKS ÚTEIS
                </h6>
                <p>
                  <a href="#!" class="text-reset">Preços</a>
                </p>
                <p>
                  <a href="#!" class="text-reset">Configurações</a>
                </p>
                <p>
                  <a href="#!" class="text-reset">Pedidos</a>
                </p>
              </div>
              <!-- Grid column -->
      
              <!-- Grid column -->
              <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                <!-- Links -->
                <h6 class="text-uppercase fw-bold mb-4">CONTATO</h6>
                <p><i class="fas fa-home me-3 text-secondary"></i> Foz do Iguaçu, PR 10012, BR</p>
                <p>
                  <i class="fas fa-envelope me-3 text-secondary"></i>
                  techino@gmail.com
                </p>
                <p><i class="fas fa-phone me-3 text-secondary"></i> (45) 99147-6795</p>
              </div>
              <!-- Grid column -->
            </div>
            <!-- Grid row -->
          </div>
        </section>
        <!-- Section: Links  -->
      
        <!-- Copyright -->
        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.025);">
          © 2021 Copyright:
          <a class="text-reset fw-bold" href="https://mdbootstrap.com/">MDBootstrap.com</a>
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="validacao_register.js">
</body>
</html>
