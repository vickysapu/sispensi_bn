@extends('layout.masterFile')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Guru Piket</h1>
                </div>
                <section class="content mt-4">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header d-flex flex-wrap align-items-center">
                                        <a href="#" class="btn btn-primary mr-2" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal">
                                            <i class="fa fa-plus"></i> Tambah Data
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-6"></div>
                                                <div class="col-sm-12 col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <table id="example2"
                                                        class="table table-bordered table-hover dataTable dtr-inline text-center">
                                                        <thead>
                                                            <tr>
                                                                    <th class="sorting" tabindex="0"
                                                                        aria-controls="example2" rowspan="1" colspan="1">
                                                                    Nama Guru</th>
                                                                <th class="sorting" tabindex="0"
                                                                    aria-controls="example2" rowspan="1" colspan="1">
                                                                    Hari Piket</th>
                                                                <th class="sorting" tabindex="0"
                                                                    aria-controls="example2" rowspan="1" colspan="1">
                                                                    Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                            $urutanHari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
                                                            @endphp
                                                            @php
                                                            $sortedData = $indexdatapiket->sortBy(function($item) use
                                                            ($urutanHari) {
                                                            return array_search($item->hari_piket, $urutanHari);
                                                            });
                                                            @endphp
                                                            @foreach ($sortedData as $index)
                                                            <tr>
                                                                <td>{{ $index->nama_guru }}</td>
                                                                <td>{{ $index->hari_piket }}</td>
                                                                <td>
                                                                    <a href="{{ route('datapiket.edit', $index->hari_piket) }}" class="btn btn-warning">
                                                                        <i class="fa fa-pen"></i>
                                                                    </a>
                                                                    <a href="#" onclick="
                                                                                event.preventDefault();
                                                                                Swal.fire({
                                                                                    title: 'anda yakin?',
                                                                                    text: 'apakah anda yakinuntuk menghapus data ini!',
                                                                                    icon: 'warning',
                                                                                    showCancelButton: true,
                                                                                    confirmButtonColor: '#3085d6',
                                                                                    cancelButtonColor: '#d33',
                                                                                    confirmButtonText: 'hapus',
                                                                                    cancelButtonText: 'batal',
                                                                                }).then((result) => {
                                                                                    if (result.isConfirmed) {
                                                                                        window.location.href = '{{ route('datapiket.hapus', $index->hari_piket) }}';
                                                                                    }
                                                                                });
                                                                            " class="btn btn-danger">
                                                                        <i class="fa fa-trash"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                @if ($totaldatapiket)
                                                                <th rowspan="6" colspan="6">Total guru : {{
                                                                    $totaldatapiket }}</th>
                                                                @endif
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 col-md-7">
                                                    <div class="dataTables_paginate paging_simple_numbers"
                                                        id="example2_paginate">
                                                        {{ $indexdatapiket->links('layout.paginate') }}
                                                    </div>
                                                </div>
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


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="dataForm" action="{{ route('datapiket.add') }}" method="POST" enctype="multipart/form-data"
                novalidate>
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama_guru">Nama Guru</label>
                        <textarea name="nama_guru" class="form-control" id="nama_guru"
                            placeholder="Masukkan nama guru piket (pisahkan dengan koma)..." required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="hari_piket">Hari Piket</label>
                        <input type="text" name="hari_piket" class="form-control" list="haripiket" id="hari_piket"
                            placeholder="hari piket..." required>
                        <div class="invalid-feedback">
                            Mohon masukkan hari piket yang valid.
                        </div>
                    </div>

                    <datalist id="haripiket">
                        <option value="Senin"></option>
                        <option value="Selasa"></option>
                        <option value="Rabu"></option>
                        <option value="Kamis"></option>
                        <option value="Jumat"></option>
                    </datalist>

                    <button type="submit" class="btn btn-primary" id="submitBtn" disabled>Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const validDays = ['senin', 'selasa', 'rabu', 'kamis', 'jumat'];
        const hariPiketInput = document.getElementById('hari_piket');
        const submitBtn = document.getElementById('submitBtn');

        hariPiketInput.addEventListener('input', function () {
            const inputValue = hariPiketInput.value.toLowerCase();
            if (validDays.includes(inputValue)) {
                submitBtn.disabled = false;
                hariPiketInput.classList.remove('is-invalid');
            } else {
                submitBtn.disabled = true;
                hariPiketInput.classList.add('is-invalid');
            }
        });

        (function () {
            'use strict';
            var forms = document.querySelectorAll('form');
            Array.prototype.slice.call(forms).forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity() || submitBtn.disabled) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
</script>


@if (session('edit_modal_id'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var editModal = new bootstrap.Modal(document.getElementById('Edit_Siswa'));
        editModal.show();
    });
</script>
@endif

<div class="modal fade" id="Edit_Siswa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit datapiket</h5>
            </div>
            @if ($editdatapiket)
            <form action="{{ route('datapiket.update', $editdatapiket->hari_piket) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_guru">Nama Guru</label>
                        <input type="text" name="nama_guru" class="form-control" id="nama_guru"
                            value="{{ $editdatapiket->nama_guru }}" placeholder="Masukkan nama guru piket..." required>
                    </div>
                    <div class="form-group">
                        <label for="hari_piket">Hari Piket</label>
                        <input type="text" name="hari_piket" class="form-control" list="haripiket" id="hari_piket"
                            placeholder="hari piket..." value="{{ $editdatapiket->hari_piket }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('datapiket.index') }}" type="button" class="btn btn-secondary">Close</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
            @else
            <p>Data not found!</p>
            @endif
        </div>
    </div>
</div>

@endsection
