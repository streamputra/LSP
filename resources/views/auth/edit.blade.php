@extends('layouts/admin-bootstrap')

@section('title', 'Edit')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <a class="btn btn-warning" href="{{ route('admin.index') }}">
                        Kembali
                    </a>
                    <div class="mb-3"></div>
                    <a class="btn btn-info" href="{{ route('admin.show', $post->id) }}">
                        Laporan: {{ $post->nama_laporan }}
                    </a>
                    <div class="mb-3"></div>

                    <form action="{{ route('admin.update', $post->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <fieldset class="p-3 border rounded">
                            <div class="form-group">
                                <label class="font-weight-bold" for="formFeedback">Umpan Balik</label>
                                <textarea type="file" id="formFeedback" class="form-control" name="umpan_balik">{{ $post->umpan_balik }}</textarea>
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Status</label>
                                <select name="status" id="formStatus" class="form-select">
                                    <option selected disabled>Status...</option>
                                    <option value="P">Proses</option>
                                    <option value="S">Selesai</option>
                                </select>

                                <!-- error message untuk title -->
                                @error('title')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="form-text">Kondisi sekarang:
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
                                </div>
                            </div>

                            <button type="submit" class="btn btn-md btn-primary rounded-0">UPDATE</button>
                            <button type="reset" class="btn btn-md btn-danger rounded-0">RESET</button>
                        </fieldset>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')

@endsection
