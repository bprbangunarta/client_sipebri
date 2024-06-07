<!-- App Sidebar -->
<div class="modal fade panelbox panelbox-left" id="sidebarPanel" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">

                <!-- profile box -->
                <div class="profileBox">
                    <div class="image-wrapper">
                        <img src="{{ asset('assets/img/favicon.png') }}" alt="image" class="imaged rounded">
                    </div>
                    <div class="in">
                        <strong class="text-uppercase">{{ Auth::user()->username }}</strong>
                        <div class="text-muted">
                            {{ Auth::user()->kantor_kode }} | {{ Auth::user()->code_user }} |
                            {{ Auth::user()->kode_surveyor }}
                        </div>
                    </div>
                    <a href="javascript:;" class="close-sidebar-button" data-dismiss="modal">
                        <ion-icon name="close"></ion-icon>
                    </a>
                </div>
                <!-- * profile box -->

                <ul class="listview flush transparent no-line image-listview mt-2">
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
                        <a href="/tracking" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="file-tray-full-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Tracking
                            </div>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- sidebar buttons -->
            <div class="sidebar-buttons">
                <a href="/setting" class="button bg-primary">
                    <ion-icon name="person-outline"></ion-icon>
                </a>

                <form method="POST" action="{{ route('logout') }}" style="width: 100%;">
                    @csrf
                    <a href="#" class="button bg-danger"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        <ion-icon name="log-out-outline"></ion-icon>
                    </a>
                </form>
            </div>
            <!-- * sidebar buttons -->
        </div>
    </div>
</div>
<!-- * App Sidebar -->
