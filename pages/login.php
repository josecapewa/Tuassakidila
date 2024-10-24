<?php
require_once('../includes/load.php');
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    if (!empty($email) && !empty($password)) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $sql = "SELECT * FROM usuario WHERE email = '$email' AND senha = '$password'";
            $result = $db->query($sql);
            if ($db->num_rows($result)) {
                $user = $db->fetch_assoc($result);
                $session->login($user['id']);
                header('location: index.php');
            }
        }
    }
}

?>

<?php include("head.php"); ?>

<body class="bg-gradient-primary" style=" background: #386641;">
    <div style="display:flex; justify-content:center; align-items:center; height:100vh">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-9 col-lg-12 col-xl-10">
                    <div class="card shadow-lg o-hidden border-0 my-5">
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-lg-6 d-none d-lg-flex">
                                    <div class="flex-grow-1 bg-login-image"
                                        style="background: url('./assets/img/recycling.jpg') center / cover; filter: blur(0px);">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h4 class="text-dark mb-4">Boas Vindas!</h4>
                                        </div>
                                        <form action="login.php" class="user" method="POST">
                                            <div class="mb-3"><input class="form-control " style="border-radius: 10px; height:40px" type="email"
                                                    id="exampleInputEmail" aria-describedby="emailHelp"
                                                    placeholder="Insira o email..." name="email"></div>
                                            <div class="mb-3"><input class="form-control " style="border-radius: 10px; height:40px" type="password"
                                                    id="exampleInputPassword" placeholder="Password" name="password"></div>
                                            <button class="btn btn-primary d-block btn-user w-100"
                                                style="border-radius: 10px" type="submit">Login</button>
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
                                        <div class="text-center"><a class="small" style="text-decoration: none;" href="forgot-password.php">Esqueceu a Senha?</a></div>
                                        <div class="text-center"><a class="small" style="text-decoration: none;" href="register.php">Criar Conta!</a></div>
                                    </div>
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