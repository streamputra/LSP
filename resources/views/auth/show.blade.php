@extends('layouts/admin-bootstrap')

@section('title', 'Show')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <div>
                        <a class="link-warning text-capitalize" href="{{ url()->previous() }}">back</a>
                    </div>
                    <div class="w-100 mt-2 mb-2"></div>
                    <img src="{{ asset('storage/pengaduan/' . $post->foto) }}" class="w-100 rounded" style="max-width: 450px">
                    <hr>
                    <h4>{{ $post->nama_laporan }}</h4>
                    <p class="tmt-3">
                        {!! $post->detail_laporan !!}
                    </p>
                    <hr>
                    <div class="">
                        Kategori: {{ $post->kategori }}<br>

                        Status:
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
                        @endswitch <a href="{{ route('admin.edit', $post->id) }}">Ganti</a> <br>
                        Alamat: {{$post->alamat_kejadian}}
                    </div>
                    <div>
                        <a class="w-100 btn btn-warning text-uppercase" href="{{ url()->previous() }}">back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection
