@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card border-0">
                <div class="card-body">
                    <header class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h5 class="h5 mb-1">Menu &amp; Services</h5>
                            <p class="text-muted fw-light mb-0">Manage the menu items for your restaurant.</p>
                        </div>
                        <div class="d-flex gap-2">
                            <button class="btn btn-outline-secondary btn-sm" id="btnToggleAddSection">
                                + Add section
                            </button>
                            <a href="{{ route('service.create') }}" class="btn btn-primary">
                                <svg viewBox="0 0 24 24" width="1rem" height="1rem"><path fill="currentColor" d="M11 13H5v-2h6V5h2v6h6v2h-6v6h-2z"/></svg>
                                New item
                            </a>
                        </div>
                    </header>

                    {{-- Search --}}
                    <form method="GET" action="{{ route('service.index') }}" class="row g-2 mb-4">
                        <div class="col-md-5">
                            <input type="search" name="search" class="form-control" placeholder="Search items…"
                                value="{{ $search ?? '' }}">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-secondary">Search</button>
                        </div>
                    </form>

                    {{-- Section tabs --}}
                    @if($sections->count() > 0 || $unsectionedItems->count() > 0)
                        <ul class="nav nav-tabs mb-4" id="menuTabs" role="tablist">
                            @foreach($sections as $section)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link {{ $loop->first && !$activeSection ? 'active' : ($activeSection && $activeSection->id === $section->id ? 'active' : '') }}"
                                        data-bs-toggle="tab"
                                        data-bs-target="#section-{{ $section->id }}"
                                        type="button">
                                        {{ $section->name }}
                                        <span class="badge bg-secondary ms-1">{{ $section->menuItems->count() }}</span>
                                    </button>
                                </li>
                            @endforeach
                            @if($unsectionedItems->count() > 0)
                                <li class="nav-item" role="presentation">
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#section-unsectioned" type="button">
                                        No section
                                        <span class="badge bg-secondary ms-1">{{ $unsectionedItems->count() }}</span>
                                    </button>
                                </li>
                            @endif
                        </ul>

                        <div class="tab-content" id="menuTabsContent">
                            @foreach($sections as $section)
                                <div class="tab-pane fade {{ $loop->first && !$activeSection ? 'show active' : ($activeSection && $activeSection->id === $section->id ? 'show active' : '') }}"
                                    id="section-{{ $section->id }}">

                                    <div class="d-flex justify-content-end mb-2">
                                        <button class="btn btn-sm btn-outline-danger btn-delete-section"
                                            data-id="{{ $section->id }}"
                                            data-name="{{ $section->name }}"
                                            title="Delete this section">
                                            <x-icon_trash />
                                        </button>
                                    </div>

                                    @include('service._items_table', ['items' => $section->menuItems, 'sectionId' => $section->id])
                                </div>
                            @endforeach

                            @if($unsectionedItems->count() > 0)
                                <div class="tab-pane fade" id="section-unsectioned">
                                    @include('service._items_table', ['items' => $unsectionedItems, 'sectionId' => null])
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="text-center py-5 text-muted">
                            <x-icon_service />
                            <p class="mt-2">No items in the menu. Start by adding a section, then items.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Inline add-section form --}}
<div id="addSectionPanel" class="container-fluid d-none mt-2">
    <div class="row">
        <div class="col-lg-4">
            <div class="card border-0 bg-light">
                <div class="card-body py-3">
                    <form action="{{ route('menu.sections.store') }}" method="POST" class="d-flex gap-2 align-items-end">
                        @csrf
                        <div class="flex-grow-1">
                            <label class="form-label small mb-1">Section name</label>
                            <input type="text" name="name" class="form-control form-control-sm" required
                                placeholder="Ex: Starters, Main courses, Desserts…">
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Créer</button>
                        <button type="button" class="btn btn-outline-secondary btn-sm" id="btnCancelAddSection">✕</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
const sectionPanel = document.getElementById('addSectionPanel');

document.getElementById('btnToggleAddSection').addEventListener('click', function() {
    sectionPanel.classList.toggle('d-none');
    if (!sectionPanel.classList.contains('d-none')) {
        sectionPanel.querySelector('[name="name"]').focus();
    }
});

document.getElementById('btnCancelAddSection').addEventListener('click', function() {
    sectionPanel.classList.add('d-none');
});

        document.querySelectorAll('.btn-delete-section').forEach(function(btn) {
    btn.addEventListener('click', function() {
        if (confirm('Delete the section "' + this.dataset.name + '"? Items will remain uncategorized.')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/menu-sections/' + this.dataset.id;
            form.innerHTML = '@csrf @method("DELETE")'.replace('@csrf', '<input type="hidden" name="_token" value="{{ csrf_token() }}">').replace('@method("DELETE")', '<input type="hidden" name="_method" value="DELETE">');
            document.body.appendChild(form);
            form.submit();
        }
    });
});
</script>
@endsection

