<div class="col-lg-3">
    <div class="nav-sticky">
        <div class="card">
            <div class="card-header text-white bg-red opacity-75">
                SUB MENU
            </div>
            <div class="card-body">

                <ul class="nav flex-column" id="stickyNav">
                    <li class="nav-item {{ Route::is('evidence.index') ? 'active-link-nav' : '' }}"><a class="nav-link" href="{{route('evidence.index')}}">Evidence</a></li>
                    <li class="nav-item {{ Route::is('dokumentasi.index') ? 'active-link-nav' : '' }}"><a class="nav-link" href="{{route('dokumentasi.index')}}">Berita Acara</a></li>
                    <li class="nav-item"><a class="nav-link" href="#basic">Events</a></li>
                    <li class="nav-item"><a class="nav-link" href="#basic">Flyer</a></li>
                    <li class="nav-item"><a class="nav-link" href="#basic">Informasi</a></li>
                    <li class="nav-item"><a class="nav-link" href="#icon">Berita</a></li>
                    <li class="nav-item"><a class="nav-link" href="#icon">Microsite</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>