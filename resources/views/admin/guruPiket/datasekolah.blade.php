@extends('layout.masterFile')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Sekolah</h1>
                    </div>
                </div>
                <div class="container-xl px-4 mt-4">
                    <div class="row">
                        <div class="col-xl-4">
                            <div class="card mb-4 mb-xl-0">
                                <div class="card-header">Logo Sekolah</div>
                                <div class="card-body text-center">
                                    <form action="{{ route('datasekolah.updateImage') }}" method="POST"
                                        enctype="multipart/form-data" id="logoForm">
                                        @csrf
                                        @foreach ($indexSekolah as $index)
                                            <img class="img-account-profile rounded-circle mb-2"
                                                src="{{ asset('logo/' . $index->logo_sekolah) }}" style="width: 48rem"
                                                alt="">
                                        @endforeach
                                        <div class="small font-italic text-muted mb-4">.PNG tidak lebih besar dari 5 MB
                                        </div>
                                        <button class="btn btn-primary" type="button" id="changeLogoButton">
                                            Ubah
                                        </button>
                                        <input type="file" id="logoInput" name="logo_sekolah" style="display:none;">
                                    </form>
                                </div>

                                <script>
                                    document.getElementById('changeLogoButton').addEventListener('click', function() {
                                        document.getElementById('logoInput').click();
                                    });

                                    document.getElementById('logoInput').addEventListener('change', function() {
                                        if (this.files && this.files.length > 0) {
                                            document.getElementById('logoForm').submit();
                                        }
                                    });
                                </script>

                            </div>
                        </div>
                        <div class="col-xl-8">
                            <div class="card mb-4">
                                <div class="card-header">Detail Data</div>
                                <div class="card-body">
                                    <form action="{{ route('sekolah.add') }}" method="POST">
                                        @csrf
                                        @foreach ($indexSekolah as $index)
                                            <div class="row gx-3 mb-3">
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="nama_sekolah">Nama Sekolah</label>
                                                    <input class="form-control" id="nama_sekolah" name="nama_sekolah"
                                                        type="text" required placeholder="nama sekolah..." value="{{ $index->nama_sekolah }}"
                                                        fdprocessedid="1x4auki">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="telepon_sekolah">No. Telepon
                                                        Sekolah</label>
                                                    <input class="form-control" id="telepon_sekolah" type="text"
                                                        placeholder="telepon sekolah..." name="telepon_sekolah" value="{{ $index->telepon_sekolah }}" required
                                                        fdprocessedid="y8nas3">
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="small mb-1" for="email_sekolah">Email Sekolah</label>
                                                <input class="form-control" id="email_sekolah" name="email_sekolah" value="{{ $index->email_sekolah }}"
                                                    type="email" placeholder="email sekolah..." fdprocessedid="j31p8">
                                            </div>
                                            <div class="mb-3">
                                                <label class="small mb-1" for="website_sekolah">Website Sekolah</label>
                                                <input class="form-control" id="website_sekolah" name="website_sekolah" value="{{ $index->website_sekolah }}"
                                                    type="text" placeholder="website sekolah..." fdprocessedid="j31p8">
                                            </div>
                                            <div class="mb-3">
                                                <label class="small mb-1" for="alamat_sekolah">Alamat Sekolah</label>
                                                <input class="form-control" id="alamat_sekolah" type="text" value="{{ $index->alamat_sekolah }}"
                                                    placeholder="alamat sekolah..." name="alamat_sekolah"
                                                    fdprocessedid="j31p8">
                                            </div>
                                            <div class="mb-3">
                                                <label class="small mb-1" for="kode_pos">Kode Pos</label>
                                                <input class="form-control" id="kode_pos" name="kode_pos" type="text" value="{{ $index->kode_pos }}"
                                                    placeholder="Kode pos..." fdprocessedid="j31p8">
                                            </div>
                                            <div class="row gx-3 mb-3">
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="kepala_sekolah">Nama Kepala
                                                        Sekolah</label>
                                                    <input class="form-control" id="kepala_sekolah" type="text"
                                                        name="kepala_sekolah" required placeholder="nama kepala sekolah..." value="{{ $index->kepala_sekolah }}"
                                                        fdprocessedid="1x4auki">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="nip_kepala_sekolah">Nip Kepala
                                                        Sekolah</label>
                                                    <input class="form-control" id="nip_kepala_sekolah" value="{{ $index->nip_kepala_sekolah }}"
                                                        name="nip_kepala_sekolah" type="text"
                                                        placeholder="nip kepala sekolah..." required
                                                        fdprocessedid="y8nas3">
                                                </div>
                                            </div>
                                        @endforeach

                                        <button class="btn btn-primary" type="submit"
                                            fdprocessedid="rm8md">Ubah</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('preview-image');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                }
                reader.readAsDataURL(file);
            } else {
                preview.src = "{{ asset('fotoPelajar/1726670353_Screenshot 2024-08-21 110133.png') }}";
            }
        }
    </script>
@endsection
