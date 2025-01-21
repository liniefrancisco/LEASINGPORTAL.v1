<!DOCTYPE html>
<html lang="en" ng-app="app">
<<<<<<< HEAD

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Leasing Portal |
        <?php echo $title; ?>
    </title>
    <link rel="icon" href="<?php echo base_url(); ?>img/LeasingPortalLogo.png">

=======
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Leasing Portal | <?php echo $title; ?></title>
    <link rel="icon" href="<?php echo base_url(); ?>img/LeasingPortalLogo.png">
>>>>>>> eeae2af07a0576f503f3a1d47c6cd26368265e68
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/adminlte.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/style.css">
<<<<<<< HEAD
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
=======
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/build/scss">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
>>>>>>> eeae2af07a0576f503f3a1d47c6cd26368265e68
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/sweetalert2/sweetalert2.all.min.css">
</head>

<<<<<<< HEAD
<body class="hold-transition layout-top-nav" ng-clock>
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-dark navbar-dark">
            <div class="container-fluid">
                <a href="<?php echo base_url(); ?>admindashboard" class="navbar-brand">
                    <img class="brand-image" src="<?php echo base_url(); ?>img/LeasingPortalLogo.png"
                        style="opacity: .8">
                    <span class="brand-text font-weight-heavy">LEASING PORTAL ADMIN</span>
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse"
                    data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        <?php if ($this->session->userdata('user_type') == 'Admin'): ?>
                            <li class="nav-item">
                                <a href="<?php echo base_url(); ?>adminusers" class="nav-link"><i class="fas fa-user"></i>
                                    Users</a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item dropdown">
                            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" class="nav-link dropdown-toggle"><i class="fas fa-upload"></i>
                                Uploading</a>
                            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                <li class="dropdown-submenu dropdown-hover">

                                    <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false"
                                        class="dropdown-item dropdown-toggle">Invoice Data</a>
                                    <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                                        <li><a href="<?php echo base_url(); ?>admininvoicepertenant"
                                                class="dropdown-item">Upload Invoice Per Tenant</a></li>
                                    </ul>
                                </li>
                                <li><a href="<?php echo base_url(); ?>adminsoa" class="dropdown-item">SOA Data </a></li>
                                <li class="dropdown-submenu dropdown-hover">

                                    <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false"
                                        class="dropdown-item dropdown-toggle">Payment Data</a>
                                    <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                                        <li><a href="<?php echo base_url(); ?>paymentpertenant"
                                                class="dropdown-item">Upload Payment Per Tenant</a></li>
                                        <li><a href="<?php echo base_url(); ?>paymentperstore"
                                                class="dropdown-item">Upload Payment Per Store</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" class="nav-link dropdown-toggle"><i class="fas fa-print"></i>
                                Reports</a>
                            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                <li><a href="<?php echo base_url(); ?>uploadinghistory" class="dropdown-item">Upload
                                        History </a></li>
                                <!-- <li><a href="<?php echo base_url(); ?>paymentnotices" class="dropdown-item">Payment Advice Notices </a></li>
                                <li><a href="<?php echo base_url(); ?>paymentnoticeshistory" class="dropdown-item">Payment Advice History </a></li> -->
                            </ul>
                        </li>

                        <?php if ($this->session->userdata('user_type') == 'Admin'): ?>
                            <!-- <li class="nav-item">
                                <a href="<?php echo base_url(); ?>blastUser" class="nav-link"><i class="fas fa-paper-plane"></i> Blast SMS/Email Users</a>
                            </li> -->
                        <?php endif; ?>
                    </ul>
                </div>

                <!-- Right navbar links -->
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <!-- <a class="nav-link" href="<?php echo base_url(); ?>paymentnotices">
                Payment Advice
                <i class="far fa-bell"></i>
                <span class="badge badge-danger navbar-badge"><b><?php echo $count; ?></b></span>
            </a> -->
                    <li class="nav-item">
                        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                            <i class="fas fa-arrow-alt-circle-left"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
