<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="dashboard/assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="dashboard/assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.css" />
    <link rel="stylesheet" href="dashboard/assets/plugins/charts-c3/plugin.css" />

    <link rel="stylesheet" href="dashboard/assets/plugins/morrisjs/morris.min.css" />
    <link rel="stylesheet" href="dashboard/assets/css/style.min.css">
    <style>
        li.menu-child.active a{
            color: #e47297 !important;
        }
        .cursor-pointer{
            cursor: pointer;
        }
    </style>
    <title>Multitenancy</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div id="app"></div>
    @vite('resources/js/app.js')
</body>

</html>


<script src="dashboard/assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js ( jquery.v3.2.1, Bootstrap4 js) --> 
<script src="dashboard/assets/bundles/vendorscripts.bundle.js"></script> <!-- slimscroll, waves Scripts Plugin Js -->

<script src="dashboard/assets/bundles/jvectormap.bundle.js"></script> <!-- JVectorMap Plugin Js -->
<script src="dashboard/assets/bundles/sparkline.bundle.js"></script> <!-- Sparkline Plugin Js -->
<script src="dashboard/assets/bundles/c3.bundle.js"></script>

<script src="dashboard/assets/bundles/mainscripts.bundle.js"></script>
<script src="dashboard/assets/js/pages/index.js"></script>
<script>
    window.baseUrl = "{{url('/')}}";
</script>