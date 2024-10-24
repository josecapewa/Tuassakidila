<?php
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

    if (empty($recuperation_email)) {
        $recuperation_email = $email;
    }

    if ($password != $password_repeat) {
        echo "<script>alert('As senhas não coincidem!')</script>";
    }
    $random = rand(0, 100);

    if (isset($first_name) && isset($last_name) && isset($email) && isset($password) && isset($password_repeat)) {
        $name = $first_name . " " . $last_name;
        $sql = "INSERT INTO usuario (nome, email, email_recuperacao, senha, rf_id) VALUES ('$name', '$email', '$recuperation_email', '$password', '$random')";

        if ($result = $db->query($sql)) {
            $sql = "SELECT * FROM usuario WHERE email = '$email' AND senha = '$password'";
            $return = $db->query($sql);
            if ($db->num_rows($return)) {
                $user = $db->fetch_assoc($return);
                $session->login($user['id']);
            }
            header("Location: index.php");
        } else {
            echo "<script>alert('Erro ao criar conta!')</script>";
        }
    }
}

?>

<?php
include("head.php");
?>

<body style="display:flex; background: #386641; justify-content:center; align-items:center; height:100vh ;">
    <div class="container">
        <div class="card shadow-lg o-hidden border-0 my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-flex">
                        <div class="flex-grow-1 bg-login-image"
                            style="background: url('./assets/img/recycling.jpg') center / cover; filter: blur(0px);">
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h4 class="text-dark mb-4">Criar uma conta!</h4>
                            </div>
                            <form class="user" method="post">
                                <div class="row mb-3">
                                    <div class="col-sm-6 mb-3 mb-sm-0"><input class="form-control" style="border-radius: 10px; height:40px"
                                            type="text" id="exampleFirstName" placeholder="Primeiro Nome*"
                                            name="first_name" required></div>
                                    <div class="col-sm-6"><input class="form-control" style="border-radius: 10px; height:40px" type="text"
                                            id="exampleLastName" placeholder="Último Nome*" name="last_name" required></div>
                                </div>
                                <div class="mb-3"><input class="form-control" style="border-radius: 10px; height:40px" type="email"
                                        id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Email*"
                                        name="email" required></div>
                                <div class="mb-3"><input class="form-control" style="border-radius: 10px; height:40px" type="email"
                                        aria-describedby="recuperationEmailHelp" placeholder="Email de Recuperação"
                                        name="recuperation_email"></div>
                                <div class="row mb-3">
                                    <div class="col-sm-6 mb-3 mb-sm-0"><input class="form-control" style="border-radius: 10px; height:40px"
                                            type="password" id="examplePasswordInput" placeholder="Password*"
                                            name="password" required></div>
                                    <div class="col-sm-6"><input class="form-control" style="border-radius: 10px; height:40px" type="password"
                                            id="exampleRepeatPasswordInput" placeholder="Confirmar Password*"
                                            name="password_repeat" required></div>
                                </div><button class="btn btn-primary d-block btn-user w-100" style="border-radius: 10px" type="submit">Registar Conta</button>
                                <hr>
                                <div style="display: flex; gap:10px; justify-content:center;">
                                    <article>
                                        <a class="btn btn-primary d-block btn-google btn-user w-100 mb-2"
                                            role="button" style="background: rgb(0,0,0); border-color:rgb(0,0,0); border-radius: 10px"><i
                                                class="fab fa-google"></i>&nbsp; Login with Google</a>
                                    </article>
                                    <article>
                                        <a
                                            class="btn btn-primary d-block btn-facebook btn-user w-100" role="button"
                                            style="background: #3b5998; border-color:#3b5998; border-radius: 10px"><i class="fab fa-facebook-f"></i>&nbsp; Login
                                            with Facebook</a>
                                    </article>
                                </div>
                                <hr>
                            </form>
                            <div class="text-center"><a class="small"  style="text-decoration: none;" href="login.php">Já Possui ima Conta?
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