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
    <div class="section mt-2">
        <div class="card">
            <div class="card-body">
                <form>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <input type="text" class="form-control" style="margin-top:-15px;" value="ZULFADLI RIZAL" readonly>
                            <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                        </div>
                    </div>

                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <textarea class="form-control" style="margin-top:-15px;" rows="3" readonly>KAMPUNG KASOMALANG KULON RT. 01/03 DS. KASOMALANG KULON - KASOMALANG - SUBANG</textarea>
                            <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                        </div>
                    </div>

                    <div class="form-group basic mt-1">
                        <div class="input-wrapper">
                            <input type="text" class="form-control" style="margin-top:-25px;" value="-6.2863024,107.8202125" readonly>
                            <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                        </div>
                    </div>

                    <div class="accordion" id="survey_foto">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#foto_survey" style="font-size: 12px;margin-left:-15px;">
                                    <b>FOTO SURVEY</b>
                                </button>
                            </h2>
                            <div id="foto_survey" class="accordion-collapse collapse mb-1" data-bs-parent="#survey_foto">
                                <img src="{{ asset('theme/img/sample/photo/3.jpg') }}" alt="image" class="imaged img-fluid">
                            </div>
                        </div>
                    </div>

                    <div class="custom-file-upload mt-1" id="fileUpload1">
                        <input type="file" id="fileuploadInput" accept=".png, .jpg, .jpeg">
                        <label for="fileuploadInput">
                            <span>
                                <strong>
                                    <ion-icon name="arrow-up-circle-outline"></ion-icon>
                                    <i>Upload a Photo</i>
                                </strong>
                            </span>
                        </label>
                    </div>

                    <button type="button" class="btn btn-primary btn-block mt-1">SIMPAN</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- * App Capsule -->
@endsection