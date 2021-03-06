    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="<?php echo $cfg_baseurl ?>/assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="<?php echo $cfg_baseurl ?>/assets/bootstrap/js/popper.min.js"></script>
    <script src="<?php echo $cfg_baseurl ?>/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo $cfg_baseurl ?>/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="<?php echo $cfg_baseurl ?>/assets/js/app.js"></script>
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="<?php echo $cfg_baseurl ?>/assets/js/custom.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="<?php echo $cfg_baseurl ?>/assets/plugins/apex/apexcharts.min.js"></script>
    <script src="<?php echo $cfg_baseurl ?>/assets/js/dashboard/dash_2.js"></script>
    <script src="<?php echo $cfg_baseurl ?>/assets/js/scrollspyNav.js"></script>
    <script src="<?php echo $cfg_baseurl ?>/assets/plugins/sweetalerts/sweetalert2.min.js"></script>
    <script src="<?php echo $cfg_baseurl ?>/assets/plugins/sweetalerts/custom-sweetalert.js"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="<?php echo $cfg_baseurl ?>/assets/js/scrollspyNav.js"></script>
    <script src="<?php echo $cfg_baseurl ?>/assets/plugins/table/datatable/datatables.js"></script>
    <script>
        $('.widget-content .message').on('click', function () {
          swal({
              title: 'Saved succesfully',
              padding: '2em'
            })
        })

        $('#zero-config').DataTable({
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
               "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 7 
        });

        $('#zero-cart').DataTable({
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
               "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 7 
        });

        
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#total_harga, #uang_bayar").keyup(function() {
                var total_harga  = $("#total_harga").val();
                var total_bayar = $("#uang_bayar").val();

                var total = parseInt(total_bayar) - parseInt(total_harga);
                $("#uang_kembali").val(total);
            });
        });
    </script>
    <!-- END PAGE LEVEL SCRIPTS -->