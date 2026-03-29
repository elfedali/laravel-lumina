<nav class="navbar navbar-expand-lg sticky-top p-lg-0 app-sidebar" data-bs-theme="dark" id="navigation">

    @include('inc/logo')


    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>


    @include('inc/dropdown')


    @if (session()->has(\App\Models\Locale::ACTIVE_LOCALE))
        @php
            $mainItems = [
                [
                    'label' => 'Dashboard',
                    'route' => route('dashboard'),
                    'active' => 'dashboard*',
                    'icon' => 'bi-speedometer2',
                ],
                [
                    'label' => 'Bookings',
                    'route' => route('booking.index'),
                    'active' => 'booking.*',
                    'icon' => 'bi-calendar-check',
                ],
                [
                    'label' => 'Menu',
                    'route' => route('service.index'),
                    'active' => 'service.*',
                    'icon' => 'bi-journal-richtext',
                ],
                [
                    'label' => 'Clients',
                    'route' => route('client.index'),
                    'active' => 'client.*',
                    'icon' => 'bi-people',
                ],
            ];

            $teamItems = [
                [
                    'label' => 'Staff',
                    'route' => route('staff.index'),
                    'active' => 'staff.index|staff.create|staff.edit',
                    'icon' => 'bi-person-badge',
                ],
                [
                    'label' => 'Roles',
                    'route' => route('staff.function'),
                    'active' => 'staff.function|staff.function.*',
                    'icon' => 'bi-diagram-3',
                ],
            ];
        @endphp

        <div class="collapse navbar-collapse flex-column" id="navbarSupportedContent">
            <ul class="navbar-nav w-100">
                @foreach ($mainItems as $item)
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs($item['active']) ? 'active' : '' }}"
                            href="{{ $item['route'] }}">
                            <i class="bi {{ $item['icon'] }} aside-icon" aria-hidden="true"></i>
                            <span>{{ $item['label'] }}</span>
                        </a>
                    </li>
                @endforeach

                <li class="nav-item">
                    <hr class="aside-divider">
                    <span class="aside-section-title">Team</span>
                    <ul class="aside-submenu list-unstyled mb-0">
                        @foreach ($teamItems as $item)
                            <li>
                                <a class="nav-link {{ Request::routeIs($item['active']) ? 'active' : '' }}"
                                    href="{{ $item['route'] }}">
                                    <i class="bi {{ $item['icon'] }} aside-icon" aria-hidden="true"></i>
                                    <span>{{ $item['label'] }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>
    @endif

</nav>
