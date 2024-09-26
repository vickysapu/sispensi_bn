@extends('layout/masterFile')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Jurusan</h1>
                    </div>
                    <section class="content mt-4">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="container mt-3">
                                                @if (session('success'))
                                                    <div class="alert alert-success alert-dismissible fade show position-relative"
                                                        role="alert" id="success-alert">
                                                        <strong>{{ session('success') }}</strong><br>
                                                        <p>Nama Siswa: {{ session('nama_siswa') }}</p>
                                                        <p>NIS: {{ session('nis') }}</p>
                                                        @if (session('foto'))
                                                            <p>Foto Siswa:</p>
                                                            <img src="{{ asset('fotoPelajar/' . session('foto')) }}"
                                                                alt="Foto {{ session('nama_siswa') }}"
                                                                style="max-width: 100px;">
                                                        @endif
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                            aria-label="Close"></button>

                                                        <div class="progress position-absolute bottom-0 start-0 w-100"
                                                            style="height: 5px;">
                                                            <div class="progress-bar bg-success" role="progressbar"
                                                                style="width: 100%;" id="progress-bar"></div>
                                                        </div>
                                                    </div>
                                                @endif


                                                @if (session('error'))
                                                    <div class="alert alert-danger alert-dismissible fade show"
                                                        role="alert">
                                                        {{ session('error') }}
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                            aria-label="Close"></button>
                                                    </div>
                                                @endif

                                                <form action="{{ route('absensi.absen') }}" method="POST" id="absenForm">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="nama_siswa">Nama Siswa</label>
                                                        <input type="text" class="form-control" id="nama_siswa" required
                                                            name="nama_siswa" list="datalistOptions"
                                                            oninput="validateInput()">
                                                        <datalist id="datalistOptions">
                                                            @foreach ($dataSiswa as $item)
                                                                <option value="{{ $item->nama_siswa }}">
                                                            @endforeach
                                                        </datalist>
                                                        <small id="error-message" class="text-danger"
                                                            style="display: none;">Nama siswa tidak
                                                            ditemukan.</small>
                                                    </div>

                                                    <script>
                                                        document.addEventListener("DOMContentLoaded", function() {
                                                            const nisInput = document.getElementById("nis");
                                                            let scannerData = ''; // Untuk menyimpan data yang di-scan

                                                            // Menangkap input dari pemindai
                                                            nisInput.addEventListener("input", function(event) {
                                                                const value = event.target.value;

                                                                // Jika ada karakter baru yang ditambahkan
                                                                if (value.length > scannerData.length) {
                                                                    scannerData += value.charAt(value.length - 1); // Menyimpan karakter terakhir yang dimasukkan
                                                                }

                                                                // Jika data sudah lengkap, tampilkan di console
                                                                if (scannerData.length > 0) {
                                                                    console.log("NIS yang di-scan:", scannerData); // Untuk debugging
                                                                    nisInput.value = scannerData; // Memasukkan hasil scan ke input
                                                                }
                                                            });

                                                            setInterval(() => {
                                                                if (scannerData.length > 0) {
                                                                    scannerData = ''; // Mengosongkan data setelah diproses
                                                                    nisInput.value = ''; // Mengosongkan input jika diperlukan
                                                                }
                                                            }, 2000); 
                                                        });
                                                    </script>



                                                    <div class="form-group">
                                                        <label for="status">Status</label>
                                                        <select class="form-control" id="status" name="status" required>
                                                            <option value="Hadir">Hadir</option>
                                                            <option value="Tidak Hadir">Tidak Hadir</option>
                                                            <option value="Sakit">Sakit</option>
                                                            <option value="Izin">Izin</option>
                                                        </select>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary" id="submitButton"
                                                        disabled>Absen</button>
                                                </form>

                                                <script>
                                                    document.getElementById('nis').addEventListener('input', function() {
                                                        // Fokus pada pengisian NIS dari hasil scan barcode
                                                        const scannedNis = this.value;

                                                        // Validasi atau aksi lain untuk NIS bisa ditambahkan di sini

                                                        console.log("NIS yang di-scan: " + scannedNis);

                                                        // Jika validasi atau aksi lain dibutuhkan setelah input NIS
                                                    });

                                                    // Jika Anda ingin mengosongkan atau membersihkan input setelah beberapa detik
                                                    function clearNisInput() {
                                                        setTimeout(function() {
                                                            document.getElementById('nis').value = ''; // Bersihkan input NIS setelah interval tertentu
                                                        }, 2000); // 2 detik contoh waktu
                                                    }
                                                </script>

                                                <script>
                                                    function validateInput() {
                                                        const input = document.getElementById('nama_siswa');
                                                        const submitButton = document.getElementById('submitButton');
                                                        const errorMessage = document.getElementById('error-message');

                                                        const options = Array.from(document.querySelectorAll('#datalistOptions option')).map(option => option.value);

                                                        if (options.includes(input.value)) {
                                                            errorMessage.style.display = 'none';
                                                            submitButton.disabled = false;
                                                        } else {
                                                            errorMessage.style.display = 'block';
                                                            submitButton.disabled = true;
                                                        }
                                                    }
                                                </script>
                                            </div>
                                        </div>
                                        <div class="container mt-5">
                                            <div class="row justify-content-left">
                                                @php
                                                    $order = [
                                                        'RPL',
                                                        'DKV 1',
                                                        'DKV 2',
                                                        'TKP',
                                                        'TP',
                                                        'KULINER 1',
                                                        'KULINER 2',
                                                    ];

                                                    $sortedData = $datawalikelas->sortBy(function ($item) use ($order) {
                                                        $index = array_search($item->Jurusan->nama_jurusan, $order);
                                                        return $index !== false ? $index : count($order);
                                                    });
                                                @endphp

                                                @foreach ($sortedData as $data)
                                                    @php
                                                        $bgColor = '';
                                                        switch ($data->Jurusan->nama_jurusan) {
                                                            case 'RPL':
                                                                $bgColor = 'bg-warning';
                                                                break;
                                                            case 'DKV 1':
                                                            case 'DKV 2':
                                                                $bgColor = 'bg-orange';
                                                                break;
                                                            case 'TKP':
                                                                $bgColor = 'bg-danger';
                                                                break;
                                                            case 'TP':
                                                                $bgColor = 'bg-primary';
                                                                break;
                                                            case 'KULINER':
                                                            case 'KULINER 1':
                                                            case 'KULINER 2':
                                                                $bgColor = 'bg-light';
                                                                break;
                                                            default:
                                                                $bgColor = 'bg-pink';
                                                                break;
                                                        }
                                                    @endphp
                                                    <div class="col-md-4 mb-4">
                                                        <a href="{{ route('absensi.absenkelas', $data->id) }}" class="text-decoration-none text-dark hover-link text-primary">
                                                            <div class="card text-white {{ $bgColor }}"
                                                                style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                                                <div class="card-body text-center" style="color: black;">
                                                                    <h3 class="card-title">Kelas {{ $data->kelas }}</h3>
                                                                    <p class="card-text" style="font-size: 3rem">
                                                                        {{ $data->Jurusan->nama_jurusan }}</p>
                                                                    <p class="card-text mt-2">{{ $data->nama_walikelas }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                </section>
            </div>
        </div>
    </div>
    </section>
    </div>
@endsection
