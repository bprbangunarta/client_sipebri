@extends('theme.app')
@section('title', 'SURVEY RSC')

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
        <form class="search-form" action="" method="GET">
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

        <ul class="listview image-listview">
            @forelse ($data as $item)
                <li>
                    <a href="{{ route('survey.edit.rsc', ['survei' => $item->kd_pengajuan, 'rsc' => $item->kd_rsc, 'status_rsc' => $item->status_rsc]) }}"
                        class="item">
                        <div class="icon-box bg-primary">
                            <ion-icon name="person-circle-outline" role="img" class="md hydrated"></ion-icon>
                        </div>
                        <div class="in">
                            <div style="text-transform: uppercase;">
                                {{ $item->nama_nasabah }}
                                {{-- <footer>{{ $item->surveyor }}</footer> --}}
                            </div>
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
                            <div>
                                TIDAK ADA DATA
                            </div>
                        </div>
                    </a>
                </li>
            @endforelse
        </ul>

    </div>
    <!-- * App Capsule -->
@endsection
