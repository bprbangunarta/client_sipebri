@extends('theme.app')
@section('title', 'Dashboard')

@section('content')
 <!-- App Header -->
 <div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="#" class="headerButton" data-bs-toggle="modal" data-bs-target="#sidebarPanel">
            <ion-icon name="menu-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">SIPEBRI</div>
    <div class="right">
        <a href="/survey" class="headerButton">
            <ion-icon class="icon" name="notifications-outline"></ion-icon>
            <span class="badge badge-danger">4</span>
        </a>
    </div>
</div>
<!-- * App Header -->

<!-- App Capsule -->
<div id="appCapsule">

    <!-- Wallet Card -->
    <div class="section wallet-card-section pt-1">
        <div class="wallet-card">
            <!-- Balance -->
            <div class="balance">
                <div class="left">
                    <span class="title">Permohonan Kredit</span>
                    <h1 class="total">110.000.000</h1>
                </div>
                <div class="right">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="#" class="button" onclick="event.preventDefault(); this.closest('form').submit();">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </a>
                    </form>
                </div>
            </div>
            <!-- * Balance -->
        </div>
    </div>
    <!-- Wallet Card -->

    <!-- Stats -->
    <div class="section">
        <div class="row mt-2">
            <div class="col-6">
                <div class="stat-box">
                    <div class="title">Analisa</div>
                    <div class="value text-primary">95 USER</div>
                </div>
            </div>
            <div class="col-6">
                <div class="stat-box">
                    <div class="title">Disetujui</div>
                    <div class="value text-success">45 USER</div>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-6">
                <div class="stat-box">
                    <div class="title">Ditolak</div>
                    <div class="value text-danger">25 USER</div>
                </div>
            </div>
            <div class="col-6">
                <div class="stat-box">
                    <div class="title">Dibatalkan</div>
                    <div class="value" style="color:grey;">99 USER</div>
                </div>
            </div>
        </div>
    </div>
    <!-- * Stats -->

    <!-- Transactions -->
    <div class="section mt-4 mb-2">
        <div class="section-heading">
            <h2 class="title">Realisasi</h2>
            <a href="app-transactions.html" class="link">View All</a>
        </div>
        <div class="transactions">
            <a href="app-transaction-detail.html" class="item">
                <div class="detail">
                    <img src="theme/img/sample/avatar/avatar4.jpg" alt="img" class="image-block imaged w48">
                    <div>
                        <strong>RIANA HEINAWATI RIYANTO</strong>
                        <p>Rp. 45.000.000</p>
                    </div>
                </div>
            </a>

            <a href="app-transaction-detail.html" class="item">
                <div class="detail">
                    <img src="theme/img/sample/brand/2.jpg" alt="img" class="image-block imaged w48">
                    <div>
                        <strong>DEDEN AHMAD SETIAWAN</strong>
                        <p>Rp. 10.000.000</p>
                    </div>
                </div>
            </a>
            
            <a href="app-transaction-detail.html" class="item">
                <div class="detail">
                    <img src="theme/img/sample/brand/2.jpg" alt="img" class="image-block imaged w48">
                    <div>
                        <strong>SITI NURLIA OKTAVERA</strong>
                        <p>Rp. 55.000.000</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <!-- * Transactions -->

    <!-- app footer -->
    <div class="appFooter">
        <div class="footer-title">
            SIPEBRI V1.0
        </div>
        PT. BPR BANGUNARTA
    </div>
    <!-- * app footer -->

</div>
<!-- * App Capsule -->
@endsection