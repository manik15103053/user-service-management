<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Simple Task</title>
    @include('layouts.partial.styles')
    @stack('css')
    <style>
        .category-custom-card {
          transition: transform 0.3s ease;
        }

        .category-custom-card:hover {
          transform: scale(1.05);
        }

        .custom-title:hover {
          color: #0000;
          cursor: pointer;
        }
        a {
            color: rgb(22 41 70);
            text-decoration: none;
        }
        div#navbarNav {
            background: #000;
        }
        .main_navbar li.nav-item a.nav-link {
            font-weight: 500;
            padding: 15px 20px;
            transition: all .5s ease-in-out;
            position: relative;
            color: #ffffffb3;
        }
        .main_navbar li.nav-item a.nav-link::after {
            position: absolute;
            content: '';
            left: 0;
            top: 80%;
            background: #fff;
            width: 0;
            height: 1px;
            transition: all .5s ease-in-out;
            transform-origin: left;
        }
        .main_navbar li.nav-item a.nav-link:hover:after{
            width: 100%;
            transform-origin: right;
        }
        .main_navbar li.nav-item a.nav-link:hover {
            color: #fff;
        }
        .list-group.category_item a {
            background: #f7f7f7 !important;
            color: #000;
            padding: 10px;
            font-weight: 500;
            border: 0;
            transition: all .5s ease-in-out;
            border-bottom: 2px solid #fff;
        }
        .list-group.category_item a:hover{}
        .card-body:hover h5.card-title.custom-title.text-center {
            color: #000;
        }
        .list-group.category_item a.active {
            background: black !important;
            color: #fff;
        }
        .list-group.category_item a:hover {
            background: #000 !important;
            color: #fff;
        }
      </style>
</head>
<body>
    <div class="container">
    <!----Navber----->
        @include('layouts.partial.navber')
    <!----End Navber----->

    <!----Card Item---->
        @yield('main-content')
        <!-----End Blog Post----->
    </div>
    @include('layouts.partial.scripts')

    @if (Session::has('success'))
        <script>
            toastr.options = {
                'progressBar': true,
                'closeButton': true,
                'positionClass': 'toast-bottom-right', // Set position to bottom-right
                'preventDuplicates': true, // Prevent duplicate toasts
            };
            toastr.success("{{ Session::get('success') }}", 'Success!', {
                timeout: 120000
            });
        </script>
    @elseif(Session::has('error'))
        <script>
            toastr.options = {
                'progressBar': true,
                'closeButton': true,
                'positionClass': 'toast-bottom-right',
            }
            toastr.error("{{ Session::get('error') }}");
        </script>
    @endif

    @if ($errors->any())
        <script>
            $(document).ready(function() {
                @foreach ($errors->all() as $error)
                    toastr.options = {
                        'progressBar': true,
                        'closeButton': true,
                        'positionClass': 'toast-bottom-right',
                    }
                    toastr.error('{{ $error }}');
                @endforeach
            });
        </script>
    @endif

    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>

    @stack('js')

</body>
</html>
