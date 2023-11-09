@extends('theme.app')
@section('title', 'Survey')

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
                <input type="text" class="form-control" name="name" id="name" value="{{ request('name') }}" placeholder="Search...">
                <i class="input-icon icon ion-ios-search"></i>
                <a href="javascript:;" class="ms-1 close toggle-searchbox"><i class="icon ion-ios-close-circle"></i></a>
            </div>
        </form>
    </div>
    <!-- * Search Component -->

    <!-- App Capsule -->
    <div id="appCapsule">
        <ul class="listview image-listview inset mt-2 mb-2">
            @forelse ($data as $item)
                <li>
                    <a href="{{ route('survey.edit', ['survei' => $item->kd_pengajuan]) }}" class="item">
                        <div class="icon-box bg-primary">
                            <ion-icon name="person-circle-outline" role="img" class="md hydrated"></ion-icon>
                        </div>

                        <div class="in">
                            <div>{{ $item->nama_nasabah }}</div>
                            @if ($item->foto == null)
                                <span class="badge badge-danger badge-empty"></span>
                            @else
                                <span class="badge badge-success badge-empty"></span>
                            @endif

                        </div>
                    </a>
                </li>
            @empty
                <li>
                    <a href="#" class="item">
                        <div class="icon-box bg-primary">
                            <ion-icon name="person-circle-outline" role="img" class="md hydrated"></ion-icon>
                        </div>

                        <div class="in">
                            <div>TIDAK ADA DATA</div>
                        </div>
                    </a>
                </li>
            @endforelse
        </ul>
    </div>
    <!-- * App Capsule -->
@endsection
