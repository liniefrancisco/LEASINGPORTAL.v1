<!DOCTYPE html>
<html lang="en">
<<<<<<< HEAD

=======
>>>>>>> eeae2af07a0576f503f3a1d47c6cd26368265e68
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Leasing Portal | Log in</title>
    <link rel="icon" href="<?php echo base_url()?>img/LeasingPortalLogo.png">
<<<<<<< HEAD

=======
>>>>>>> eeae2af07a0576f503f3a1d47c6cd26368265e68
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/adminlte.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/sweetalert2/sweetalert2.all.min.css">
</head>

<body class="hold-transition login-page">
<<<<<<< HEAD
=======
    <div class="jumbotron jumbotron_leasing"></div>
>>>>>>> eeae2af07a0576f503f3a1d47c6cd26368265e68
    <div class="login-box">
        <div class="card">
            <div class="card-header text-center">
                <img class="profile-img" src="<?php echo base_url(); ?>img/AGC-Leasing-portal.png" alt="" style="width: 200px; height: 120px;">
            </div>
            <div class="card-body login-card-body">
<<<<<<< HEAD
                <!-- <img class="profile-img" src="<?php echo base_url(); ?>img/AGC-Leasing-portal.png" alt=""> -->
=======
>>>>>>> eeae2af07a0576f503f3a1d47c6cd26368265e68
                <p class="login-box-msg">Login in to start your session</p>

                <form method="post" id="loginform">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="username" placeholder="Username" required autocomplete="off">
                        <div class="input-group-append">
<<<<<<< HEAD
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
=======
                            <div class="input-group-text"><span class="fas fa-user"></span></div>
>>>>>>> eeae2af07a0576f503f3a1d47c6cd26368265e68
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password" required autocomplete="off">
                        <div class="input-group-append">
<<<<<<< HEAD
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <!-- <div class="icheck-primary">
=======
                            <div class="input-group-text"><span class="fas fa-lock"></span></div>
                        </div>
                    </div>
                    <!-- <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
>>>>>>> eeae2af07a0576f503f3a1d47c6cd26368265e68
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
<<<<<<< HEAD
                            </div> -->
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Log In</button>
                        </div>
                        <!-- /.col -->
                    </div>
=======
                            </div>
                        </div>
                    </div> -->
                    <div class="row d-flex justify-content-end">
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-lg btn-info btn-block" >Login</button>  
                        </div>
                        <a href="JavaScript:void(0)" onclick="window.history.back()" class="pull-right need-help pt-5"><u>Back to main menu? </u></a>
                        <span class="clearfix"></span>  
                    </div>
                    
>>>>>>> eeae2af07a0576f503f3a1d47c6cd26368265e68
                </form>

                <!-- <p class="mb-1">
                    <a href="forgot-password.html">I forgot my password</a>
                </p> -->
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url(); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>dist/js/adminlte.min.js"></script>
    <script src="<?php echo base_url(); ?>plugins/sweetalert2/sweetalert2.all.min.js"></script>

    <script>
        window.$base_url = `<?= base_url() ?>`
        window.$tenantID = `<?= $this->session->userdata('tenant_id') ?>`

        $("#loginform").submit(function(e){
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: `${$base_url}checkuser`,
                data: $("#loginform").serialize(),
                success: function(data) {
                    if(data['info'] == 'Tenant')
                    {
                        window.location.href = 'home';
                    }
                    else if(data['info'] == 'Admin')
                    {
                        window.location.href = 'admindashboard';
                    }
                    else if(data['info'] == 'Error')
                    {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'error',
                            title: data['info'],
                            text: data['message']
                        })
                    }
                }
            });
        });
    </script>
</body>

</html>