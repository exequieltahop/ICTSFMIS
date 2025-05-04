<aside class="p-2 h-100 bg-light d-none d-lg-block">
    <h5 class="m-0 text-center">ICTS FMIS</h5>
    <hr>
    <nav>
        <ul class="nav d-flex flex-column" style="row-gap: 1em;">
            <li class="nav-item {{ Route::currentRouteName() == 'dashboard' ? 'shadow-lg rounded bg-primary' : ''}} ">
                <a href="{{route('dashboard')}}" class="nav-link text-nowrap text-dark fw-bold {{ Route::currentRouteName() == 'dashboard' ? 'text-link-primary' : ''}}">
                    <i class="bi bi-speedometer" style="font-style: normal; letter-spacing: 2px;"> DASHBOARD </i>
                </a>
            </li>
            <li class="nav-item {{ Route::currentRouteName() == 'users' ? 'shadow-lg rounded bg-primary' : ''}}">
                <a href="{{route('users')}}" class="nav-link text-nowrap text-dark fw-bold {{ Route::currentRouteName() == 'users' ? 'text-link-primary' : ''}}">
                    <i class="bi bi-person-circle" style="font-style: normal; letter-spacing: 2px;"> USERS </i>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('logout')}}" class="nav-link text-nowrap text-dark fw-bold">
                    <i class="bi bi-box-arrow-left" style="font-style: normal; letter-spacing: 2px;"> LOG OUT </i>
                </a>
            </li>
        </ul>
    </nav>
</aside>

<div class="offcanvas offcanvas-start bg-light" tabindex="-1" id="hidden-menu" data-bs-backdrop="static">
    <div class="offcanvas-header">
        <h5 class="m-0 text-center">ICTS FMIS</h5>
        <button class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>

    <div class="offcanvas-body">
        <nav>
            <ul class="nav d-flex flex-column" style="row-gap: 1em;">
                <li class="nav-item {{ Route::currentRouteName() == 'dashboard' ? 'shadow-lg rounded bg-primary' : ''}} ">
                    <a href="{{route('dashboard')}}" class="nav-link text-nowrap text-dark fw-bold {{ Route::currentRouteName() == 'dashboard' ? 'text-link-primary' : ''}}">
                        <i class="bi bi-speedometer" style="font-style: normal; letter-spacing: 2px;"> DASHBOARD </i>
                    </a>
                </li>
                <li class="nav-item {{ Route::currentRouteName() == 'users' ? 'shadow-lg rounded bg-primary' : ''}}">
                    <a href="{{route('users')}}" class="nav-link text-nowrap text-dark fw-bold {{ Route::currentRouteName() == 'users' ? 'text-link-primary' : ''}}">
                        <i class="bi bi-person-circle" style="font-style: normal; letter-spacing: 2px;"> USERS </i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('logout')}}" class="nav-link text-nowrap text-dark fw-bold">
                        <i class="bi bi-box-arrow-left" style="font-style: normal; letter-spacing: 2px;"> LOG OUT </i>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>