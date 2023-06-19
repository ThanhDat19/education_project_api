<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ !empty($title) ? $title : 'Học Tập Trực Tuyến' }}</title>
    <link rel="shortcut icon" href="{{ asset('template/assets/images/logo/favicon.svg') }}" type="image/x-icon" />
    <link rel="shortcut icon" href="{{ asset('template/assets/images/logo/favicon.png') }}" type="image/png" />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="/template/css/styles.css">
    <!-- Main CSS -->
    <link href="/template/admin/dist/css/main.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="/template/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/template/admin/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="/template/front/scripts/bootstrap/bootstrap.min.css">
    <!-- IonIcons -->
    <link rel="stylesheet" href="/template/front/scripts/ionicons/css/ionicons.min.css">
    <!-- Toast -->
    <link rel="stylesheet" href="/template/front/scripts/toast/jquery.toast.min.css">
    <!-- OwlCarousel -->
    {{-- <link rel="stylesheet" href="/template/front/scripts/owlcarousel/dist/assets/owl.carousel.min.css"> --}}
    {{-- <link rel="stylesheet" href="/template/front/scripts/owlcarousel/dist/assets/owl.theme.default.min.css"> --}}
    <!-- Magnific Popup -->
    {{-- <link rel="stylesheet" href="/template/front/scripts/magnific-popup/dist/magnific-popup.css"> --}}
    <link rel="stylesheet" href="/template/front/scripts/sweetalert/dist/sweetalert.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="/template/front/scripts/icheck/skins/all.css">
    <!-- Custom style -->
    <link rel="stylesheet" href="/template/front/css/style.css">
    <link rel="stylesheet" href="/template/front/css/skins/all.css">
    <link rel="stylesheet" href="/template/front/css/demo.css">


    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,400;0,500;0,600;1,400;1,500&family=Roboto:ital,wght@0,400;0,700;0,900;1,400;1,700;1,900&display=swap');
        * {
            font-family: 'Roboto', sans-serif !important;
        }

        h1 {
            font-family: 'Roboto', sans-serif;
        }

        .dataTables_length {
            display: none;
        }
    </style>
    @yield('head')
</head>
