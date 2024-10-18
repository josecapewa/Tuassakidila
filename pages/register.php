<?php

session_start();
require_once("../includes/load.php");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $recuperation_email = $_POST['recuperation_email'];
    $password = $_POST['password'];
    $password_repeat = $_POST['password_repeat'];


    if (empty($first_name) || empty($last_name) || empty($email) || empty($password) || empty($password_repeat)) {
        echo "<script>alert('Por favor, preencha todos os campos obrigatórios!')</script>";
    }

    if(empty($recuperation_email)){
        $recuperation_email = $email;
    }

    if ($password != $password_repeat) {
        echo "<script>alert('As senhas não coincidem!')</script>";
    }
    $random = rand(0, 100);

    if(isset($first_name) && isset($last_name) && isset($email) && isset($password) && isset($password_repeat)){
        $name = $first_name . " " . $last_name;
        $sql = "INSERT INTO usuario (nome, email, email_recuperacao, senha, rf_id) VALUES ('$name', '$email', '$recuperation_email', '$password', '$random')";
        
        if($result = $db->query($sql)){
            $sql = "SELECT * FROM usuario WHERE email = '$email' AND senha = '$password'";
            $return = $db->query($sql);
            if($db->num_rows($return)){
                $user = $db->fetch_assoc($return);
                $session->login($user['id']);
            }
            header("Location: index.php");
        }else{
            echo "<script>alert('Erro ao criar conta!')</script>";
        }
    }


}

?>
<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Register - Brand</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css?h=39f612d0af5b74e3058ab6d89e114e6a">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
    <link rel="stylesheet" href="assets/css/styles.min.css?h=eb3772a3b0c90f0f09d3ba9281a77e5f">
</head>

<body class="bg-gradient-primary" style="background: #40edaf;">
    <div class="container" style="background: #40edaf;">
        <div class="card shadow-lg o-hidden border-0 my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-flex">
                        <div class="flex-grow-1 bg-register-image"
                            style="background: url(&quot;https://www.cicnews.com/wp-content/uploads/2020/03/20200305NigerianStudents-1.jpg&quot;) center / cover no-repeat;">
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h4 class="text-dark mb-4">Criar uma conta!</h4>
                            </div>
                            <form class="user" method="post">
                                <div class="row mb-3">
                                    <div class="col-sm-6 mb-3 mb-sm-0"><input class="form-control form-control-user"
                                            type="text" id="exampleFirstName" placeholder="Primeiro Nome*"
                                            name="first_name" required></div>
                                    <div class="col-sm-6"><input class="form-control form-control-user" type="text"
                                            id="exampleLastName" placeholder="Último Nome*" name="last_name"  required></div>
                                </div>
                                <div class="mb-3"><input class="form-control form-control-user" type="email"
                                        id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Email*"
                                        name="email" required></div>
                                <div class="mb-3"><input class="form-control form-control-user" type="email"
                                        aria-describedby="recuperationEmailHelp" placeholder="Email de Recuperação"
                                        name="recuperation_email"></div>
                                <div class="row mb-3">
                                    <div class="col-sm-6 mb-3 mb-sm-0"><input class="form-control form-control-user"
                                            type="password" id="examplePasswordInput" placeholder="Password*"
                                            name="password" required></div>
                                    <div class="col-sm-6"><input class="form-control form-control-user" type="password"
                                            id="exampleRepeatPasswordInput" placeholder="Confirmar Password*"
                                            name="password_repeat" required></div>
                                </div><button class="btn btn-primary d-block btn-user w-100" type="submit">Registar Conta</button>
                                <hr><a class="btn btn-primary d-block btn-google btn-user w-100 mb-2" role="button"
                                    style="background: rgb(0,0,0);"><i class="fab fa-google"></i> Registar com o Google</a><a class="btn btn-primary d-block btn-facebook btn-user w-100"
                                    role="button" style="background: #3b5998;"><i class="fab fa-facebook-f"></i>Registar com Facebook</a>
                                <hr>
                            </form>
                            <div class="text-center"><a class="small" href="login.php">Já possui uma conta?
                                    Login!</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.min.js?h=bdf36300aae20ed8ebca7e88738d5267"></script>
</body>

</html>