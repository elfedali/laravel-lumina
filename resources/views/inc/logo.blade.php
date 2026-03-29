<div class="d-flex align-items-center justify-content-between w-100 px-3 py-3">
    <a class="navbar-brand mb-lg-0" href="{{ route('dashboard') }}">

        @if (auth()->user()->company?->logo)
            <img src="{{ auth()->user()->company->logoUrl }}" alt="" class="img-fluid rounded-circle"
                style="width: 60px; height:auto;">
        @else
            <span class="fw-semibold" style="font-size: 20px;">
                {{ auth()->user()->company?->name ?? 'Pas de salon' }}
            </span>
        @endif
    </a>
    <a class="btn btn-link p-0" href="{{ route('settings.company.edit') }}">
        <x-icon_edit />
    </a>
</div>
