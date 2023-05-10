
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title> @yield('title') | e-commerce</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="{{ asset('backend') }}/assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{ asset('backend') }}/assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="{{ asset('backend') }}/assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />

    {{-- dataTAbles --}}
    <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css" rel="stylesheet">

    <!-- PLUGINS STYLES-->
    <link href="{{ asset('backend') }}/assets/vendors/jvectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="{{ asset('backend') }}/assets/css/main.min.css" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->

    @stack('styles')
    <style>
        .toggle-switch {
            position: relative;
            width: 100px;
        }

        .switch-label {
            position: absolute;
            width: 90%;
            height: 30px;
            background-color: red;
            border-radius: 50px;
            cursor: pointer;
        }

        .switch-label input {
            position: absolute;
            display: none;
        }

        .switch_slider {
            position: absolute;
            width: 83%;
            height: 100%;
            border-radius: 50px;
            color:white;
            transition: 0.3s;
            padding: 2px 0 0 9px;
        }

        .switch-label input:checked ~ .switch_slider {
            background-color: green;
        }

        .switch_slider::before {
            content: "";
            position: absolute;
            top: 1px;
            left: 3px;
            width: 30px;
            height: 28px;
            border-radius: 50%;
            box-shadow: inset 0px 0px 0px 0px #d8dbe0;
            background-color: #f9f8f8;
            transition: 0.8s;
        }

        .switch-label input:checked ~ .switch_slider::before {
            transform: translateX(50px);
            background-color: 28292c;
            box-shadow: none;
        }



        /* breadcrumb */
        .breadcrumb-nav li{
            display:inline-block;
        }
        .breadcrumb-nav li:first-child::before{
            padding: 0;
            content: '';
        }
        .breadcrumb-nav li::before{
            padding-right: .5rem;
            padding-left: .5rem;
            color: #868e96;
            content: "/";
        }
        .breadcrumb-nav li.active a{
            color: #23b7e5;

        }

        .table th{
            font-weight: 600 !important;
        }
        .table th:first-child,
        .table tr td:first-child{
            text-align: left;
            padding-left: 15px;
        }
        .table th:last-child,
        .table tr td:last-child{
            text-align: right;
            padding-right: 15px;
        }
        .pr-15{
            padding-right: 15px;
        }
        .dataTables_length,
        .dataTables_info{
            padding-left: 15px
        }
        /* btn style */
        .action-btn .btn-style{
            margin-left: 4px;
        }

        .btn-style {
            text-align: center;
            width: 15px;
            height: 15px;
            line-height: 15px;
            cursor: pointer;
            border: 0;
            border-radius: 50%;
            font-size: 12px;
            display: inline-block;
            padding: 5px;
            transition: .5s ease-in-out;
        }

        .btn-style-danger{
            background: rgba(239,72,106,.15);
            color: #ff5370;
        }
        .btn-style-danger:hover {
            background: #ff5370;
            color: #fff;
        }

        .btn-style-edit{
            background: rgba(55,125,255,.15);
            color: #377dff;
        }
        .btn-style-edit:hover {
            background: #377dff;
            color: #fff;
        }

        .btn-style-view{
            background: rgba(23, 162, 184, .15);
            color: #17a2b8;
        }
        .btn-style-view:hover {
            background: #17a2b8;
            color: #fff;
        }

        .btn-style-clone{
            background: rgba(255, 193, 7, .25);
            color: #ffc107;
        }
        .btn-style-clone:hover {
            background: #ffc107;
            color: #fff;
        }

    </style>

</head>

