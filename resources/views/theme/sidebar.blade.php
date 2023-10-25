<!-- App Sidebar -->
<div class="modal fade panelbox panelbox-left" id="sidebarPanel" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <!-- profile box -->
                <div class="profileBox pt-2 pb-2">
                    <div class="image-wrapper">
                        <img src="theme/img/sample/avatar/avatar1.jpg" alt="image" class="imaged  w36">
                    </div>
                    <div class="in">
                        <strong>{{ Auth::user()->name }}</strong>
                        <div class="text-muted">{{ Auth::user()->kantor_kode }} | {{ Auth::user()->code_user }} | {{ Auth::user()->kode_surveyor }}</div>
                    </div>
                    <a href="#" class="btn btn-link btn-icon sidebar-close" data-bs-dismiss="modal">
                        <ion-icon name="close-outline"></ion-icon>
                    </a>
                </div>
                <!-- * profile box -->

                <!-- menu -->
                <div class="listview-title">Menu</div>
                <ul class="listview flush transparent no-line image-listview">
                    <li>
                        <a href="/dashboard" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="home-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Home
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="/survey" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="pie-chart-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Survey
                            </div>
                        </a>
                    </li>
                    
                    <li>
                        <a href="/settings" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="settings-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Setting
                            </div>
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                        @csrf
                            <a href="#" class="item" onclick="event.preventDefault(); this.closest('form').submit();">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="log-out-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Signout
                                </div>
                            </a>
                        </form>
                    </li>
                </ul>
                <!-- * menu -->
            </div>
        </div>
    </div>
</div>
<!-- * App Sidebar -->