<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.header')
    <style>


        .dataTables_length label {
            margin: 10px 10px;
        }

        .previous,
        .next,
        .current,
        .dataTables_info {
            display: none;
        }

        .dataTables_length label select {
            border-radius: 5px !important;
            padding: 0 5px;
            margin: 0 4px;
        }

        .dataTables_filter {
            float: right;
        }

        .dataTables_filter label input {
            margin-right: 58px !important;
            border-radius: 5px !important;
            margin-left: 8px;
        }

        .dataTables_length {
            display: none;
        }
    </style>
</head>

<body>
    {{-- <script src="{{ asset('template/assets/js/initTheme.js') }}"></script> --}}
    <div id="app">
        @include('admin.partials.side')
        <div id="main">
            @include('admin.alert')
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <h3>{{ $title }}</h3>
                @yield('contents')
            </div>
        </div>
    </div>
    @include('admin.footer');

</body>

</html>
