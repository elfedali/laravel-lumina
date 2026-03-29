<nav class="navbar navbar-expand-lg sticky-top p-lg-0 app-sidebar" data-bs-theme="dark" id="navigation">

    @php
        $adminItems = [
            [
                'label' => 'Dashboard',
                'route' => route('dashboard'),
                'active' => 'dashboard*',
                'icon' => 'bi-speedometer2',
            ],
            [
                'label' => 'Clients',
                'route' => route('users.index'),
                'active' => 'users.*',
                'icon' => 'bi-people',
            ],
            [
                'label' => 'Restaurants',
                'route' => route('locales.index'),
                'active' => 'locales.*',
                'icon' => 'bi-shop',
            ],
            [
                'label' => 'Categories',
                'route' => route('admin.categories.index'),
                'active' => 'admin.categories.*',
                'icon' => 'bi-tags',
            ],
        ];
    @endphp

    <a class="navbar-brand ps-3 py-3 mb-1 d-flex align-items-center" href="{{ route('dashboard') }}">
        <span class="fw-bold fs-5">Lumina</span>
        <span class="sidebar-badge ms-2">Admin</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse flex-column" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            @foreach ($adminItems as $item)
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs($item['active']) ? 'active' : '' }}"
                        href="{{ $item['route'] }}">
                        <i class="bi {{ $item['icon'] }} aside-icon" aria-hidden="true"></i>
                        <span>{{ $item['label'] }}</span>
                    </a>
                </li>
            @endforeach

        </ul>
    </div>

</nav>
