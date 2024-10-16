<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Izin</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.4;
            margin: 5px;
            padding: 0;
            width: 80mm;
        }

        .surat-container {
            width: 100%;
        }

        .header {
            text-align: left;
            margin-bottom: 10px;
        }

        .header h2 {
            margin: 0;
            font-size: 14px;
        }

        .details {
            margin-bottom: 10px;
        }

        .details .row {
            display: flex;
            justify-content: space-between;
            width: 100%;
            margin-bottom: 1px;
        }

        .details .row div {
            width: 100%; /* Ensure columns use full width */
        }

        .content {
            margin-top: 10px;
        }

        .footer {
            margin-top: 20px;
            text-align: right;
        }

        @media print {
            body {
                margin: 0;
                padding: 5mm;
                width: 80mm;
            }

            * {
                -webkit-print-color-adjust: exact;
            }

            @page {
                margin: auto;
                size: 80mm auto;
            }

            header,
            nav,
            .non-printable {
                display: none;
            }
        }
    </style>
</head>
<body onload="window.print();">
    <div class="surat-container">
        <div class="header">
            @php
                $data = App\Models\sekolah::first();
            @endphp
            @if ($data)
                <p style="font-weight: bold;">{{ $data->nama_sekolah }}</p>
                <p><small>{{ $data->alamat_sekolah }}</small></p>
                <hr style="border: 0.5px solid black;">
            @endif
        </div>

        <div class="details">
            <div class="row">
                <div>
                    <strong>No:</strong> {{ $addsuratizin->nomor }}
                </div>
            </div>
            <div class="row" style="margin-bottom: 10px;">
                <div>
                    <strong>Hal:</strong> {{ $addsuratizin->perihal }}
                </div>
            </div>
            <h4>Kepada Yth. Bp/Ibu Guru</h4>
            <h4>Dengan ini kami memberitahukan bahwa :</h4>
            <div class="row" style="margin-top: 10px;">
                <div>
                    <strong>Nama:</strong>
                    <!-- Tampilkan nama siswa dengan pemisah koma -->
                    @php
                        $namaSiswa = $studentsWithSameUUID->pluck('nama_siswa')->join(', ');
                    @endphp
                    {{ $namaSiswa }}
                </div>
            </div>
            <div class="row" style="margin-bottom: 10px;">
                <div>
                    <strong>Kelas:</strong>
                    @if ($addsuratizin->student->kelas == 10)
                        X
                    @elseif ($addsuratizin->student->kelas == 11)
                        XI
                    @elseif ($addsuratizin->student->kelas == 12)
                        XII
                    @endif
                    {{ $addsuratizin->student->jurusan->nama_jurusan }}
                </div>
            </div>
            @php
                \Carbon\Carbon::setLocale('id');
                $tanggal = \Carbon\Carbon::now()->translatedFormat('l, d F Y');
            @endphp

            <h4>Tidak mengikuti kegiatan belajar mengajar pada hari {{ $tanggal }} pada jam {{ $addsuratizin->jam_pelajaran }} dengan alasan {{ $addsuratizin->keterangan }}</h4>
        </div>

        <div class="footer">
            <p>Semarang, {{ now()->format('d/m/Y') }}</p>
            <p>{{ session('username') }}</p>
            <br>
            <br>
            <p>( {{ session('nama_pengguna') }} )</p>
        </div>
    </div>
</body>
</html>
