<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ICTS FMIS</title>

    <link rel="stylesheet" href="{{asset('assets/bs/css/bootstrap.css')}}">
    <script src="{{asset('assets/bs/js/bootstrap.bundle.js')}}"></script>
    <link rel="stylesheet" href="{{asset('assets/bs icon/font/bootstrap-icons.css')}}">
    <script src="{{asset('assets/sweetalert2/dist/sweetalert2.js')}}"></script>
    <link rel="stylesheet" href="{{asset('assets/sweetalert2/dist/sweetalert2.css')}}">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <style>
        .bg-primary{
            background-color: #1A8BCB !important;
        }
        .text-link-primary{
            color: white !important;
        }
        .text-primary{
            color: #1A8BCB !important;
        }
    </style>
</head>

<body class="bg-light p-3">
    <script>
        @if (session('success'))
            Swal.fire({
                title: "Good job!",
                text: "{{session('success')}}",
                icon: "success"
            });
        @endif

        @if ($errors->any())
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "{{$errors->first()}}",
                footer: ''
            });
        @endif
    </script>

    @guest
    @yield('guest')
    @endguest

    @auth
    <div class="d-flex p-0">
        @include('components.aside')
        <div class="d-flex flex-column w-100 p-0" style="gap: 0;">
            @include('components.header')
            <main class="w-100">
                @yield('auth')
            </main>
        </div>
    </div>


    @endauth

    <script>
        document.addEventListener('DOMContentLoaded', ()=>{
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
        });
    </script>
</body>

</html>