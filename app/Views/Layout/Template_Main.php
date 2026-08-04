<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?> | Cycle Time</title>

    <!-- Google Font: Source Sans Pro -->
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="http://localhost/cycletime/assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="http://localhost/cycletime/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <!-- <link rel="stylesheet" href="http://localhost/cycletime/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css"> -->
    <!-- JQVMap -->
    <link rel="stylesheet" href="http://localhost/cycletime/assets/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="http://localhost/cycletime/assets/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <!-- <link rel="stylesheet" href="http://localhost/cycletime/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css"> -->
    <!-- Daterange picker -->
    <link rel="stylesheet" href="http://localhost/cycletime/assets/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="http://localhost/cycletime/assets/plugins/summernote/summernote-bs4.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="http://localhost/cycletime/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="http://localhost/cycletime/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="http://localhost/cycletime/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="http://localhost/cycletime/assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="http://localhost/cycletime/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="http://localhost/cycletime/assets/plugins/daterangepicker/daterangepicker.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="http://localhost/cycletime/assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="http://localhost/cycletime/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="http://localhost/cycletime/assets/plugins/daterangepicker/daterangepicker.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="http://localhost/cycletime/assets/plugins/daterangepicker/daterangepicker.css">
    <!-- <link rel="stylesheet" href="http://localhost/cycletime/assets/css/styles.css"> -->
    <!-- jQuery -->
    <!-- <script src="http://localhost/cycletime/assets/plugins/jquery/jquery.min.js"></script> -->
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <h5 class="nav-link text-dark"><?= $title ?></h5>
                </li>
                <!-- <li class="nav-item d-none d-sm-inline-block">
                    <a href="http://localhost/cycletimeindex3.html" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="http://localhost/cycletime#" class="nav-link">Contact</a>
                </li> -->
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Store -->
                <li class="nav-item d-none d-sm-inline-block">
                    <h6 class="nav-link text-dark text-bold">A</h6>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-olive elevation-1">
            <!-- Brand Logo -->
            <a href="http://localhost/cycletime/" class="brand-link bg-light">
                <img src="http://localhost/cycletime/assets/dist/img/AdminLTELogo.png" alt="Logo" class="brand-image img-circle elevation-1" style="opacity: 1">
                <span class="brand-text font-weight-light">Cycletime Report</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <!-- <div class="image">
                        <img src="/uploads/img_user/<?= session('img_user') ?>" class="img-circle border" alt="User Image">
                    </div> -->
                    <div class="info">
                        <a href="http://localhost/cycletime#" class="d-block"><?= session('name_user') ?></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-flat" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="http://localhost/cycletime/" class="nav-link <?= $menu == 'Dashboard' ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="http://localhost/cycletime/stocksilo/index" class="nav-link <?= $menu == 'StockSilo' ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-truck-loading"></i>
                                <p>
                                    Stock Silo
                                </p>
                            </a>
                        </li>
                        <li class="nav-item <?= $menuGroup == 'ReportProduksi' ? 'menu-open' : '' ?>">
                            <a href="http://localhost/cycletime#" class="nav-link <?= $menuGroup == 'ReportProduksi' ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-box-open"></i>
                                <p>
                                    Report Produksi
                                    <i class="fas fa-angle-left right"></i>
                                    <!-- <span class="badge badge-info right">6</span> -->
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="http://localhost/cycletime/reportcycletime" class="nav-link <?= $menu == 'ReportCycletime' ? 'active' : '' ?>">
                                        <i class="fas fa-sync nav-icon"></i>
                                        <p>Cycle Time</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="http://localhost/cycletime/report" class="nav-link <?= $menu == 'Report' ? 'active' : '' ?>">
                                        <i class="fas fa-file-pdf nav-icon"></i>
                                        <p>Report</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="http://localhost/cycletime/reportbyhour" class="nav-link <?= $menu == 'ReportByHour' ? 'active' : '' ?>">
                                        <i class="fas fa-clock nav-icon"></i>
                                        <p>Batch By Hour</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <?= $this->renderSection('content') ?>

        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2025 <a href="http://localhost/cycletimehttps://miraswift.com" target="_blank">Miraswift Auto Solusi</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->


    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="http://localhost/cycletime/assets/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="http://localhost/cycletime/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="http://localhost/cycletime/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <!-- <script src="http://localhost/cycletime/assets/plugins/chart.js/Chart.min.js"></script> -->
    <!-- Sparkline -->
    <!-- <script src="http://localhost/cycletime/assets/plugins/sparklines/sparkline.js"></script> -->
    <!-- JQVMap -->
    <script src="http://localhost/cycletime/assets/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="http://localhost/cycletime/assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <!-- <script src="http://localhost/cycletime/assets/plugins/jquery-knob/jquery.knob.min.js"></script> -->
    <!-- daterangepicker -->
    <script src="http://localhost/cycletime/assets/plugins/moment/moment.min.js"></script>
    <script src="http://localhost/cycletime/assets/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="http://localhost/cycletime/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="http://localhost/cycletime/assets/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <!-- <script src="http://localhost/cycletime/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script> -->
    <!-- AdminLTE App -->
    <script src="http://localhost/cycletime/assets/dist/js/adminlte.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="http://localhost/cycletime/assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="http://localhost/cycletime/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="http://localhost/cycletime/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="http://localhost/cycletime/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="http://localhost/cycletime/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="http://localhost/cycletime/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="http://localhost/cycletime/assets/plugins/jszip/jszip.min.js"></script>
    <script src="http://localhost/cycletime/assets/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="http://localhost/cycletime/assets/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="http://localhost/cycletime/assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="http://localhost/cycletime/assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="http://localhost/cycletime/assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- Select2 -->
    <script src="http://localhost/cycletime/assets/plugins/select2/js/select2.full.min.js"></script>
    <!-- InputMask -->
    <!-- <script src="http://localhost/cycletime/assets/plugins/moment/moment.min.js"></script>
    <script src="http://localhost/cycletime/assets/plugins/inputmask/jquery.inputmask.min.js"></script> -->
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="http://localhost/cycletime/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- date-range-picker -->
    <script src="http://localhost/cycletime/assets/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Custom Script -->
    <script>
        // Daterange
        //Date range picker
        $('.daterange').daterangepicker()
        $('.timerange').daterangepicker({
            timePicker: true,
            timePicker24Hour: true,
            timePickerIncrement: 1,
            locale: {
                format: 'HH:mm'
            }
        }).on('show.daterangepicker', function(ev, picker) {
            picker.container.find(".calendar-table").hide();
        })
        // Input Mask
        //time dd/mm/yyyy
        // $('.timerange').inputmask('HH:MM', {
        //     'placeholder': 'hh:mm'
        // })
        $('[data-mask]').inputmask()
        // Input Mask
        //time dd/mm/yyyy
        // $('#datetime').inputmask('HH:MM', {
        //     'placeholder': 'hh:mm'
        // })
        $('[data-mask]').inputmask()
        // DataTable
        $("#table-button").DataTable({
            "lengthMenu": [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": [{
                extend: 'pdf',
                footer: true
            }, {
                extend: 'excel',
                footer: true
            }],
            "paging": true,
            "searching": true,
        }).buttons().container().appendTo('#tabel-button_wrapper .col-md-6:eq(0)');
        // Tabel non cetak
        $('#table-global').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": false,
        });
        // Tabel print new
        $("#table-print").DataTable({
            "lengthMenu": [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            "paging": true,
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            'footer': true,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#table-print_wrapper .col-md-6:eq(0)');
        // Select2
        // With Clear
        $('.select2bs4-clear').select2({
            theme: 'bootstrap4',
            placeholder: 'Pilih opsi',
            allowClear: true,
            // containerCssClass: 'rounded-0',
            // selectionCssClass: 'rounded-0'
        });
        $('.select2bs4-clear').one('select2:open', function(e) {
            $('input.select2-search__field').prop('placeholder', 'Cari...');
        });
        // No Clear
        $('.select2bs4').select2({
            theme: 'bootstrap4',
            placeholder: 'Pilih opsi',
            allowClear: false,
            // containerCssClass: 'rounded-0',
            // selectionCssClass: 'rounded-0'
        });
        $('.select2bs4').one('select2:open', function(e) {
            $('input.select2-search__field').prop('placeholder', 'Cari...');
        });
        // Tooltip
        $('#tooltip_username_user').tooltip({
            boundary: 'window'
        })
        $('#tooltip_password_user').tooltip({
            boundary: 'window'
        })

        // Modal
        window.onload = function() {
            // Modal Open
            let MODAL_OPEN = "<?= session('modalOpen') ?>";

            if (MODAL_OPEN) {
                $('#' + MODAL_OPEN).modal('show');
            }

            // Toast
            let FLASHDATA_SUCCESS = "<?= session()->getFlashdata('success') ?>"
            let FLASHDATA_FAILED = "<?= session()->getFlashdata('failed') ?>"

            if (FLASHDATA_SUCCESS) {
                $(document).Toasts('create', {
                    class: 'bg-success m-3',
                    title: 'Success',
                    autohide: true,
                    delay: 5000,
                    body: FLASHDATA_SUCCESS,
                    icon: 'fas fa-check-circle fa-lg',
                })
            } else if (FLASHDATA_FAILED) {
                $(document).Toasts('create', {
                    class: 'bg-danger m-3',
                    title: 'Failed',
                    autohide: true,
                    delay: 5000,
                    body: FLASHDATA_FAILED,
                    icon: 'fas fa-exclamation-triangle fa-lg',
                })
            }
        }
    </script>
</body>

</html>