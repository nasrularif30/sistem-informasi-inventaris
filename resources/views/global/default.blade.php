<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Turus Asri - @yield('title')</title></title>
    <!-- CSS files -->
    <link href="{!! asset('theme/dist/css/tabler.css?1674944402') !!}" rel="stylesheet"/>
    <link href="{!! asset('theme/dist/css/tabler.min.css?1674944402') !!}" rel="stylesheet"/>
    <link href="{!! asset('theme/dist/css/tabler-flags.min.css?1674944402') !!}" rel="stylesheet"/>
    <link href="{!! asset('theme/dist/css/tabler-payments.min.css?1674944402') !!}" rel="stylesheet"/>
    <link href="{!! asset('theme/dist/css/tabler-vendors.min.css?1674944402') !!}" rel="stylesheet"/>
    <link href="{!! asset('theme/dist/css/demo.min.css?1674944402') !!}" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css"> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-bs5/1.13.4/dataTables.bootstrap5.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-bs5/1.13.4/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-bs5/1.13.4/dataTables.bootstrap5.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-bs5/1.13.4/dataTables.bootstrap5.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    @include('sweetalert::alert')
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.all.min.js"></script>
    <style>
      @import url('https://rsms.me/inter/inter.css');
      :root {
      	--tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
      body {
      	font-feature-settings: "cv03", "cv04", "cv11";
      }
    </style>
  </head>
  <body >
    <script src="{!! asset('theme/dist/js/demo-theme.min.js?1674944402') !!}"></script>
    <div class="page">
        @section('header')
          @parent
          @yield('header')
        @endsection

        @section('navbar')
          @parent
          @yield('navbar')
        @endsection
        
        <div class="page-wrapper">
            @yield('content')
            @include('global.footer')
            @show
        </div>
        @yield('modal')
    </div>
    <!-- Libs JS -->
    <script src="{!! asset('theme/dist/libs/apexcharts/dist/apexcharts.min.js?1674944402') !!}" defer></script>
    <script src="{!! asset('theme/dist/libs/jsvectormap/dist/js/jsvectormap.min.js?1674944402') !!}" defer></script>
    <script src="{!! asset('theme/dist/libs/jsvectormap/dist/maps/world.js?1674944402') !!}" defer></script>
    <script src="{!! asset('theme/dist/libs/jsvectormap/dist/maps/world-merc.js?1674944402') !!}" defer></script>
    <!-- Tabler Core -->
    <script src="{!! asset('theme/dist/js/tabler.min.js?1674944402') !!}" defer></script>
    <script src="{!! asset('theme/dist/js/demo.min.js?1674944402') !!}" defer></script>
    <!-- datatable -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script> -->
    @yield('script')
    </body>
</html>