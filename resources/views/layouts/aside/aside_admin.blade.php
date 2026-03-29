<aside class="app-sidebar d-flex flex-column p-3" id="app-sidebar">

    {{-- Brand --}}
    <div class="mb-4 pb-3 border-bottom border-secondary-subtle">
        <a href="{{ route('dashboard') }}" class="d-flex align-items-center gap-2 text-decoration-none">
            <img src="{{ asset('assets/images/favicon.png') }}" alt="{{ config('app.name') }}"
                style="width:28px;height:28px;object-fit:contain;">
            <span class="text-white fw-semibold">{{ config('app.name') }}</span>
        </a>
    </div>

    <nav class="flex-grow-1 overflow-auto" aria-label="Admin navigation">
        <p class="sidebar-section-label">Admin</p>
        <ul class="nav nav-pills flex-column gap-1">
            @foreach([
                ['label' => 'Dashboard',   'route' => route('dashboard'),              'active' => 'dashboard*',         'icon' => 'bi-grid-1x2'],
                ['label' => 'Clients',     'route' => route('users.index'),            'active' => 'users.*',            'icon' => 'bi-people'],
                ['label' => 'Restaurants', 'route' => route('locales.index'),          'active' => 'locales.*',          'icon' => 'bi-shop'],
                ['label' => 'Categories',  'route' => route('admin.categories.index'), 'active' => 'admin.categories.*', 'icon' => 'bi-tags'],
            ] as $item)
                <li class="nav-item">
                    <a href="{{ $item['route'] }}"
                        class="nav-link d-flex align-items-center gap-2 {{ Request::routeIs($item['active']) ? 'active' : 'text-light' }}">
                        <i class="bi {{ $item['icon'] }}" aria-hidden="true"></i>
                        <span>{{ $item['label'] }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </nav>

    {{-- User zone (pinned bottom) --}}
    <div class="mt-auto pt-3 border-top border-secondary-subtle">
        <div class="d-flex align-items-center gap-2">
            <span class="rounded-circle bg-danger d-flex align-items-center justify-content-center text-white fw-bold flex-shrink-0"
                style="width:32px;height:32px;font-size:.8rem">
                {{ strtoupper(substr(Auth::user()->fullname ?? 'U', 0, 1)) }}
            </span>
            <div class="flex-grow-1 overflow-hidden lh-sm">
                <div class="text-white text-truncate" style="font-size:.85rem;font-weight:500">{{ Auth::user()->fullname }}</div>
                <div class="text-secondary" style="font-size:.7rem">Admin</div>
            </div>
            <form action="{{ route('logout') }}" method="POST" class="ms-auto">
                @csrf
                <button type="submit" class="btn btn-sm btn-link text-secondary p-1" title="Sign out">
                    <i class="bi bi-box-arrow-right fs-6"></i>
                </button>
            </form>
        </div>
    </div>

</aside>
