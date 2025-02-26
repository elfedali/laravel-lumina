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
    <button class="btn btn-link p-0" id="btnEditCompany" data-id="{{ auth()->user()->company?->id }}"
        data-name="{{ auth()->user()->company?->name }}" data-category="{{ auth()->user()->company?->category }}"
        data-logo="{{ auth()->user()->company?->logo ?? null }}">
        <x-icon_edit />
    </button>
</div>
