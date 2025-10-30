<!DOCTYPE html>
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

    <title>SABAR - Login & Scan QR</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/img/favicon/bawaslu_icon.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/css/pages/page-auth.css" />

    <!-- Toastr -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

    <style>
        /* Custom Tab Styles */
        .nav-tabs-custom {
            border-bottom: 2px solid #d9dee3;
            margin-bottom: 2rem;
        }

        .nav-tabs-custom .nav-link {
            border: none;
            color: #697a8d;
            padding: 1rem 1.5rem;
            font-weight: 500;
            position: relative;
            transition: all 0.3s ease;
        }

        .nav-tabs-custom .nav-link:hover {
            color: #696cff;
            background-color: transparent;
        }

        .nav-tabs-custom .nav-link.active {
            color: #696cff;
            background-color: transparent;
            border: none;
        }

        .nav-tabs-custom .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 2px;
            background: #696cff;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                transform: scaleX(0);
            }
            to {
                transform: scaleX(1);
            }
        }

        .nav-tabs-custom .nav-link i {
            font-size: 1.2rem;
            margin-right: 0.5rem;
        }

        /* QR Scanner Styles */
        #qr-reader {
            border: 2px solid #dee2e6;
            border-radius: 0.5rem;
            overflow: hidden;
            background-color: #000;
            position: relative;
            min-height: 300px;
            margin-bottom: 1rem;
        }

        #qr-reader video {
            width: 100% !important;
            height: auto !important;
            border-radius: 0.5rem;
        }

        #qr-reader canvas {
            width: 100% !important;
            height: auto !important;
        }

        #qr-reader__dashboard {
            display: none !important;
        }

        #qr-reader__status_span {
            display: none !important;
        }

        .loading-spinner {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 10;
        }

        .spinner-border-custom {
            width: 3rem;
            height: 3rem;
        }

        .scan-instruction {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1.5rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .scan-instruction i {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
            display: block;
        }

        #qr-reader-results {
            min-height: 60px;
        }

        .result-card {
            animation: fadeIn 0.3s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            #qr-reader {
                min-height: 250px;
            }

            .nav-tabs-custom .nav-link {
                padding: 0.75rem 1rem;
                font-size: 0.9rem;
            }

            .nav-tabs-custom .nav-link i {
                font-size: 1rem;
            }
        }
    </style>

    <script src="<?php echo base_url(); ?>assets/vendor/js/helpers.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/config.js"></script>
</head>

