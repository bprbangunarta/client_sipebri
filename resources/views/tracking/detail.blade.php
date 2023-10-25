@extends('theme.app')
@section('title', 'Detail')

@section('content')
 <!-- App Header -->
 <div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="#" class="headerButton" data-bs-toggle="modal" data-bs-target="#sidebarPanel">
            <ion-icon name="menu-outline"></ion-icon>
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
    <form class="search-form">
        <div class="form-group searchbox">
            <input type="text" class="form-control" placeholder="Search...">
            <i class="input-icon icon ion-ios-search"></i>
            <a href="javascript:;" class="ms-1 close toggle-searchbox"><i class="icon ion-ios-close-circle"></i></a>
        </div>
    </form>
</div>
<!-- * Search Component -->

<!-- App Capsule -->
<div id="appCapsule">
    <div class="section mt-2 mb-2">
        <div class="card">
            <!-- timeline -->
            <div class="timeline ms-3">

                <div class="item">
                    <div class="dot"></div>
                    <div class="content">
                        <h4 class="title">Verifikasi Data</h4>
                        <div class="text">2023-10-25 09:45:51</div>
                    </div>
                </div>

                <div class="item">
                    <div class="dot bg-warning"></div>
                    <div class="content">
                        <h4 class="title">Proses Survey</h4>
                        <div class="text">2023-10-25 09:45:51</div>
                    </div>
                </div>

                <div class="item">
                    <div class="dot bg-warning"></div>
                    <div class="content">
                        <h4 class="title">Proses Analisa</h4>
                        <div class="text">2023-10-25 09:45:51</div>
                    </div>
                </div>

                <div class="item">
                    <div class="dot bg-primary"></div>
                    <div class="content">
                        <h4 class="title">Keputusan Komite</h4>
                        <div class="text">2023-10-25 09:45:51</div>
                        <button type="button" class="btn btn-success btn-sm square mt-1">DISETUJUI</button>
                        {{-- <button type="button" class="btn btn-danger btn-sm square mt-1">DIBATALKAN</button>
                        <button type="button" class="btn btn-danger btn-sm square mt-1">DITOLAK</button> --}}
                    </div>
                </div>

                <div class="item">
                    <div class="dot bg-success"></div>
                    <div class="content">
                        <h4 class="title">Akad Kredit</h4>
                        <div class="text">2023-10-25 09:45:51</div>
                    </div>
                </div>

                <div class="item">
                    <div class="dot bg-success"></div>
                    <div class="content">
                        <h4 class="title">Pencairan Dana</h4>
                        <div class="text">2023-10-25 09:45:51</div>
                    </div>
                </div>

                <div class="item">
                    <div class="dot bg-success"></div>
                    <div class="content">
                        <h4 class="title">Selesai</h4>
                        <div class="text">2023-10-25 09:45:51</div>
                    </div>
                </div>

            </div>
            <!-- * timeline -->
        </div>
    </div>
</div>
<!-- * App Capsule -->
@endsection