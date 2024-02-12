@extends('layouts/admin-bootstrap')

@section('title', 'Admin APPM')
@section('content')
    <div class="row">
        <div class="col">
            <h2>Data Pengaduan dan Aspirasi Masyarakat</h2>
            <p>CRUD (R) utk: liat histori</p>
            <p>CRUD (U) utk: Update umpan balik dan status penyelesaian</p>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col">GAMBAR</th>
                        <th scope="col">LAPORAN</th>
                        <th scope="col">STATUS</th>
                        <th scope="col">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pengaduan as $post)
                        <tr>
                            <td class="text-center">
                                <img src="{{ asset('storage/pengaduan/' . $post->foto) }}" class="rounded"
                                    style="width: 150px">
                            </td>
                            <td>{{ $post->nama_laporan }}</td>
                            <td>
                                @switch($post->status)
                                    @case(null)
                                    <b class="text-secondary">
                                        Pending
                                    </b>
                                        @break
                            
                                    @case('P')
                                    <b class="text-warning">
                                        Proses
                                    </b>
                                        @break
                            
                                    @case('S')
                                    <b class="text-success">
                                        Selesai
                                    </b>
                                        @break
                            
                                    @default
                                        <!-- Handle other cases if needed -->
                                        Unknown
                                @endswitch
                            </td>
                            
                            <td class="text-center">
                                <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('admin.destroy', $post->id) }}" method="POST">
                                    <div class="d-flex flex-column">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('admin.show', $post->id) }}" class="btn btn-primary rounded-0">Lihat</a>
                                        <a href="{{ route('admin.edit', $post->id) }}" class="btn btn-warning rounded-0">Edit</a>
                                        <button type="submit" class="btn btn-sm btn-danger rounded-0">HAPUS</button>
                                    </div>
                                    </form>

                            </td>
                        </tr>
                    @empty
                        <div class="alert alert-danger">
                            Data Post belum Tersedia.
                        </div>
                    @endforelse
                </tbody>
            </table>
            {{ $pengaduan->links() }}
        </div>
    </div>
@endsection
