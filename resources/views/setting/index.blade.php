@extends('theme.app')
@section('title', 'Setting')

@section('content')
 <!-- App Header -->
 <div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="#" class="headerButton" data-bs-toggle="modal" data-bs-target="#sidebarPanel">
            <ion-icon name="menu-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">SETTING</div>
    <div class="right">
        <a href="/survey" class="headerButton">
            <ion-icon class="icon" name="notifications-outline"></ion-icon>
            <span class="badge badge-danger">4</span>
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

    <div class="section mt-3 text-center">
        <div class="avatar-section">
            <a href="#">
                <img src="assets/img/sample/avatar/avatar1.jpg" alt="avatar" class="imaged w100 rounded">
            </a>
        </div>
    </div>

    <div class="listview-title mt-1">Theme</div>
    <ul class="listview image-listview text inset">
        <li>
            <div class="item">
                <div class="in">
                    <div>
                        Dark Mode
                    </div>
                    <div class="form-check form-switch  ms-2">
                        <input class="form-check-input dark-mode-switch" type="checkbox" id="darkmodeSwitch">
                        <label class="form-check-label" for="darkmodeSwitch"></label>
                    </div>
                </div>
            </div>
        </li>
    </ul>

    
    <div class="listview-title mt-1">Profile</div>
    <div class="section mb-2">
        <div class="card">
            <div class="card-body">
                <form>
                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <label class="label" for="select4b">NAMA</label>
                            <input type="text" class="form-control" name="name" placeholder="Nama Lengkap" value="{{ Auth::user()->name }}">
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>

                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <label class="label" for="select4b">PASSWORD</label>
                            <input type="password" autocomplete="off" class="form-control" name="password" placeholder="********">
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

</div>
<!-- * App Capsule -->
@endsection