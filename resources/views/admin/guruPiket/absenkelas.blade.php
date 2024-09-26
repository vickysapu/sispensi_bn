@extends('layout.masterFile')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">
                        <span>
                            <a href="{{ route(name: 'absensi.index') }}" class="text-decoration-none text-dark hover-link text-primary">
                                <i class="fa fa-arrow-left"></i>
                            </a>
                        </span>
                        Data Absen Kelas {{ $walikelas->kelas }} {{ $walikelas->jurusan->nama_jurusan }}
                    </h1>
                </div>
                <section class="content mt-4">
                    <div class="container-fluid">
                        @php
                        use Carbon\Carbon;
                        @endphp

                        <div class="container mt-3">
                            <h2>Absensi Kelas {{ $walikelas->kelas }} {{ $walikelas->jurusan->nama_jurusan }}</h2>
                            <p><strong>Nama Walikelas:</strong> {{ $walikelas->nama_walikelas }}</p>
                            @foreach($datatahunpelajaran as $data)
                                <p><strong>Tahun Pelajaran:</strong> {{ $data->tahunmulai }}/{{ $data->tahunselesai }} - 
                                @if ($data->semester == 1)
                                    Ganjil
                                @elseif ($data->semester ==2)
                                    Genap
                                @endif
                                </p>
                            @endforeach
                            <p><strong>Bulan:</strong> {{ Carbon::now()->isoFormat('MMMM YYYY') }}</p>

                            <div style="overflow-x: auto;" class="mt-3">
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th scope="col" rowspan="2" style="text-align: center; vertical-align: middle;">Nama Siswa</th>
                                            <th scope="col" rowspan="2" style="text-align: center; vertical-align: middle;">NIS</th>
                                            <th scope="col" rowspan="2" style="text-align: center; vertical-align: middle;">L/P</th>
                                            <th scope="col" colspan="{{ $totalDays }}">Tanggal</th>
                                            <th scope="col" colspan="3" style="text-align: center; vertical-align: middle;">Jumlah</th>
                                        <tr>
                                            @for ($day = 1; $day <= $totalDays; $day++)
                                                @php
                                                $date=Carbon::create($currentYear, $currentMonth, $day);
                                                $isWeekend=$date->isWeekend();
                                                @endphp
                                                <th scope="col" style="{{ $isWeekend ? 'background-color: #F55050; color: white;' : '' }}">
                                                    {{ str_pad($day, 2, '0', STR_PAD_LEFT) }}
                                                </th>
                                                @endfor
                                                <th scope="col" style="background-color: green; color: white;">H</th>
                                                <th scope="col" style="background-color: #A02334; color: white;">A</th>
                                                <th scope="col" style="background-color: #4D96FF; color: white;">S</th>
                                                <th scope="col" style="background-color: #FCCD2A; color: black;">I</th>
                                        </tr>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($students as $siswa)
                                        <tr>
                                            <th scope="row">{{ $siswa->nama_siswa }}</th>
                                            <td>{{ $siswa->nis }}</td>
                                            <td>{{ $siswa->jenis_kelamin === 'Laki-Laki' ? 'L' : 'P' }}</td>
                                            @for ($day = 1; $day <= $totalDays; $day++)
                                                @php
                                                $date=Carbon::create($currentYear, $currentMonth, $day);
                                                $isWeekend=$date->isWeekend();
                                                @endphp
                                                <td style="{{ $isWeekend ? 'background-color: #F55050; color: white;' : '' }}">
                                                    @if (isset($attendanceData[$siswa->nama_siswa][$day]))
                                                    @if ($attendanceData[$siswa->nama_siswa][$day] === 'Hadir')
                                                    <span style="color: white; background : green; padding : 5px; border-radius : 2px; width : 5px; height : 5px;">H</span>
                                                    @elseif ($attendanceData[$siswa->nama_siswa][$day] === 'Tidak Hadir')
                                                    <span style="color: white; background : #A02334; padding : 5px; border-radius : 2px;">A</span>
                                                    @elseif ($attendanceData[$siswa->nama_siswa][$day] === 'Sakit')
                                                    <span style="color: white; background : #4D96FF; padding : 5px; border-radius : 2px;">S</span>
                                                    @elseif ($attendanceData[$siswa->nama_siswa][$day] === 'Izin')
                                                    <span style="color: black; background : #FCCD2A; padding : 5px; border-radius : 2px;">I</span>
                                                    @endif
                                                    @elseif (!$isWeekend)
                                                    <span></span>
                                                    @endif
                                                </td>

                                                @endfor
                                                @php
                                                $totalHadir = 0;
                                                $totalTidakHadir = 0;
                                                $totalSakit = 0;
                                                $totalIzin = 0;

                                                if (isset($attendanceData[$siswa->nama_siswa])) {
                                                $totalHadir = count(array_filter($attendanceData[$siswa->nama_siswa], fn($status) => $status === 'Hadir'));
                                                $totalTidakHadir = count(array_filter($attendanceData[$siswa->nama_siswa], fn($status) => $status === 'Tidak Hadir'));
                                                $totalSakit = count(array_filter($attendanceData[$siswa->nama_siswa], fn($status) => $status === 'Sakit'));
                                                $totalIzin = count(array_filter($attendanceData[$siswa->nama_siswa], fn($status) => $status === 'Izin'));
                                                }
                                                @endphp

                                                <td>
                                                    <span style="color: black; padding: 5px; border-radius: 2px;">
                                                        {{ $totalHadir > 0 ? $totalHadir : '' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span style="color: black; padding: 5px; border-radius: 2px;">
                                                        {{ $totalTidakHadir > 0 ? $totalTidakHadir : '' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span style="color: black; padding: 5px; border-radius: 2px;">
                                                        {{ $totalSakit > 0 ? $totalSakit : '' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span style="color: black; padding: 5px; border-radius: 2px;">
                                                        {{ $totalIzin > 0 ? $totalIzin : '' }}
                                                    </span>
                                                </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-3 mb-3">
                                <p><strong>Keterangan:</strong></p>
                                <p><span class="badge" style="background-color : green;">H = Hadir</span></p>
                                <p><span class="badge" style="background-color : #A02334;">A = Tidak Hadir</span></p>
                                <p><span class="badge" style="background-color : #4D96FF;">S = Sakit</span></p>
                                <p><span class="badge" style="background-color : #FCCD2A; color : black;">I = Izin</span></p>
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