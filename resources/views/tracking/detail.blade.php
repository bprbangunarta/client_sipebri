@extends('theme.app')
@section('title', 'TRACKING')

@section('content')
    <!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="#" class="headerButton" data-toggle="modal" data-target="#sidebarPanel">
                <ion-icon name="menu-outline" role="img" class="md hydrated" aria-label="menu outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">TRACKING</div>
        <div class="right">
            <a href="javascript:;" class="headerButton toggle-searchbox">
                <ion-icon name="search-outline"></ion-icon>
            </a>
        </div>
    </div>
    <!-- * App Header -->

    <!-- Search Component -->
    <div id="search" class="appHeader">
        <form class="search-form" action="{{ route('tracking.index') }}" method="GET">
            <div class="form-group searchbox">
                <input type="text" class="form-control" name="name" id="name" value="{{ request('name') }}" placeholder="Search...">
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
        <div class="section mt-2 mb-2">
            <div class="card">
                <!-- timeline -->

                <div class="wide-block">
                    <!-- timeline -->
                    <div class="timeline">
                        <div class="item">
                            <div class="dot"></div>
                            <div class="content">
                                <h4 class="title">Verifikasi Data</h4>
                                <div class="text">{{ $data->pemeriksaan_dokumen ?? '-' }}</div>
                            </div>
                        </div>

                        <div class="item">
                            <div class="dot bg-warning"></div>
                            <div class="content">
                                <h4 class="title">Proses Survey</h4>
                                <div class="text">{{ $data->proses_survey ?? '-' }}</div>
                            </div>
                        </div>

                        <div class="item">
                            <div class="dot bg-warning"></div>
                            <div class="content">
                                <h4 class="title">Proses Analisa</h4>
                                <div class="text">{{ $data->analisa_kredit ?? '-' }}</div>
                            </div>
                        </div>

                        <div class="item">
                            <div class="dot bg-primary"></div>
                            <div class="content">
                                <h4 class="title">Keputusan Komite</h4>
                                <div class="text">{{ $data->keputusan_komite ?? '-' }}</div>
                                @if ($data->status == 'Disetujui')
                                    <button type="button" class="btn btn-success btn-sm square mt-1">DISETUJUI</button>
                                @elseif ($data->status == 'Ditolak')
                                    <button type="button" class="btn btn-danger btn-sm square mt-1">DITOLAK</button>
                                @elseif ($data->status == 'Dibatalkan')
                                    <button type="button" class="btn btn-warning btn-sm square mt-1">DIBATALKAN</button>
                                @endif
                                {{-- <button type="button" class="btn btn-danger btn-sm square mt-1">DIBATALKAN</button>
                            <button type="button" class="btn btn-danger btn-sm square mt-1">DITOLAK</button> --}}
                            </div>
                        </div>

                        <div class="item">
                            <div class="dot bg-success"></div>
                            <div class="content">
                                <h4 class="title">Akad Kredit</h4>
                                <div class="text">{{ $data->akad_kredit ?? '-' }}</div>
                            </div>
                        </div>

                        <div class="item">
                            <div class="dot bg-success"></div>
                            <div class="content">
                                <h4 class="title">Pencairan Dana</h4>
                                <div class="text">{{ $data->pencairan_dana ?? '-' }}</div>
                            </div>
                        </div>

                        <div class="item">
                            <div class="dot bg-success"></div>
                            <div class="content">
                                <h4 class="title">Selesai</h4>
                                <div class="text">{{ $data->selesai ?? '-' }}</div>
                            </div>
                        </div>
                    </div>
                    <!-- * timeline -->
                </div>
                <!-- * timeline -->
            </div>
        </div>
    </div>
    <!-- * App Capsule -->
@endsection
