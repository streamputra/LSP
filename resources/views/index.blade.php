@extends('layouts/bootstrap')

@section('title', 'APPM - Aplikasi Pelayanan Pengaduan Masyarakat')

@section('content')
    {{-- Home --}}
    <section class="my-5 min-vh-100 d-flex flex-column justify-content-center" id="home">
        <div class="row">
            <div class="col">
                <h1>Web Pelayanan Pengaduan Masyarakat (APPM)</h1>
                <p id="quote"></p>
            </div>
        </div>

        <div class="row row-cols-auto bg-body-secondary ">
            <div class="col">
                <a class="btn btn-outline-primary rounded-0 border-0" href="#form">Pengisian Pengaduan</a>
            </div>
            <div class="col">
                <a class="btn btn-outline-info rounded-0 border-0" href="#pencarian">Pencarian Laporan (by ID)</a>
            </div>
            <div class="col">
                <a class="btn btn-outline-warning rounded-0 border-0" href="#histori">Riwayat Pengaduan</a>
            </div>
        </div>

    </section>

    {{-- Histori --}}
    <section class="my-5 min-vh-100 d-flex flex-column justify-content-center" id="histori">
        <div class="row">
            <div class="col">
                <h1>Histori</h1>
            </div>
        </div>

        <div class="row bg-body-tertiary">
            <div class="col">

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">FOTO</th>
                            <th scope="col">JUDUL</th>
                            <th scope="col">KATEGORI</th>
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
                                <td>{{ $post->kategori }}</td>
                            </tr>
                        @empty
                            <div class="alert alert-danger">
                                Belum ada laporan.
                            </div>
                        @endforelse
                    </tbody>
                </table>
                <div>
                    {{ $pengaduan->links() }}
                </div>
            </div>
        </div>

    </section>

    {{-- Form --}}
    <section class="my-5 min-vh-100 d-flex flex-column" id="form">
        <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <fieldset class="bg-primary-subtle border rounded-2 p-3">
                <h2 class="mb-3 text-center">Form Aspirasi Pengaduan</h2>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="formUID" class="form-label">ID Laporan</label>
                            <div class="input-group" id="formUID">
                                <input id="copyText" type="text" class="form-control" value="{{ $custom_id }}"
                                    id="formUID" name="id" readonly>
                                <button class="btn btn-success rounded-end" type="button" onclick="copyTextToClipboard()"
                                    id="copyBtn">Copy</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label" for="formKategori">Kategori Aspirasi</label>
                            <select required name="kategori" id="formKategori" class="form-select">
                                <option selected disabled>Pilih Kategori</option>
                                <option value="Fasilitas Umum">Fasilitas Umum</option>
                                <option value="Keamanan">Keamanan</option>
                                <option value="Kenyamanan">Kenyamanan</option>
                            </select>
                            @error('kategori')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="formLaporan" class="form-label">Nama Laporan</label>
                            <textarea required class="form-control" name="nama_laporan" id="formLaporan" cols="10" rows="3"></textarea>
                            @error('nama_laporan')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="formDetail" class="form-label">Detail</label>
                            <textarea required class="form-control" name="detail" id="formDetail" cols="10" rows="3"></textarea>
                            @error('detail')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="formAlamat" class="form-label">Alamat</label>
                            <textarea required class="form-control" name="alamat" id="formAlamat" cols="10" rows="3"></textarea>
                            @error('alamat')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label" for="formFoto">Foto Kejadian</label>
                            <input required type="file" name="foto" class="form-control" id="formFoto">
                            @error('foto')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button type="submit" class="w-100 btn btn-success">Submit</button>
                    </div>
                </div>
            </fieldset>
        </form>

    </section>

    {{-- Pencarian ID --}}
    <section class="my-3 min-vh-100 d-flex flex-column" id="pencarian">
        <h2 class="mb-3">Pencarian Laporan</h2>
        <form action="{{ route('pengaduan.cari') }}" method="GET">
            <fieldset class="p-3">
                <div class="mb-3">
                    <label for="formCari" class="form-label">Pencarian Laporan <b>(Menggunakan ID Pelaporan)</b></label>
                    <div class="input-group" aria-explainedby="explainCari">
                        <input type="text" id="formCari" class="form-control" name="id_laporan">
                        <button type="button" onclick="refreshPage()" class="btn btn-danger">
                            Reset
                        </button>
                        <button type="submit" class="btn btn-success rounded-end">Cari</button>
                    </div>
                    <div class="form-text" id="explainCari">*Contoh ID: izQlN8jSHH</div>
                </div>
            </fieldset>
        </form>
        <div class="result">
        </div>
    </section>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    @if ($message = Session::get('failed'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Check if there are validation errors and if the URL has the #form fragment identifier
                document.getElementById('form').scrollIntoView();
            });
            Swal.fire('{{ $message }}')
        </script>
    @endif
    @if (isset($fpengaduan))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Check if there are validation errors and if the URL has the #form fragment identifier
                document.getElementById('pencarian').scrollIntoView();
            });
            Swal.fire('{{ $message }}')
        </script>
    @endif
    @if ($message = Session::get('success'))
        <script>
            Swal.fire('{{ $message }}')
        </script>
    @endif
    <script>
        fetch('https://api.quotable.io/random')
            .then(response => response.json())
            .then(data => {
                const quoteElement = document.getElementById('quote');
                quoteElement.innerHTML = `"${data.content}" - <b>${data.author}</b>`;
            });

        function copyTextToClipboard() {
            // Get the text from the input field
            let copyText = document.getElementById("copyText");

            // Select the text
            copyText.select(); // For mobile devices

            // Copy the text to the clipboard
            document.execCommand("copy");

            // Optionally, you can provide some feedback to the user
            alert("ID Laporan disalin: " + copyText.value);
        }

        function refreshPage() {
            location.reload(true); // Reloads the page
        }
    </script>
@endsection
