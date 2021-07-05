<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title><?php echo $cfg_appname; ?></title>
    <link rel="icon" type="image/x-icon" href="<?php echo $cfg_favicon; ?>"/>
    <link href="<?php echo $cfg_baseurl ?>/assets/css/loader.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo $cfg_baseurl ?>/assets/js/loader.js"></script>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="<?php echo $cfg_baseurl ?>/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $cfg_baseurl ?>/assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="<?php echo $cfg_baseurl ?>/assets/plugins/apex/apexcharts.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $cfg_baseurl ?>/assets/css/dashboard/dash_2.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $cfg_baseurl ?>/assets/plugins/table/datatable/datatables.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $cfg_baseurl ?>/assets/plugins/table/datatable/dt-global_style.css">
    <link href="<?php echo $cfg_baseurl ?>/assets/plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $cfg_baseurl ?>/assets/plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $cfg_baseurl ?>/assets/css/components/custom-sweetalert.css" rel="stylesheet" type="text/css" />
    
    <link href="<?php echo $cfg_baseurl ?>/assetsplugins/animate/animate.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo $cfg_baseurl ?>/assetsplugins/sweetalerts/promise-polyfill.js"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo $cfg_baseurl ?>/assets/css/elements/alert.css">
    <link href="<?php echo $cfg_baseurl ?>/assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $cfg_baseurl ?>/assets/css/components/custom-modal.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

</head>
<body class="alt-menu sidebar-noneoverflow">
    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->
    <?php include("layouts/navbar.php") ?>
    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>
        <?php include("layouts/sidebar.php") ?>

        <!--  BEGIN CONTENT PART  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">