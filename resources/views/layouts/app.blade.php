<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
  
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-gray-800 text-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    {{-- javascript --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    @stack('javascript')
    @if (session('success-alert'))
        <script>
            Swal.fire({
                icon: "success",
                title: "{{ session('success-alert') }}",
                text: "{{ session('alert-message') }}",
            });
        </script>
    @endif
    @if (session('error-alert'))
        <script>
            Swal.fire({
                icon: "error",
                title: "{{ session('error-alert') }}",
                text: "{{ session('alert-message') }}",
            });
        </script>
    @endif
    {{-- logout confirmation --}}
    <script>
        function logoutConfirmation(event) {
            event.preventDefault()

            let form = document.getElementById('logoutForm')

            Swal.fire({
                title: "Are you sure?",
                text: "You can login again next time!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, log out!"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit()
                }
            })
        }
    </script>
</body>

</html>
