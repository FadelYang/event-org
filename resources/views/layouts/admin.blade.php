<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Evenin | Admin Dashboard</title>
    <style>
        .event-description-text {
            white-space: pre-line;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="{{asset('css/tailwind.output.css')}}"/>
    
    {{-- <link rel="stylesheet" href="{{ asset('css/Chart.min.css') }}"/> --}}
</head>
<body>
<div
        class="flex h-screen bg-gray-50 dark:bg-gray-900"
        :class="{ 'overflow-hidden': isSideMenuOpen }"
>
    <!-- Desktop sidebar -->
    @include('includes.desktop-sidebar')

    <!-- Mobile sidebar -->
    @include('includes.mobile-sidebar')

    <div class="flex flex-col flex-1 w-full">
        @include('includes.header')
        <main class="h-full overflow-y-auto">
            @yield('content')
        </main>
    </div>
</div>

<script src="{{ asset("js/alpine.min.js") }}" defer></script>
<script src="{{ asset("js/Chart.min.js") }}" defer></script>
<script src="{{ asset("js/init-alpine.js") }}"></script>
<script src="{{ asset("js/charts-lines.js") }}" defer></script>
<script src="{{ asset("js/charts-pie.js") }}" defer></script>
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
    function logoutConfirmationAdmin(event) {
        event.preventDefault()

        let form = document.getElementById('logout-form')

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