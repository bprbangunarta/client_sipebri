@extends('theme.app')
@section('title', 'Tracking')

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
    <ul class="listview image-listview inset mt-2 mb-2">
        <li>
            <a href="/tracking/detail" class="item">
                <div class="icon-box bg-primary">
                    <ion-icon name="person-circle-outline" role="img" class="md hydrated"></ion-icon>
                </div>
                <div class="in">
                    <div>
                        RISMA SRI WINDIANI PUTRI
                        <footer>Survey & Analisa</footer>
                    </div>
                </div>
            </a>
        </li>
        <li>
            <a href="/tracking/detail" class="item">
                <div class="icon-box bg-primary">
                    <ion-icon name="person-circle-outline" role="img" class="md hydrated"></ion-icon>
                </div>
                <div class="in">
                    <div>
                        IRNA DELIA NOVIANTI
                        <footer>Verifikasi Data</footer>
                    </div>
                </div>
            </a>
        </li>
    </ul>
</div>
<!-- * App Capsule -->
@endsection