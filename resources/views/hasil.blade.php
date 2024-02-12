@extends('layouts/bootstrap')

@section('title', 'APPM - Aplikasi Pelayanan Pengaduan Masyarakat')

@section('content')
    <div class="hasil">
        <h2>Hasil Pencarian Laporan</h2>
        <div class="table-responsive p-3">
            <table class="table table-bordered">
                <tr>
                    <td>Kategori</td>
                    <td>{{ $hasil->kategori }}</td>
                </tr>
                <tr>
                    <td>Nama Laporan</td>
                    <td>{{ $hasil->nama_laporan }}</td>
                </tr>
                <tr>
                    <td>Detail Lapran</td>
                    <td>{{ $hasil->detail_laporan }}</td>
                </tr>
                <tr>
                    <td>Alamat Kejadian</td>
                    <td>{{ $hasil->alamat_kejadian }}</td>
                </tr>
                <tr>
                    <td>Foto</td>
                    <td><img src="{{ asset('storage/pengaduan/' . $hasil->foto) }}" style="max-width: 150px;" alt="">
                    </td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        @switch($hasil->status)
                            @case('P')
                                <span class="text-warning">Proses</span>
                            @break

                            @case('S')
                                <span class="text-success">Selesai</span>
                            @break

                            @default
                                <span class="text-secondary">Pending</span>
                        @endswitch
                    </td>
                </tr>
                <tr>
                    <td>Umpan Balik</td>
                    <td>{{ $hasil->umpan_balik }}</td>
                </tr>
            </table>

        </div>
    </div>
@endsection
