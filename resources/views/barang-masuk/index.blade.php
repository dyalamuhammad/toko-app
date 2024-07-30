@extends('layouts.main')
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#select-barang').select2({
                placeholder: "Pilih Barang",
                allowClear: true,
                width: 'resolve'
            });
        });
    </script>
    <script>
        function doDelete(id) {
            if (confirm('Yakin Hapus?')) {
                location.href = `barang-masuk/${id}`;
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
            <h1>Barang Masuk</h1>
            <div class="col-12 mb-3">
                <button type="button" class="btn btn-primary col-auto py-0" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    <i class="bi bi-plus me-2 fs-4 align-middle p-0"></i>Tambah Barang Baru
                </button>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Barang Baru</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('add-barang') }}" method="post" class="row">
                                    @csrf
                                    <div class="form-group mb-3 col-6">
                                        <label class="mb-2" for="nama">Nama Barang</label>
                                        <input type="text" class="form-control" placeholder="Nama Barang" name="nama">
                                    </div>
                                    <div class="form-group mb-3 col-6">
                                        <label class="mb-2" for="harga_modal">Harga Modal</label>
                                        <textarea type="number" class="form-control" id="harga" placeholder="Harga Modal" name="harga_modal"
                                            rows="1"></textarea>
                                    </div>
                                    <div class="form-group mb-3 col-6">
                                        <label class="mb-2" for="harga_jual">Harga Jual</label>
                                        <textarea type="number" class="form-control" id="harga" placeholder="Harga Jual" name="harga_jual" rows="1"></textarea>
                                    </div>
                                    <div class="form-group mb-3 col-6">
                                        <label class="mb-2" for="stock">Jumlah Stock</label>
                                        <textarea type="number" class="form-control" placeholder="Stock Barang" name="stock" rows="1">0</textarea>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Submit </button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <form action="{{ route('in-barang') }}" method="post" class="row">
                @csrf
                <div class="form-group mb-3 col-6">
                    <label class="mb-2" for="nama">Nama Barang Masuk</label>
                    <select class="form-control text-capitalize" name="id_barang" required>
                        <option value="" selected>Pilih Barang</option>
                        @foreach ($barang as $item)
                            <option value="{{ $item->id }}" class="py-3 text-capitalize">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3 col-6">
                    <label class="mb-2" for="stock">Jumlah Barang Masuk</label>
                    <input type="number" class="form-control" placeholder="Barang Masuk" name="jumlah">
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
                <thead>
                    <tr class="table-primary">
                        <th class="th-first">No</th>
                        <th>Nama Barang</th>
                        <th>Jumlah Masuk</th>
                        <th>Jam Masuk</th>
                        <th class="">Tanggal Masuk</th>
                        <th class="col-1 text-center th-last">Action</th>
                    </tr>
                </thead>
                @foreach ($barangMasuk as $item)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle" class="text-capitalize">
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
            <button type="button" class="btn btn-primary col-auto py-0" data-bs-toggle="modal"
                data-bs-target="#exampleModal">
                <i class="bi bi-plus me-2 fs-4 align-middle p-0"></i>Tambah Barang Baru
            </button>
            <!-- Modal -->
            <div class="modal fade text-start" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Barang Baru</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('add-barang') }}" method="post" class="row">
                                @csrf
                                <div class="form-group mb-3 col-6 ">
                                    <label class="mb-2 " for="nama">Nama Barang</label>
                                    <input type="text" class="form-control" placeholder="Nama Barang" name="nama">
                                </div>
                                <div class="form-group mb-3 col-6">
                                    <label class="mb-2" for="harga_modal">Harga Modal</label>
                                    <textarea type="number" class="form-control" id="harga" placeholder="Harga Modal" name="harga_modal"
                                        rows="1"></textarea>
                                </div>
                                <div class="form-group mb-3 col-6">
                                    <label class="mb-2" for="harga_jual">Harga Jual</label>
                                    <textarea type="number" class="form-control" id="harga" placeholder="Harga Jual" name="harga_jual"
                                        rows="1"></textarea>
                                </div>
                                <div class="form-group mb-3 col-6">
                                    <label class="mb-2" for="stock">Jumlah Stock</label>
                                    <textarea type="number" class="form-control" placeholder="Stock Barang" name="stock" rows="1">0</textarea>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Submit </button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
