@extends('layouts.main')
@section('script')
    <script>
        function doDelete(id) {
            if (confirm('Yakin Hapus?')) {
                location.href = `barang-keluar/${id}`;
            }
        }
    </script>
    <script>
        document.getElementById('dateInput').addEventListener('change', function() {
            let selectedDate = this.value;
            updateUrl(selectedDate);
        });

        function clearFilter() {
            updateUrl('');
        }

        function updateUrl(date) {
            let url = new URL(window.location.href);
            url.searchParams.set('filter', date);
            window.location.href = url.href;
        }
    </script>
@endsection
@section('content')
    @include('alert')
    @if ($barang->count() > 0)
        <div class="my-3">
            <h1>Barang Keluar</h1>
            <form action="{{ route('out-barang') }}" method="post" class="row">
                @csrf
                <div class="form-group mb-3 col-6">
                    <label class="mb-2" for="nama">Nama Barang</label>
                    <select class="form-control" style="width: 100%;" name="id_barang" required>
                        <option value="" selected>Pilih Barang</option>
                        @foreach ($barang as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3 col-6">
                    <label class="mb-2" for="stock">Jumlah Barang Keluar</label>
                    <input type="number" class="form-control" placeholder="Barang Keluar" name="jumlah">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>

            <div class="row justify-content-end">
                <div class="col-auto">
                    <div class="input-group col-2">
                        <input type="date" value="{{ $filter }}" id="dateInput" class="form-control col-2">
                        <button onclick="clearFilter()" type="button" class="btn btn-outline-danger p-0 px-2"><i
                                class="bi bi-x fs-3 align-middle p-0 m-0"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table">
                <tr class="table-primary">
                    <th class="th-first">No</th>
                    <th>Nama Barang</th>
                    <th>Jumlah Keluar</th>
                    <th>Jam Keluar</th>
                    <th>Tanggal Keluar</th>
                    <th class="col-1 text-center th-last">Action</th>
                </tr>
                @foreach ($barangKeluar as $item)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">
                            @php
                                $namaBarang = \App\Models\Barang::where('id', $item->id_barang)->value('nama');
                                echo $namaBarang;
                            @endphp
                        </td>
                        <td class="align-middle">{{ $item->jumlah }}</td>
                        <td class="align-middle">
                            {{ \Carbon\Carbon::parse($item->updated_at)->Format('H:i:s') }}
                        </td>
                        <td class="align-middle">
                            {{ \Carbon\Carbon::parse($item->updated_at)->locale('id_ID')->isoFormat('dddd, D MMMM YYYY') }}
                        </td>
                        <td class="text-center">
                            <button class="btn btn-danger btn-sm" type="button"
                                onclick="doDelete({{ $item->id }})">Hapus</button>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    @else
        <div class="mt-5 text-center">
            <img src="{{ asset('image/no-result.png') }}" alt="" width="200px">
            <h5>Barang Masih Kosong...</h5>
            <p>Tambahkan terlebih dahulu barang sesuai dengan kebutuhanmu</p>
            <a href="{{ route('barang-masuk') }}"
                class="link-underline link-underline-opacity-0 link-underline-opacity-75-hover">Tambah
                Barang</a>

        </div>
    @endif
@endsection