<body>
    <!-- Content -->
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Main Card -->
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

                        <!-- Tabs Navigation -->
                        <ul class="nav nav-tabs nav-tabs-custom" id="authTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="login-tab" data-bs-toggle="tab" data-bs-target="#login-content" type="button" role="tab" aria-controls="login-content" aria-selected="true">
                                    <i class="bx bx-log-in-circle"></i> Login
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="scan-tab" data-bs-toggle="tab" data-bs-target="#scan-content" type="button" role="tab" aria-controls="scan-content" aria-selected="false">
                                    <i class="bx bx-qr-scan"></i> Scan QR Code
                                </button>
                            </li>
                        </ul>

                        <!-- Tabs Content -->
                        <div class="tab-content" id="authTabsContent">
                            <!-- LOGIN TAB -->
                            <div class="tab-pane fade show active" id="login-content" role="tabpanel" aria-labelledby="login-tab">
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

                                <div class="text-center">
                                    <p class="text-muted">
                                        <small>Atau scan QR Code untuk melihat detail barang</small>
                                    </p>
                                </div>
                            </div>

                            <!-- SCAN QR TAB -->
                            <div class="tab-pane fade" id="scan-content" role="tabpanel" aria-labelledby="scan-tab">
                                <!-- Instructions -->
                                <div class="scan-instruction">
                                    <i class="bx bx-qr-scan"></i>
                                    <h6 class="mb-2">Cara Scan QR Code</h6>
                                    <p class="mb-0 small">
                                        Klik tombol <strong>"Mulai Scan"</strong> lalu arahkan kamera ke QR Code pada barang
                                    </p>
                                </div>

                                <!-- QR Reader -->
                                <div id="qr-reader" style="display: none;">
                                    <div class="loading-spinner">
                                        <div class="spinner-border text-light spinner-border-custom" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Results -->
                                <div id="qr-reader-results"></div>

                                <!-- Scanner Actions -->
                                <div class="d-grid gap-2">
                                    <button id="start-scan" class="btn btn-primary">
                                        <i class="bx bx-camera me-2"></i>Mulai Scan
                                    </button>
                                    <button id="stop-scan" class="btn btn-danger" style="display: none;">
                                        <i class="bx bx-stop-circle me-2"></i>Berhenti
                                    </button>
                                </div>

                                <!-- Info Alert -->
                                <div class="alert alert-info mt-3" role="alert">
                                    <i class="bx bx-info-circle me-2"></i>
                                    <strong>Catatan:</strong> Pastikan browser mengizinkan akses kamera.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Main Card -->
            </div>
        </div>
    </div>

    <!-- Core JS -->
    <script src="<?php echo base_url(); ?>assets/vendor/libs/jquery/jquery.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/libs/popper/popper.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/js/bootstrap.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/js/menu.js"></script>

    <!-- Toastr -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- HTML5 QR Code Library -->
    <script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>

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

            // Flash messages
            <?php if (session()->getFlashdata('error')): ?>
                toastr.error('<?php echo esc(session()->getFlashdata('error'), 'js') ?>');
            <?php endif; ?>

            <?php if (session()->getFlashdata('errors')): ?>
                let errors = <?php echo json_encode(session()->getFlashdata('errors')); ?>;
                let errorMessage = '';
                for (let key in errors) {
                    if (errors.hasOwnProperty(key)) {
                        errorMessage += errors[key] + '<br>';
                    }
                }
                toastr.error(errorMessage);
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')): ?>
                toastr.success('<?php echo esc(session()->getFlashdata('success'), 'js') ?>');
            <?php endif; ?>

            <?php if (session()->getFlashdata('warning')): ?>
                toastr.warning('<?php echo esc(session()->getFlashdata('warning'), 'js') ?>');
            <?php endif; ?>

            <?php if (session()->getFlashdata('info')): ?>
                toastr.info('<?php echo esc(session()->getFlashdata('info'), 'js') ?>');
            <?php endif; ?>

            // QR Scanner Logic
            let html5QrCode = null;
            let isScanning = false;

            // Start Scan
            $('#start-scan').click(function() {
                startScanner();
            });

            // Stop Scan
            $('#stop-scan').click(function() {
                stopScanner();
            });

            // Stop scanner when switching tabs
            $('#login-tab').click(function() {
                if (isScanning) {
                    stopScanner();
                }
            });

            function startScanner() {
                if (isScanning) {
                    toastr.warning('Scanner sudah aktif');
                    return;
                }

                $('#qr-reader').show();
                $('#start-scan').hide();
                $('#stop-scan').show();

                html5QrCode = new Html5Qrcode("qr-reader");

                const config = {
                    fps: 10,
                    qrbox: { width: 250, height: 250 },
                    aspectRatio: 1.0,
                    videoConstraints: {
                        facingMode: { ideal: "environment" }
                    }
                };

                html5QrCode.start(
                    { facingMode: "environment" },
                    config,
                    onScanSuccess,
                    onScanError
                ).then(() => {
                    isScanning = true;
                    $('.loading-spinner').hide();
                    toastr.success('Scanner aktif. Arahkan ke QR Code');
                }).catch(err => {
                    console.error("Error starting scanner:", err);
                    showError('Tidak dapat mengakses kamera. Pastikan izin kamera telah diberikan.');
                    stopScanner();
                });
            }

            function stopScanner() {
                if (!html5QrCode || !isScanning) {
                    return;
                }

                html5QrCode.stop().then(() => {
                    html5QrCode.clear();
                    isScanning = false;
                    $('#qr-reader').hide();
                    $('.loading-spinner').show();
                    $('#start-scan').show();
                    $('#stop-scan').hide();
                    clearResults();
                }).catch(err => {
                    console.error("Error stopping scanner:", err);
                });
            }

            function onScanSuccess(decodedText, decodedResult) {
                console.log('QR Code detected:', decodedText);

                // Stop scanning
                stopScanner();

                // Show success
                showSuccess('QR Code berhasil dipindai! Mengarahkan...');

                // Validate and redirect
                if (isValidUrl(decodedText)) {
                    setTimeout(() => {
                        window.location.href = decodedText;
                    }, 1500);
                } else {
                    showError('QR Code tidak valid atau bukan URL yang benar.');
                }
            }

            function onScanError(errorMessage) {
                // Silent error handling
            }

            function showSuccess(message) {
                const html = `
                    <div class="alert alert-success alert-dismissible fade show result-card" role="alert">
                        <i class="bx bx-check-circle me-2"></i>${message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                `;
                $('#qr-reader-results').html(html);
                toastr.success(message);
            }

            function showError(message) {
                const html = `
                    <div class="alert alert-danger alert-dismissible fade show result-card" role="alert">
                        <i class="bx bx-error-circle me-2"></i>${message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                `;
                $('#qr-reader-results').html(html);
                toastr.error(message);
            }

            function clearResults() {
                $('#qr-reader-results').html('');
            }

            function isValidUrl(string) {
                try {
                    const url = new URL(string);
                    return url.protocol === 'http:' || url.protocol === 'https:';
                } catch (_) {
                    return false;
                }
            }

            // Clean up on page unload
            $(window).on('beforeunload', function() {
                if (isScanning) {
                    stopScanner();
                }
            });
        });
    </script>

    <!-- Main JS -->
    <script src="<?php echo base_url(); ?>assets/js/main.js"></script>
</body>

</html>