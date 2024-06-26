<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @php
    $meta = App\Models\SystemInfo::pluck('meta_value', 'meta_field')->toArray();
    @endphp
    @if (!empty($meta['logo']))
    <link rel="icon" type="image/x-icon" href="{{ Storage::url($meta['logo']) }}" />
    @else
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/logo.png') }}" />
    @endif
    <title>
        @if (!empty($meta['name']))
        {{ $meta['name'] }}
        @else
        Pet Shop Food and Accessories Shop
        @endif
    </title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Main CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">

    {{-- Boostrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>

<body>
    @include('partials.navbar')

    @yield('main-content')

    @include('partials.footer')

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    {{-- Main JS --}}
    <script src="{{ asset('assets/js/script.js') }}"></script>
</body>

</html>
