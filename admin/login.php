<?php
   if (isset($_GET['cerrar_sesion'])) {
       session_start();
       $_SESSION = [];
   }
?>
<?php include_once './templates/header.php'; ?>
<?php include_once './functions/funciones.php'; ?>

<body class="hold-transition login-page">
    <!-- Site wrapper -->
    <!-- Div de la class wrapper que la he eliminado -->
    <div class="login-page">

        <div class="login-box">
            <div class="login-logo">
                <a href="#"><b>GDL</b>WebCamp</a>
            </div>
            <!-- /.login-logo -->
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Sign in to start your session</p>

                    <!-- Formulario de login -->
                    <form action="#" method="post" name="login-admin-form">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="usuario" placeholder="Usuario">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" placeholder="Password" name="password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <input type="hidden" name="login-admin" value="1">
                                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>

                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
        <!-- /.login-box -->


        <?php include_once './templates/footer.php'; ?>