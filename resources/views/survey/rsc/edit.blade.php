@extends('theme.app')
@section('title', 'SURVEY')
<style>
    .swal2-popup {
        max-height: 300px !important;
        max-width: 300px !important;
    }

    .swal2-icon {
        font-size: 10px !important;
    }

    .swal2-text {
        font-size: 12px !important;
    }

    .swal2-confirm {
        background: #3aa9a9 !important;
    }
</style>
@section('content')
    <!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="#" class="headerButton" data-toggle="modal" data-target="#sidebarPanel">
                <ion-icon name="menu-outline" role="img" class="md hydrated" aria-label="menu outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">SURVEY RSC</div>
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

                <form id="formsurvei"
                    action="{{ route('survey.simpan.rsc', ['survei' => $data->kd_pengajuan, 'rsc' => $data->kd_rsc, 'status_rsc' => $data->status_rsc]) }}"
                    method="POST" enctype="multipart/form-data">
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

                    <div class="row mt-1" style="margin-top: 5px">
                        <div class="col">
                            <input type="hidden" name="photo" value="" id="photo" required>
                            <div class="webcam-capture"></div>
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
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
        crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/myscript/get_loc.js') }}"></script>

    <script>
        const errorMessage = '{{ Session::get('error') }}';
        const successMessage = '{{ Session::get('success') }}';

        if (errorMessage) {
            Swal.fire({
                text: 'Pastikan Lokasi Telah Diizinkan',
                icon: 'error',
                showConfirmButton: false,
                timer: 3000,
            });
        } else if (successMessage) {
            Swal.fire({
                text: successMessage,
                icon: 'success',
                showConfirmButton: false
            })
            setTimeout(function() {
                location.href = '/survey';
            }, 2000);
        }

        Webcam.set({
            height: 480,
            width: 480,
            image_format: 'jpeg',
            jpeg_quality: 80
        });

        Webcam.attach('.webcam-capture');

        $('#bt').click(function(e) {
            e.preventDefault();

            Webcam.snap(function(uri) {
                $('#photo').val(uri)
                $('#formsurvei')[0].submit();
            });


        })
    </script>
@endpush
