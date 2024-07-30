@extends('layouts.main')
@section('script')
    <script>
        $(document).ready(function() {
            $('#pindahCircleModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var id = button.data('id') // Extract info from data-* attributes
                var nama = button.data('nama');
                var harga_modal = button.data('modal');
                var jual = button.data('jual');
                var modal = $(this)
                modal.find('#id').val(id) // Set the value of the input hidden
                modal.find('#nama').val(nama) // Set the value of the input hidden
                modal.find('#harga_modal').val(harga_modal);
                modal.find('#jual').val(jual);
            })
        });
    </script>
@endsection
@section('content')
    @include('alert')
    @if ($barang->count() > 0)
        <div class="my-3">
            <div class="col-12 d-flex justify-content-between">
                <h1>Report Stock</h1>

            </div>

            <div class="table-responsive">

                <table class="table">
                    <tr class="table-primary">
                        <th class="th-first">No</th>
                        <th>Nama Barang</th>
                        <th>Harga Modal</th>
                        <th>Harga Jual</th>
                        <th>Jumlah Masuk</th>
                        <th>Jumlah Keluar</th>
                        <th>Stock</th>
                        <th>Total Keuntungan</th>
                        <th class="th-last text-center col-1">Action</th>
                    </tr>
                    @foreach ($barang as $item)
                        <tr>

                            <td>{{ $loop->iteration }}</td>
                            <td class="text-capitalize">{{ $item->nama }}</td>
                            <td>{{ 'Rp ' . number_format($item->harga_modal, 0, '.', '.') }}</td>
                            <td>{{ 'Rp ' . number_format($item->harga_jual, 0, '.', '.') }}</td>
                            <td>
                                @php
                                    $jumlahMasuk = App\Models\BarangMasuk::where('id_barang', $item->id)->sum('jumlah');
                                    echo $jumlahMasuk;
                                @endphp
                            </td>
                            <td>
                                @php
                                    $jumlahKeluar = App\Models\BarangKeluar::where('id_barang', $item->id)->sum(
                                        'jumlah',
                                    );
                                    echo $jumlahKeluar;
                                @endphp
                            </td>
                            <td>{{ $item->stock }}</td>
                            <td>
                                @php

                                    $untung = $item->harga_jual - $item->harga_modal;
                                    $total_untung = $jumlahKeluar * $untung;
                                    echo 'Rp ' . number_format($total_untung, 0, ',', '.');
                                @endphp
                            </td>
                            <td class="col-1 text-center"> <button class="btn btn-success btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#pindahCircleModal" data-id="{{ $item->id }}"
                                    data-nama="{{ $item->nama }}" data-modal="{{ $item->harga_modal }}"
                                    data-jual="{{ $item->harga_jual }}">
                                    Ubah
                                </button>
                                <!-- Modal -->
                                <div class="modal fade text-start" id="pindahCircleModal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Barang
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>

                                            </div>
                                            <form method="POST" action="{{ route('edit-barang', ['id' => $item->id]) }}">
                                                @csrf

                                                <div class="modal-body row">
                                                    <input type="hidden" class="form-control mb-2" name="id"
                                                        id="id" readonly>
                                                    <div class="form-group col-12">
                                                        <label for="">Nama Barang</label>
                                                        <input type="text" class="form-control mb-2" name="nama"
                                                            id="nama">
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label for="">Harga Modal</label>
                                                        <input type="text" inputmode="numeric" class="form-control mb-2"
                                                            name="harga_modal" id="harga_modal">
                                                    </div>
                                                    <div class="col-6 form-group">
                                                        <label for="">Harga Jual</label>
                                                        <input type="text" inputmode="numeric" class="form-control mb-2"
                                                            name="harga_jual" id="jual">
                                                    </div>


                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Save
                                                        changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    @else
        <div class="mt-5 text-center">
            <img src="{{ asset('image/no-result.png') }}" alt="" width="200px">
            <h5>Barang Masih Kosong...</h5>
            <p>Tambahkan terlebih dahulu barang sesuai dengan kebutuhanmu</p>
            <a href="{{ route('barang-masuk') }}"
                class="link-underline link-underline-opacity-0 link-underline-opacity-100-hover">Tambah
                Barang</a>

        </div>
    @endif
@endsection
