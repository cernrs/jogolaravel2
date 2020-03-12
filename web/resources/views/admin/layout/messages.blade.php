
@if ($errors->any())

    <?php  

    $mensagem = "<ul>";
    foreach ($errors->all() as $error) {
    $mensagem .= "<li>".$error."</li>";  
    }
    $mensagem .= "</ul>";

    ?>

    <script type="text/javascript">
        toastr.error('<?php echo $mensagem ?>', 'Aviso', 
            {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "2000",
                "hideDuration": "2000",
                "timeOut": "6000",
                "extendedTimeOut": "2000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
        );
    </script>
@endif


@if($message = Session::get('success'))
    <script type="text/javascript">
        toastr.success('<?php echo $message; ?>', 'Aviso', 
            {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "2000",
                "hideDuration": "2000",
                "timeOut": "6000",
                "extendedTimeOut": "2000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
        )
    </script>
    <?php Session::forget('success'); ?>
@endif 

@if($message = Session::get('error'))
    <script type="text/javascript">
        toastr.error('<?php echo $message; ?>', 'Erro !!!', 
            {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "10",
                "hideDuration": "2000",
                "timeOut": "7000",
                "extendedTimeOut": "2000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
        )
    </script>
    <?php Session::forget('error'); ?>
@endif 

@if($message = Session::get('info'))
    <script type="text/javascript">
        toastr.info('<?php echo $message; ?>', 'Informação', 
            {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "10",
                "hideDuration": "2000",
                "timeOut": "7000",
                "extendedTimeOut": "2000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
        )
    </script>
    <?php Session::forget('info'); ?>
@endif 

@if($message = Session::get('warning'))
    <script type="text/javascript">
        toastr.warning('<?php echo $message; ?>', 'Alerta', 
            {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "10",
                "hideDuration": "2000",
                "timeOut": "7000",
                "extendedTimeOut": "2000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
        )
    </script>
    <?php Session::forget('warning'); ?>
@endif 