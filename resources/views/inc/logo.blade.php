<div class="d-flex align-items-center justify-content-between w-100 px-3 py-3">
    <a class="navbar-brand mb-lg-0" href="{{ route('dashboard') }}">
        <span class="fw-semibold" style="font-size: 20px;">
            {{ auth()->user()->company->name ?? 'Pas de salon' }}
        </span>
    </a>
    <span class="icon-edit-company" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#appModal">
        <x-icon_edit />
    </span>
</div>
