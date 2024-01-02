@extends('theme.app')
@section('title', 'SURVEY')

@section('content')
    <!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="#" class="headerButton" data-toggle="modal" data-target="#sidebarPanel">
                <ion-icon name="menu-outline" role="img" class="md hydrated" aria-label="menu outline"></ion-icon>
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
                <i class="input-icon">
                    <ion-icon name="search-outline"></ion-icon>
                </i>
                <a href="javascript:;" class="ml-1 close toggle-searchbox">
                    <ion-icon name="close-circle"></ion-icon>
                </a>
            </div>
        </form>
    </div>
    <!-- * Search Component -->

    <!-- App Capsule -->
    <div id="appCapsule">
        <div class="section full mb-2">
            <div class="wide-block pb-1 pt-2">

                <form action="{{ route('survey.simpan', ['survei' => $data->kd_pengajuan]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <input type="text" class="form-control" name="no_identitas" value="{{ $data->no_identitas }}"
                                hidden>
                            <input type="text" class="form-control" name="nama" value="{{ $data->nama_nasabah }}"
                                readonly>
                        </div>
                    </div>

                    <div class="form-group boxed" style="margin-top: -10px;">
                        <div class="input-wrapper">
                            <textarea id="address5" rows="3" class="form-control" readonly>{{ $data->alamat_ktp }}</textarea>
                        </div>
                    </div>

                    <div class="form-group boxed" style="margin-top: -10px;">
                        <div class="input-wrapper">
                            <input type="text" class="form-control" name="location" id="loc"
                                value="{{ $data->latitude && $data->longitude ? $data->latitude . ',' . $data->longitude : 'Tidak ada Lokasi' }}"
                                readonly>
                        </div>
                    </div>

                    <div class="custom-file-upload">
                        <input type="text" name="oldphoto" value="{{ $data->foto }}" hidden>
                        <input type="file" id="fileuploadInput" name="foto" accept=".png, .jpg, .jpeg">
                        <label for="fileuploadInput">
                            <span>
                                <strong>
                                    <ion-icon name="cloud-upload-outline"></ion-icon>
                                    <i>Tap to Upload</i>
                                </strong>
                            </span>
                        </label>
                    </div>

                    <div class="accordion mt-1" id="accordionExample3">
                        <div class="item">
                            <div class="accordion-header">
                                <button class="btn collapsed" type="button" data-toggle="collapse"
                                    data-target="#accordion002" aria-expanded="false" style="margin-left: -17px;">
                                    Preview
                                </button>
                            </div>
                            <div id="accordion002" class="accordion-body collapse" data-parent="#accordionExample3">
                                <div class="accordion-content">
                                    <img src="{{ $data->foto ? asset('storage/image/foto_survei/' . $data->foto) : 'null' }}"
                                        class="card-img-top" alt="image">
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" id="bt" class="btn btn-primary btn-block mt-1">SIMPAN</button>
                </form>
                <div class="row mt-1">
                    <div class="col">
                        <div id="map" style="height: 200px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- * App Capsule -->

@endsection

@push('myscript')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    <script src="{{ asset('assets/js/myscript/get_loc.js') }}"></script>
@endpush
