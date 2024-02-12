@extends('layouts/bootstrap')

@section('title', 'APPM - Aplikasi Pelayanan Pengaduan Masyarakat')

@section('content')
<div class="d-flex flex-column justify-content-center align-items-center">
    @for ($i = 0; $i < 3; $i++)    
    <div class="row row-cols-auto">
        <div class="col">
            <img src="{{ asset('images/pegasia.jpg')}}" alt="image" style="max-width: 200px">
        </div>
        <div class="col">
            <img src="{{ asset('images/pegasia.jpg')}}" alt="image" style="max-width: 200px">
        </div>
        <div class="col">
            <img src="{{ asset('images/pegasia.jpg')}}" alt="image" style="max-width: 200px">
        </div>
    </div>
    @endfor
</div>
@endsection
