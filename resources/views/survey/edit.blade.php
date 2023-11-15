@extends('theme.app')
@section('title', 'Survey Edit')

@section('content')
    <!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="#" class="headerButton" data-bs-toggle="modal" data-bs-target="#sidebarPanel">
                <ion-icon name="menu-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">SURVEY</div>
        <div class="right">
            <a href="javascript:;" class="headerButton toggle-searchbox">
                <ion-icon name="search-outline"></ion-icon>
            </a>
        </div>
    </div>
    <!-- * App Header -->

    <!-- Search Component -->
    <div id="search" class="appHeader">
        <form class="search-form" action="{{ route('survey.index') }}" method="GET">
            <div class="form-group searchbox">
                <input type="text" class="form-control" name="name" id="name" value="{{ request('name') }}"
                    placeholder="Search...">
                <i class="input-icon icon ion-ios-search"></i>
                <a href="javascript:;" class="ms-1 close toggle-searchbox"><i class="icon ion-ios-close-circle"></i></a>
            </div>
        </form>
    </div>
    <!-- * Search Component -->

    <!-- App Capsule -->
    <div id="appCapsule">
        <div class="section mt-2">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('survey.simpan', ['survei' => $data->kd_pengajuan]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <input type="text" class="form-control" name="no_identitas" style="margin-top:-15px;"
                                    value="{{ $data->no_identitas }}" hidden>
                                <input type="text" class="form-control" name="nama" style="margin-top:-15px;"
                                    value="{{ $data->nama_nasabah }}" readonly>
                                <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                            </div>
                        </div>

                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <textarea class="form-control" style="margin-top:-15px;" rows="3" readonly>{{ $data->alamat_ktp }}</textarea>
                                <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                            </div>
                        </div>

                        <div class="form-group basic mt-1">
                            <div class="input-wrapper">
                                <input type="text" class="form-control" style="margin-top:-25px;" name="location"
                                    id="loc"
                                    value="{{ $data->latitude && $data->longitude ? $data->latitude . ',' . $data->longitude : 'Tidak ada Lokasi' }}"
                                    readonly>

                                <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                            </div>
                        </div>

                        <div class="section mt-1">
                            <div class="section-title">Upload Foto</div>
                            <div class="card">
                                <div class="card-body">
                
                                    <form>
                                        <div class="custom-file-upload" id="fileUpload1">
                                            <input type="file" id="fileuploadInput" accept=".png, .jpg, .jpeg">
                                            <label for="fileuploadInput">
                                                <span>
                                                    <strong>
                                                        <ion-icon name="arrow-up-circle-outline" role="img" class="md hydrated" aria-label="arrow up circle outline"></ion-icon>
                                                        <i>Upload a Photo</i>
                                                    </strong>
                                                </span>
                                            </label>
                                        </div>
                
                                    </form>
                
                                </div>
                            </div>
                        </div>

                        {{-- <div class="accordion" id="survey_foto">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#foto_survey" style="font-size: 12px;margin-left:-15px;">
                                        <b>FOTO SURVEY</b>
                                    </button>
                                </h2>
                                <div id="foto_survey" class="accordion-collapse collapse mb-1"
                                    data-bs-parent="#survey_foto">
                                    <img src="{{ $data->foto ? asset('storage/image/foto_survei/' . $data->foto) : 'null' }}"
                                        alt="image" class="imaged img-fluid">
                                </div>
                            </div>
                        </div> --}}

                        <div class="custom-file-upload mt-1" id="fileUpload1">
                            <input type="text" name="foto_survei" value="" hidden>
                            <input type="text" name="oldphoto" value="" hidden>
                            <input type="file" id="fileuploadInput" name="foto" accept=".png, .jpg, .jpeg" required>
                            <label for="fileuploadInput">
                                <span>
                                    <strong>
                                        <ion-icon name="arrow-up-circle-outline"></ion-icon>
                                        <i>Upload a Photo</i>
                                    </strong>
                                </span>
                            </label>
                        </div>

                        <button type="submit" id="bt" class="btn btn-primary btn-block mt-1">SIMPAN</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- * App Capsule -->
@endsection

@push('myscript')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/js/myscript/get_loc.js') }}"></script>
    {{-- <script>
        document.getElementById('fileuploadInput').addEventListener('click', function(event) {
            if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                // Perangkat mobile terdeteksi, atur input untuk hanya menerima gambar dari penyimpanan perangkat
                this.setAttribute('capture', 'environment');
            }
        });
    </script> --}}
@endpush
