@extends('layouts.app')
@section('content')

    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="mb-1">Locations</h4>
            <p class="text-muted mb-0 small">All branches of <strong>{{ auth()->user()->company?->name }}</strong></p>
        </div>
        <a href="{{ route('settings.locales.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg me-1"></i> Add location
        </a>
    </div>

    @if($locales->isEmpty())

        <div class="card border-0 shadow-sm">
            <div class="card-body text-center py-5">
                <i class="bi bi-geo-alt display-4 text-muted mb-3 d-block"></i>
                <h5>No locations yet</h5>
                <p class="text-muted mb-4">Add your first location to start managing bookings, staff, and your menu.</p>
                <a href="{{ route('settings.locales.create') }}" class="btn btn-primary px-4">Add first location</a>
            </div>
        </div>

    @else

        <div class="row g-3">
            @foreach($locales as $locale)
                @php $isActive = $locale->id == session(\App\Models\Locale::ACTIVE_LOCALE); @endphp
                <div class="col-md-6 col-xl-4">
                    <div class="card border-0 shadow-sm h-100 {{ $isActive ? 'border border-primary border-2' : '' }}">
                        <div class="card-body pb-2">

                            {{-- badges + actions --}}
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="d-flex gap-1">
                                    @if($locale->is_primary)
                                        <span class="badge text-bg-secondary">Primary</span>
                                    @endif
                                    @if($isActive)
                                        <span class="badge text-bg-primary">
                                            <i class="bi bi-check2-circle me-1"></i>Active
                                        </span>
                                    @endif
                                </div>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-three-dots"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('settings.locales.edit', $locale) }}">
                                                <i class="bi bi-pencil me-2"></i>Edit
                                            </a>
                                        </li>
                                        @if(!$locale->is_primary)
                                            <li>
                                                <form method="POST" action="{{ route('settings.locales.destroy', $locale) }}"
                                                      onsubmit="return confirm('Delete this location?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item text-danger" type="submit">
                                                        <i class="bi bi-trash me-2"></i>Delete
                                                    </button>
                                                </form>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>

                            {{-- address --}}
                            <p class="fw-semibold mb-1">{{ $locale->address }}</p>
                            <p class="text-muted small mb-1">
                                <i class="bi bi-geo me-1"></i>{{ $locale->neighborhood }}, {{ $locale->city }}
                            </p>
                            @if($locale->phone)
                                <p class="text-muted small mb-0">
                                    <i class="bi bi-telephone me-1"></i>{{ $locale->phone }}
                                </p>
                            @endif

                        </div>

                        <div class="card-footer bg-transparent border-0 pt-3 pb-3 px-3">
                            @if($isActive)
                                <button class="btn btn-primary btn-sm w-100" disabled>
                                    <i class="bi bi-check2-circle me-1"></i>Currently managing this location
                                </button>
                            @else
                                <a href="{{ route('locales.set-active', $locale) }}"
                                   class="btn btn-outline-primary btn-sm w-100">
                                    <i class="bi bi-arrow-repeat me-1"></i>Switch to this location
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    @endif

@endsection
