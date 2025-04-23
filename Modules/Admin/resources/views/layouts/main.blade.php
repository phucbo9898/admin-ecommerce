<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!-- theme meta -->
    <meta name="theme-name" content="quixlab"/>

    <title>Quixlab - Bootstrap Admin Dashboard Template by Themefisher.com</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('template-admin/images/favicon.png') }}">
    <!-- Pignose Calender -->
    <link href="{{ asset('template-admin/plugins/pg-calendar/css/pignose.calendar.min.css') }}" rel="stylesheet">
    <!-- Chartist -->
    <link rel="stylesheet" href="{{ asset('template-admin/plugins/chartist/css/chartist.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template-admin/plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css') }}">
    <!-- Custom Stylesheet -->
    <link href="{{ asset('template-admin/css/style.css') }}" rel="stylesheet">

</head>

<body>
<div id="preloader">
    <div class="loader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10"/>
        </svg>
    </div>
</div>
<div id="main-wrapper">
    @include('admin::layouts.header')

    @include('admin::layouts.navigation')

    <div class="content-body">
        @yield('main-body')
    </div>

    @include('admin::layouts.footer')
</div>

<script src="{{ asset('template-admin/plugins/common/common.min.js') }}"></script>
<script src="{{ asset('template-admin/js/custom.min.js') }}"></script>
<script src="{{ asset('template-admin/js/settings.js') }}"></script>
<script src="{{ asset('template-admin/js/gleek.js') }}"></script>
<script src="{{ asset('template-admin/js/styleSwitcher.js') }}"></script>

<!-- Chartjs -->
<script src="{{ asset('template-admin/plugins/chart.js/Chart.bundle.min.js') }}"></script>
<!-- Circle progress -->
<script src="{{ asset('template-admin/plugins/circle-progress/circle-progress.min.js') }}"></script>
<!-- Datamap -->
<script src="{{ asset('template-admin/plugins/d3v3/index.js') }}"></script>
<script src="{{ asset('template-admin/plugins/topojson/topojson.min.js') }}"></script>
<script src="{{ asset('template-admin/plugins/datamaps/datamaps.world.min.js') }}"></script>
<!-- Morrisjs -->
<script src="{{ asset('template-admin/plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('template-admin/plugins/morris/morris.min.js') }}"></script>
<!-- Pignose Calender -->
<script src="{{ asset('template-admin/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('template-admin/plugins/pg-calendar/js/pignose.calendar.min.js') }}"></script>
<!-- ChartistJS -->
<script src="{{ asset('template-admin/plugins/chartist/js/chartist.min.js') }}"></script>
<script src="{{ asset('template-admin/plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js') }}"></script>

<script src="{{ asset('template-admin/js/dashboard/dashboard-1.js') }}"></script>

</body>
</html>
