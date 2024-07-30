<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Toko App | {{ $title }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
        rel="stylesheet">
</head>

<body data-bs-theme="dark">
    <div class="container">
        <div class="row align-items-center  justify-content-center gap-3">
            <div class="col-12 text-center my-5">
                <img src="{{ asset('image/store.png') }}" alt="Bootstrap" width="50px">

                <h1 class="fw-bold">Toko Dyala</h1>
            </div>
            <div class="col-auto card text-bg-primary cursor-pointer"
                onclick="window.location.href='{{ route('barang-masuk') }}'">
                <div class="card-body">
                    <div class="text-center">
                        <img src="{{ asset('image/box.png') }}" alt="" class="mx-auto" height="150px">
                        <h4 class="card-title fw-semibold">Barang Masuk</h4>
                    </div>
                    {{-- <p class="card-text">Pengaturan untuk barang masuk</p> --}}
                </div>
            </div>
            <div class="col-auto card text-bg-danger" onclick="window.location.href='{{ route('barang-keluar') }}'">

                <div class="card-body">
                    <div class="text-center">

                        <img src="{{ asset('image/cash.png') }}" alt="" class="mx-auto" height="150px">
                        <h4 class="card-title fw-semibold">Barang Keluar</h4>
                    </div>
                    {{-- <p class="card-text">Pengaturan untuk barang keluar</p> --}}
                </div>
            </div>
            <div class="col-auto card text-bg-success rounded"
                onclick="window.location.href='{{ route('report-stock') }}'">

                <div class="card-body">
                    <div class="text-center">
                        <img src="{{ asset('image/report.png') }}" alt="" class="mx-auto" height="150px">
                        <h4 class="card-title fw-semibold">Report Stock</h4>
                    </div>
                </div>
                {{-- <p class="card-text">Laporan barang yang masuk dan keluar.</p> --}}
            </div>
        </div>
    </div>
    <script>
        function myFunction() {
            var element = document.body;
            element.dataset.bsTheme =
                element.dataset.bsTheme == "light" ? "dark" : "light";
        }
    </script>
</body>

</html>
