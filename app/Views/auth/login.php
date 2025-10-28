<!DOCTYPE html>

<!-- beautify ignore:start -->
<html
    lang="en"
    class="light-style customizer-hide"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="<?php echo base_url(); ?>assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Login</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/img/favicon/bawaslu_icon.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="<?php echo base_url(); ?>assets/js/config.js"></script>
</head>

<body>
    <!-- Content -->

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register -->
                <div class="card">
                    <div class="card-body">

                        <!-- Logo -->
                        <div class="app-brand justify-content-center mb-4">
                            <a href="/" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">
                                    <img src="<?php echo base_url(); ?>assets/img/favicon/bawaslu.png" alt="Logo" height="60">
                                </span>
                            </a>
                        </div>
                        <!-- /Logo -->

                        <h4 class="mb-2 text-center">SABAR - Sistem Administrasi Barang</h4>
                        <p class="mb-4 text-center">Sistem Administrasi Barang Milik Negara</p>

                        <?php if (session()->has('error')): ?>
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <?php echo session('error') ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <?php if (session()->has('success')): ?>
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <?php echo session('success') ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <form id="formAuthentication" class="mb-3" action="<?php echo base_url('proses-login') ?>" method="POST">
                            <?php echo csrf_field() ?>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-user"></i></span>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="username"
                                        name="username"
                                        placeholder="Masukkan username"
                                        autofocus />
                                </div>
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Password</label>
                                </div>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-lock-alt"></i></span>
                                    <input
                                        type="password"
                                        id="password"
                                        class="form-control"
                                        name="password"
                                        placeholder="Masukkan password"
                                        aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>

                            <div class="mb-3">
                                <button class="btn btn-danger d-grid w-100" type="submit">
                                    <i class="bx bx-log-in-circle me-2"></i>Masuk
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>





    <!-- Core JS (jQuery HARUS paling atas sebelum toastr dipanggil) -->
    <script src="<?php echo base_url(); ?>assets/vendor/libs/jquery/jquery.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/libs/popper/popper.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/js/bootstrap.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/js/menu.js"></script>

    <!-- Toastr -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        $(document).ready(function() {
            // Konfigurasi toastr
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "timeOut": "4000",
                "extendedTimeOut": "2000",
                "showDuration": "300",
                "hideDuration": "1000",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };

            // Flashdata error tunggal
            <?php if (session()->getFlashdata('error')): ?>
                toastr.error('<?php echo esc(session()->getFlashdata('error'), 'js') ?>');
            <?php endif; ?>

            // Flashdata banyak error (array errors)
            <?php if (session()->getFlashdata('errors')): ?>
                let errors =<?php echo json_encode(session()->getFlashdata('errors')); ?>;
                let errorMessage = '';
                for (let key in errors) {
                    if (errors.hasOwnProperty(key)) {
                        errorMessage += errors[key] + '<br>';
                    }
                }
                toastr.error(errorMessage);
            <?php endif; ?>

            // Flashdata sukses
            <?php if (session()->getFlashdata('success')): ?>
                toastr.success('<?php echo esc(session()->getFlashdata('success'), 'js') ?>');
            <?php endif; ?>

            // Flashdata peringatan (opsional)
            <?php if (session()->getFlashdata('warning')): ?>
                toastr.warning('<?php echo esc(session()->getFlashdata('warning'), 'js') ?>');
            <?php endif; ?>

            // Flashdata info (opsional)
            <?php if (session()->getFlashdata('info')): ?>
                toastr.info('<?php echo esc(session()->getFlashdata('info'), 'js') ?>');
            <?php endif; ?>
        });
    </script>

    <!-- Main JS -->
    <script src="<?php echo base_url(); ?>assets/js/main.js"></script>

</body>

</html>