<body class="fixed-navbar">
    <div class="page-wrapper">
        <!-- START HEADER-->
        @include('backend.include.header')
        <!-- END HEADER-->

        <!-- START SIDEBAR-->
        @include('backend.include.sidebar')
        <!-- END SIDEBAR-->



        <div class="content-wrapper">
            <div class="page-content fade-in-up">
                {{-- START BREADCRUMB --}}
                   @include('backend.include.breadcrumb')
                {{-- END BREADCRUMB --}}


                <!-- START PAGE CONTENT-->
                    @yield('content')
                <!-- END PAGE CONTENT-->

                {{-- START FOOTER --}}
                    @include('backend.include.footer')
                {{-- END FOOTER --}}
            </div>
        </div>
    </div>

    <!-- BEGIN THEME CONFIG PANEL-->
    {{-- <div class="theme-config">
        <div class="theme-config-toggle"><i class="fa fa-cog theme-config-show"></i><i class="ti-close theme-config-close"></i></div>
        <div class="theme-config-box">
            <div class="text-center font-18 m-b-20">SETTINGS</div>
            <div class="font-strong">LAYOUT OPTIONS</div>
            <div class="check-list m-b-20 m-t-10">
                <label class="ui-checkbox ui-checkbox-gray">
                    <input id="_fixedNavbar" type="checkbox" checked>
                    <span class="input-span"></span>Fixed navbar</label>
                <label class="ui-checkbox ui-checkbox-gray">
                    <input id="_fixedlayout" type="checkbox">
                    <span class="input-span"></span>Fixed layout</label>
                <label class="ui-checkbox ui-checkbox-gray">
                    <input class="js-sidebar-toggler" type="checkbox">
                    <span class="input-span"></span>Collapse sidebar</label>
            </div>
            <div class="font-strong">LAYOUT STYLE</div>
            <div class="m-t-10">
                <label class="ui-radio ui-radio-gray m-r-10">
                    <input type="radio" name="layout-style" value="" checked="">
                    <span class="input-span"></span>Fluid</label>
                <label class="ui-radio ui-radio-gray">
                    <input type="radio" name="layout-style" value="1">
                    <span class="input-span"></span>Boxed</label>
            </div>
            <div class="m-t-10 m-b-10 font-strong">THEME COLORS</div>
            <div class="d-flex m-b-20">
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Default">
                    <label>
                        <input type="radio" name="setting-theme" value="default" checked="">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-white"></div>
                        <div class="color-small bg-ebony"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Blue">
                    <label>
                        <input type="radio" name="setting-theme" value="blue">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-blue"></div>
                        <div class="color-small bg-ebony"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Green">
                    <label>
                        <input type="radio" name="setting-theme" value="green">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-green"></div>
                        <div class="color-small bg-ebony"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Purple">
                    <label>
                        <input type="radio" name="setting-theme" value="purple">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-purple"></div>
                        <div class="color-small bg-ebony"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Orange">
                    <label>
                        <input type="radio" name="setting-theme" value="orange">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-orange"></div>
                        <div class="color-small bg-ebony"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Pink">
                    <label>
                        <input type="radio" name="setting-theme" value="pink">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-pink"></div>
                        <div class="color-small bg-ebony"></div>
                    </label>
                </div>
            </div>
            <div class="d-flex">
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="White">
                    <label>
                        <input type="radio" name="setting-theme" value="white">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color"></div>
                        <div class="color-small bg-silver-100"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Blue light">
                    <label>
                        <input type="radio" name="setting-theme" value="blue-light">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-blue"></div>
                        <div class="color-small bg-silver-100"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Green light">
                    <label>
                        <input type="radio" name="setting-theme" value="green-light">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-green"></div>
                        <div class="color-small bg-silver-100"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Purple light">
                    <label>
                        <input type="radio" name="setting-theme" value="purple-light">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-purple"></div>
                        <div class="color-small bg-silver-100"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Orange light">
                    <label>
                        <input type="radio" name="setting-theme" value="orange-light">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-orange"></div>
                        <div class="color-small bg-silver-100"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Pink light">
                    <label>
                        <input type="radio" name="setting-theme" value="pink-light">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-pink"></div>
                        <div class="color-small bg-silver-100"></div>
                    </label>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- END THEME CONFIG PANEL-->

    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    <!-- END PAGA BACKDROPS-->

    <!-- CORE PLUGINS-->
    {{-- <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script> --}}
    <script src="{{ asset('backend') }}/assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>

    {{-- =================== Datatables Script ================== --}}
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('backend') }}/assets/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
    <script src="{{ asset('backend') }}/assets/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="{{ asset('backend') }}/assets/vendors/metisMenu/dist/metisMenu.min.js" type="text/javascript"></script>
    <script src="{{ asset('backend') }}/assets/vendors/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- PAGE LEVEL PLUGINS-->
    <script src="{{ asset('backend') }}/assets/vendors/chart.js/dist/Chart.min.js" type="text/javascript"></script>
    <script src="{{ asset('backend') }}/assets/vendors/jvectormap/jquery-jvectormap-2.0.3.min.js" type="text/javascript"></script>
    <script src="{{ asset('backend') }}/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
    <script src="{{ asset('backend') }}/assets/vendors/jvectormap/jquery-jvectormap-us-aea-en.js" type="text/javascript"></script>

    <!-- CORE SCRIPTS-->
    <script src="{{ asset('backend') }}/assets/js/app.min.js" type="text/javascript"></script>
    <!-- PAGE LEVEL SCRIPTS-->

    <script src="{{ asset('backend') }}/assets/js/scripts/dashboard_1_demo.js" type="text/javascript"></script>

    <script>
        var _token = "{{ csrf_token() }}";
    </script>


    @stack('scripts')

    <script>
        var table; // index page er $table ata

        function datetable(row_id,url){
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirm'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: "post",
                        data:{_token:_token,row_id:row_id},
                        success: function (response) {
                            if (response.status =='success') {
                                table.ajax.reload();
                                $('.alert-message').append('<div class="alert alert-success py-2">'+response.message+'</div>')
                            }
                        }
                    });
                }
            })
        }


    </script>
</body>



</html>
