<!-- Toastr Styles & Scripts -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?= base_url(); ?>assets/vendor/libs/jquery/jquery.js"></script>
<script src="<?= base_url(); ?>assets/js/ui-toasts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    $(document).ready(function() {
        // Konfigurasi Toastr
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

        // Flashdata: Error tunggal
        <?php if (session()->getFlashdata('error')): ?>
            toastr.error('<?= esc(session()->getFlashdata('error'), 'js') ?>');
        <?php endif; ?>

        // Flashdata: Banyak error (hasil validasi)
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

        // Flashdata: Sukses
        <?php if (session()->getFlashdata('success')): ?>
            toastr.success('<?= esc(session()->getFlashdata('success'), 'js') ?>');
        <?php endif; ?>

        // Flashdata: Warning
        <?php if (session()->getFlashdata('warning')): ?>
            toastr.warning('<?= esc(session()->getFlashdata('warning'), 'js') ?>');
        <?php endif; ?>

        // Flashdata: Info
        <?php if (session()->getFlashdata('info')): ?>
            toastr.info('<?= esc(session()->getFlashdata('info'), 'js') ?>');
        <?php endif; ?>
        // toast validation message
        <?php if (session()->getFlashdata('validation')): ?>
            $(document).ready(function() {
                toastr.error('<?= implode(", ", session()->getFlashdata('validation')->getErrors()) ?>');
            });
        <?php endif; ?>
    });
</script>