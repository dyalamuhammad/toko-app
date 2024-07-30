<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Toko App | {{ $title }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="{{ asset('bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <script type="text/javascript" src="//code.jquery.com/jquery-3.6.0.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">

</head>

<body data-bs-theme="dark">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('image/store.png') }}" alt="Bootstrap" height="48">
                {{-- <h3 class="d-inline align-middle">Toko Dyala</h3> --}}
            </a>
            <div class="d-flex gap-3 navbar-nav">

                <a class="nav-link {{ request()->is('barang-masuk') ? 'active' : '' }}"
                    href="{{ route('barang-masuk') }}">Barang Masuk</a>
                <a class="nav-link {{ request()->is('barang-keluar') ? 'active' : '' }}"
                    href="{{ route('barang-keluar') }}">Barang Keluar</a>
                <a class="nav-link {{ request()->is('report-stock') ? 'active' : '' }}"
                    href="{{ route('report-stock') }}">Report Stock</a>
            </div>
            <div class="d-flex align-items-center">
                <i class="bi bi-sun my-auto pt-1 me-5"></i>
                <div class="form-check form-switch ms-3 px-0 pt-0">
                    <input class="form-check-input fs-5" type="checkbox" role="switch" id="flexSwitchCheckChecked"
                        onclick="myFunction()" />
                </div>
                <i class="bi bi-moon pt-1"></i>
            </div>

        </div>
    </nav>
    <div class="container">
        <div class="row">
            @yield('content')
        </div>
    </div>
    @yield('script')
    <script>
        // Fungsi untuk mengubah tema
        function myFunction() {
            var element = document.body;
            var currentTheme = element.dataset.bsTheme;
            var newTheme = currentTheme == "light" ? "dark" : "light";
            element.dataset.bsTheme = newTheme;
            localStorage.setItem('theme', newTheme); // Simpan tema di localStorage

            // Simpan status switch di localStorage
            var switchStatus = document.getElementById('flexSwitchCheckChecked').checked;
            localStorage.setItem('switchStatus', switchStatus);
        }

        // Fungsi untuk memuat tema dan status switch dari localStorage saat halaman dimuat
        function loadTheme() {
            var savedTheme = localStorage.getItem('theme');
            if (savedTheme) {
                document.body.dataset.bsTheme = savedTheme;
            }

            // Muat status switch dari localStorage
            var savedSwitchStatus = localStorage.getItem('switchStatus') === 'true';
            document.getElementById('flexSwitchCheckChecked').checked = savedSwitchStatus;
        }

        // Panggil fungsi loadTheme saat halaman dimuat
        window.onload = loadTheme;
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
</body>

</html>
