<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'POS Chatbot') }}</title>


    <link rel="stylesheet" type="text/css" href="/template/assets/extra-libs/multicheck/multicheck.css">
    <link href="/template/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="/template/assets/libs/select2/dist/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="/template/assets/libs/jquery-minicolors/jquery.minicolors.css">
    <link rel="stylesheet" type="text/css"
          href="/template/assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" type="text/css" href="/template/assets/libs/quill/dist/quill.snow.css">

    <link rel="icon" type="image/png" sizes="16x16" href="/template/assets/images/favicon.png">
    <!-- Custom CSS -->
    <link href="/template/assets/libs/flot/css/float-chart.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="/template/dist/css/style.min.css" rel="stylesheet">


    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>


    <link href="/css/style.css" rel="stylesheet">

    <!-- Scripts -->
{{--<script src="{{ asset('js/app.js') }}" defer></script>--}}


@stack('preScripts')

<!-- Styles -->
    {{--<link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
</head>
<body>

@stack('preStyles')


<div class="preloader">
    <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
    </div>
</div>

<div id="main-wrapper">

    @if (!isset($hideAll))
        {{--@include('layouts.navbar')--}}


        @include('layouts.sidebar')

        <div class="page-wrapper">

            @yield('mainContent')


            @include('layouts.footer')


        </div>

    @else

        @yield('mainContent')

    @endif

</div>



<script src="{{ mix('js/app.js') }}"></script>

<script src="/template/assets/libs/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="/template/assets/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="/template/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/template/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
<script src="/template/assets/extra-libs/sparkline/sparkline.js"></script>
<!--Wave Effects -->
<script src="/template/dist/js/waves.js"></script>
<!--Menu sidebar -->
<script src="/template/dist/js/sidebarmenu.js"></script>
<!--Custom JavaScript -->
<script src="/template/dist/js/custom.min.js"></script>
<!--This page JavaScript -->
<!-- <script src="/template/dist/js/pages/dashboards/dashboard1.js"></script> -->
<!-- Charts js Files -->
<script src="/template/assets/libs/flot/excanvas.js"></script>
<script src="/template/assets/libs/flot/jquery.flot.js"></script>
<script src="/template/assets/libs/flot/jquery.flot.pie.js"></script>
<script src="/template/assets/libs/flot/jquery.flot.time.js"></script>
<script src="/template/assets/libs/flot/jquery.flot.stack.js"></script>
<script src="/template/assets/libs/flot/jquery.flot.crosshair.js"></script>
<script src="/template/assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
<script src="/template/dist/js/pages/chart/chart-page-init.js"></script>


{{-- Data Table ------------------------------------------------------------------------------------------------------------}}

<script src="/template/assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>
<script src="/template/assets/extra-libs/multicheck/jquery.multicheck.js"></script>
<script src="/template/assets/extra-libs/DataTables/datatables.min.js"></script>
<script>
    /****************************************
     *       Basic Table                   *
     ****************************************/
    $('#zero_config').DataTable();
</script>

{{------------------------------------------------------------------------------------------------------------------------------}}



{{-- Select2 Form -------------------------------------------------------------------------------------------------------------------------}}
<script src="/template/assets/libs/inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
<script src="/template/dist/js/pages/mask/mask.init.js"></script>
<script src="/template/assets/libs/select2/dist/js/select2.full.min.js"></script>
<script src="/template/assets/libs/select2/dist/js/select2.min.js"></script>
<script src="/template/assets/libs/jquery-asColor/dist/jquery-asColor.min.js"></script>
<script src="/template/assets/libs/jquery-asGradient/dist/jquery-asGradient.js"></script>
<script src="/template/assets/libs/jquery-asColorPicker/dist/jquery-asColorPicker.min.js"></script>
<script src="/template/assets/libs/jquery-minicolors/jquery.minicolors.min.js"></script>
<script src="/template/assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="/template/assets/libs/quill/dist/quill.min.js"></script>
<script>
    //***********************************//
    // For select 2
    //***********************************//
    $(".select2").select2();

    /*colorpicker*/
    $('.demo').each(function () {
        //
        // Dear reader, it's actually very easy to initialize MiniColors. For example:
        //
        //  $(selector).minicolors();
        //
        // The way I've done it below is just for the demo, so don't get confused
        // by it. Also, data- attributes aren't supported at this time...they're
        // only used for this demo.
        //
        $(this).minicolors({
            control: $(this).attr('data-control') || 'hue',
            position: $(this).attr('data-position') || 'bottom left',

            change: function (value, opacity) {
                if (!value) return;
                if (opacity) value += ', ' + opacity;
                if (typeof console === 'object') {
                    console.log(value);
                }
            },
            theme: 'bootstrap'
        });

    });
    /*datwpicker*/
    jQuery('.mydatepicker').datepicker();
    jQuery('#datepicker-autoclose').datepicker({
        autoclose: true,
        todayHighlight: true
    });
    var quill = new Quill('#editor', {
        theme: 'snow'
    });

    // console.clear();
</script>


{{------------------------------------------------------------------------------------------------------------------------------}}

@stack('postScripts')

</body>
</html>
