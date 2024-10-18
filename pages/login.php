<?php
    include("head.php");
?>

<body class="bg-gradient-primary" style="background: #40edaf;">
    <div class="container" style="background: #40edaf;">
        <div class="row justify-content-center" style="background: #40edaf;">
            <div class="col-md-9 col-lg-12 col-xl-10">
                <div class="card shadow-lg o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-flex">
                                <div class="flex-grow-1 bg-login-image"
                                    style="background: url('https://www.cicnews.com/wp-content/uploads/2020/03/20200305NigerianStudents-1.jpg') center / cover;opacity: 0.93;filter: blur(0px);">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h4 class="text-dark mb-4">Boas Vindas!</h4>
                                    </div>
                                    <form class="user">
                                        <div class="mb-3"><input class="form-control form-control-user" type="email"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Insira o email..." name="email"></div>
                                        <div class="mb-3"><input class="form-control form-control-user" type="password"
                                                id="exampleInputPassword" placeholder="Password" name="password"></div>
                                        <button class="btn btn-primary d-block btn-user w-100"
                                            type="submit">Login</button>
                                        <hr><a class="btn btn-primary d-block btn-google btn-user w-100 mb-2"
                                            role="button" style="background: rgb(0,0,0);"><i
                                                class="fab fa-google"></i>&nbsp; Login with Google</a><a
                                            class="btn btn-primary d-block btn-facebook btn-user w-100" role="button"
                                            style="background: #3b5998;"><i class="fab fa-facebook-f"></i>&nbsp; Login
                                            with Facebook</a>
                                        <hr>
                                    </form>
                                    <div class="text-center"><a class="small" href="forgot-password.php">Forgot
                                            Password?</a></div>
                                    <div class="text-center"><a class="small" href="register.php">Create an
                                            Account!</a></div>
                                </div>
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