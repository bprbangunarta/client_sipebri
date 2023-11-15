<!-- App Bottom Menu -->
<div class="appBottomMenu">
    <a href="/dashboard" class="item {{ request()->is('dashboard') ? 'active' : '' }}">
        <div class="col">
            <ion-icon name="home-outline"></ion-icon>
            <strong>Home</strong>
        </div>
    </a>

    <a href="/survey" class="item {{ request()->is('survey', 'survey/edit') ? 'active' : '' }}">
        <div class="col">
            <ion-icon name="pie-chart-outline"></ion-icon>
            <strong>Survey</strong>
        </div>
    </a>

    <a href="/tracking" class="item {{ request()->is('tracking', 'tracking/detail') ? 'active' : '' }}">
        <div class="col">
            <ion-icon name="file-tray-full-outline"></ion-icon>
            <strong>Tracking</strong>
        </div>
    </a>
    
    <a href="/setting" class="item {{ request()->is('setting') ? 'active' : '' }}">
        <div class="col">
            <ion-icon name="settings-outline"></ion-icon>
            <strong>Setting</strong>
        </div>
    </a>
</div>
<!-- * App Bottom Menu -->

<!-- App Bottom Menu -->
{{-- <div class="appBottomMenu">
    <a href="index.html" class="item">
        <div class="col">
            <ion-icon name="home-outline"></ion-icon>
        </div>
    </a>
    <a href="app-components.html" class="item">
        <div class="col">
            <ion-icon name="cube-outline"></ion-icon>
        </div>
    </a>
    <a href="page-chat.html" class="item">
        <div class="col">
            <ion-icon name="chatbubble-ellipses-outline"></ion-icon>
            <span class="badge badge-danger">5</span>
        </div>
    </a>
    <a href="app-pages.html" class="item">
        <div class="col">
            <ion-icon name="layers-outline"></ion-icon>
        </div>
    </a>
    <a href="javascript:;" class="item" data-toggle="modal" data-target="#sidebarPanel">
        <div class="col">
            <ion-icon name="menu-outline"></ion-icon>
        </div>
    </a>
</div> --}}
<!-- * App Bottom Menu -->