=======
<body class="hold-transition sidebar-mini" ng-clock>
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a></li>
            </ul>
        </nav>

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="<?php echo base_url(); ?>admindashboard" class="brand-link">
                <img class="brand-image" src="<?php echo base_url(); ?>img/LeasingPortalLogo.png" style="opacity: .8">
                <span class="brand-text font-weight-heavy">LEASING PORTAL</span><br>
                <center><h6 class="user_type"><?php echo ($this->session->userdata('user_type') == 'Admin') ? 'Administrator' : $this->session->userdata('user_type'); ?></h6></center>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <nav class="navbar">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <?php if ($this->session->userdata('user_type') == 'Admin'): ?><!-- If the user is Admin -->
                            <li class="nav-item">
                                <a href="<?php echo base_url(); ?>adminusers" class="nav-link <?php echo ($this->uri->segment(1) == 'adminusers') ? 'active' : ''; ?>"><i class="nav-icon fas fa-user"></i>Users</a>
                            </li>
                        <?php endif; ?>

                        <!-- Uploading Section -->
                        <li class="nav-item has-treeview <?php echo ($this->uri->segment(1) == 'admininvoicepertenant' || $this->uri->segment(1) == 'adminsoa' || $this->uri->segment(1) == 'paymentpertenant' || $this->uri->segment(1) == 'paymentperstore') ? 'menu-open' : ''; ?>">
                            <a href="#"
                                class="nav-link <?php echo ($this->uri->segment(1) == 'admininvoicepertenant' || $this->uri->segment(1) == 'adminsoa' || $this->uri->segment(1) == 'paymentpertenant' || $this->uri->segment(1) == 'paymentperstore') ? 'active' : ''; ?>">
                                <i class="nav-icon fas fa-upload"></i>Uploading<i class="fas fa-angle-left right"></i>
                            </a>

                            <!-- Invoice Data Section -->
                            <ul class="nav nav-treeview">
                                <li
                                    class="nav-item has-treeview <?php echo ($this->uri->segment(1) == 'admininvoicepertenant') ? 'menu-open' : ''; ?>">
                                    <a href="#"
                                        class="nav-link <?php echo ($this->uri->segment(1) == 'admininvoicepertenant') ? 'active' : ''; ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Invoice Data
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>

                                    <!-- Payment Data Submenu -->
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="<?php echo base_url(); ?>admininvoicepertenant"
                                                class="nav-link <?php echo ($this->uri->segment(1) == 'admininvoicepertenant') ? 'active' : ''; ?>">
                                                <i class="fas fa-angle-right nav-icon"></i>
                                                <p>Upload Per Tenant</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <!-- <li class="nav-item">
                            <a href="<?php echo base_url(); ?>admininvoicepertenant"
                                class="nav-link <?php echo ($this->uri->segment(1) == 'admininvoicepertenant') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Upload Invoice Per Tenant</p>
                            </a>
                        </li> -->

                                <!-- SOA Data Section -->
                                <li class="nav-item">
                                    <a href="<?php echo base_url(); ?>adminsoa"
                                        class="nav-link <?php echo ($this->uri->segment(1) == 'adminsoa') ? 'active' : ''; ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>SOA Data</p>
                                    </a>
                                </li>

                                <!-- Payment Data Section -->
                                <li
                                    class="nav-item has-treeview <?php echo ($this->uri->segment(1) == 'paymentpertenant' || $this->uri->segment(1) == 'paymentperstore') ? 'menu-open' : ''; ?>">
                                    <a href="#"
                                        class="nav-link <?php echo ($this->uri->segment(1) == 'paymentpertenant' || $this->uri->segment(1) == 'paymentperstore') ? 'active' : ''; ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Payment Data
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>

                                    <!-- Payment Data Submenu -->
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="<?php echo base_url(); ?>paymentpertenant"
                                                class="nav-link <?php echo ($this->uri->segment(1) == 'paymentpertenant') ? 'active' : ''; ?>">
                                                <i class="fas fa-angle-right nav-icon"></i>
                                                <p>Upload Per Tenant</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo base_url(); ?>paymentperstore"
                                                class="nav-link <?php echo ($this->uri->segment(1) == 'paymentperstore') ? 'active' : ''; ?>">
                                                <i class="fas fa-angle-right nav-icon"></i>
                                                <p>Upload Per Store</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            <!-- Reports Section -->
                        <li
                            class="nav-item has-treeview <?php echo ($this->uri->segment(1) == 'uploadinghistory') ? 'menu-open' : ''; ?>">
                            <a href="#"
                                class="nav-link <?php echo ($this->uri->segment(1) == 'uploadinghistory') ? 'active' : ''; ?>">
                                <i class="nav-icon fas fa-print"></i>
                                <p>
                                    Reports
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item ">
                                    <a href="<?php echo base_url(); ?>uploadinghistory"
                                        class="nav-link <?php echo ($this->uri->segment(1) == 'uploadinghistory') ? 'active' : ''; ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Upload History</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- If the user is Admin -->
                        <?php if ($this->session->userdata('user_type') == 'Admin'): ?>
                            <!-- Example of another Admin-only item -->
                            <!-- <li class="nav-item">
            <a href="<?php echo base_url(); ?>blastUser" class="nav-link">
                <i class="fas fa-paper-plane nav-icon"></i>
                <p>Blast SMS/Email Users</p>
            </a>
        </li> -->
                        <?php endif; ?>
                        <div class="user-panel mt-3 pb-3 mb-3 d-flex"></div>

                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>logout" class="nav-link">
                                <i class=" nav-icon fas fa-sign-out-alt"></i>
                                <p>Log Out</p>
                            </a>
                        </li>
                        </li>
                    </ul>
                </nav>
            </div>



            <!-- /.sidebar -->
        </aside>
>>>>>>> eeae2af07a0576f503f3a1d47c6cd26368265e68
        <!-- LOADING MODAL -->
        <div class="modal_loading" id="loading">
            <div class="mr-3">
                <center><img id="loading-image" width="50px;" src="<?php echo base_url(); ?>img/spinner2.svg"></center>
            </div>
            <div class="loader-text" style="margin-top: 5px;">
                <center><b id="app-loader-msg">Loading, Please wait ...</b></center>
            </div>
        </div>
        <!-- LOADING MODAL -->