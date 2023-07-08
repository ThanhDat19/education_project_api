<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ $title }}</title>

<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="/template/admin/plugins/fontawesome-free/css/all.min.css">
<!-- icheck bootstrap -->
<link rel="stylesheet" href="/template/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="/template/admin/dist/css/adminlte.min.css">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
{{-- Admin --}}
<link rel="stylesheet" href="{{ asset('template/assets/css/main/app.css') }}" />
<link rel="stylesheet" href="{{ asset('template/assets/css/main/app-dark.css') }}" />
<link rel="shortcut icon" href="{{ asset('template/assets/images/logo/favicon.svg') }}" type="image/x-icon" />
<link rel="shortcut icon" href="{{ asset('template/assets/images/logo/favicon.png') }}" type="image/png" />

<link rel="stylesheet" href="{{ asset('template/assets/css/shared/iconly.css') }}" />
<link rel="stylesheet" href="{{ asset('template/admin/datepicker/css/datepicker.css') }}" />
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<meta name="csrf-token" content="{{ csrf_token() }}">
@yield('head')
