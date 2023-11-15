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