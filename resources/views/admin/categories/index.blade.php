@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-lg-10">
            <div class="card border-0">
                <div class="card-body">
                    <header class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h5 class="h5 mb-1">Cuisine categories</h5>
                            <p class="text-muted fw-light mb-0">Manage cuisine types available on the platform.</p>
                        </div>
                        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                            <svg viewBox="0 0 24 24" width="1rem" height="1rem"><path fill="currentColor" d="M11 13H5v-2h6V5h2v6h6v2h-6v6h-2z"/></svg>
                            New category
                        </a>
                    </header>

                    <form method="GET" action="{{ route('admin.categories.index') }}" class="row g-2 mb-4">
                        <div class="col-md-4">
                            <input type="search" name="search" class="form-control" placeholder="Search…"
                                value="{{ request('search') }}">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-secondary">Search</button>
                        </div>
                    </form>

                    @if($categories->count() > 0)
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>Slug</th>
                                        <th>Restaurants</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $cat)
                                        <tr>
                                            <td>
                                                <span class="badge me-1" style="background:{{ $cat->color }}">
                                                    {{ $cat->icon }}
                                                </span>
                                                {{ $cat->name }}
                                            </td>
                                            <td class="text-muted small">{{ $cat->slug }}</td>
                                            <td>{{ $cat->locales_count }}</td>
                                            <td>
                                                <span class="badge bg-{{ $cat->is_active ? 'success' : 'secondary' }}">
                                                    {{ $cat->is_active ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown">
                                                        <x-icon_dots />
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="{{ route('admin.categories.edit', $cat) }}">
                                                                Edit
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <form action="{{ route('admin.categories.destroy', $cat) }}"
                                                                method="POST"
                                                                onsubmit="return confirm('Delete this category?')">
                                                                @csrf @method('DELETE')
                                                                <button type="submit" class="dropdown-item text-danger">Delete</button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end">
                            {{ $categories->links() }}
                        </div>
                    @else
                        <p class="text-muted text-center py-4">No categories created.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
