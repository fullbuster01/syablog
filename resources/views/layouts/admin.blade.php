<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Syablog Admin</title>

{{-- style --}}
@include('includes.admin.style')
@stack('add-on-style')
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            {{-- navbar --}}
            @include('includes.admin.navbar')

            @include('includes.admin.sidebar')
            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        @yield('title')
                    </div>

                    <div class="section-body">
                        {{-- @include('includes.admin.alert') --}}
                        @yield('content')
                    </div>
                </section>
            </div>

            {{-- footer --}}
            @include('includes.admin.footer')
        </div>
    </div>

{{-- script --}}
@include('includes.admin.script')
@stack('add-on-script')
</body>

</html>