@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card border-0">
                <div class="card-body">
                    <header class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h5 class="h5 mb-1">Staff</h5>
                            <p class="text-muted fw-light mb-0">Manage your restaurant team.</p>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('staff.function') }}" class="btn btn-outline-secondary btn-sm">
                                Manage roles
                            </a>
                            <a href="{{ route('staff.create') }}" class="btn btn-primary">
                                <svg viewBox="0 0 24 24" width="1rem" height="1rem"><path fill="currentColor" d="M11 13H5v-2h6V5h2v6h6v2h-6v6h-2z"/></svg>
                                New staff member
                            </a>
                        </div>
                    </header>

                    <form method="GET" action="{{ route('staff.index') }}" class="row g-2 mb-4">
                        <div class="col-md-5">
                            <input type="search" name="search" class="form-control" placeholder="Name, email…"
                                value="{{ request('search') }}">
                        </div>
                            <div class="col-md-2">
                            <button type="submit" class="btn btn-secondary">Search</button>
                        </div>
                    </form>

                    @if($staff->count() > 0)
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>Staff</th>
                                        <th>Role</th>
                                        <th>Contact</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($staff as $member)
                                        <tr id="staff-{{ $member->id }}">
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <img src="{{ $member->avatar_url }}" width="36" height="36"
                                                        class="rounded-circle object-fit-cover" alt="">
                                                    <div>
                                                        <strong>{{ $member->fullName }}</strong>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if($member->function)
                                                    <span class="badge" style="background:{{ $member->function->color }}">
                                                        {{ $member->function->name }}
                                                    </span>
                                                @else
                                                    <span class="text-muted">—</span>
                                                @endif
                                            </td>
                                            <td class="text-muted small">
                                                {{ $member->phone ?: '—' }}<br>{{ $member->email ?: '' }}
                                            </td>
                                            <td>
                                                    <span class="badge bg-{{ $member->is_active ? 'success' : 'secondary' }}">
                                                    {{ $member->is_active ? 'Active' : 'Inactive' }}
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
                                                                href="{{ route('staff.edit', $member) }}">
                                                                Edit
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <form action="{{ route('staff.destroy', $member) }}"
                                                                method="POST"
                                                                onsubmit="return confirm('Delete {{ addslashes($member->fullName) }}?')">
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
                            {{ $staff->links() }}
                        </div>
                    @else
                        <div class="text-center py-5 text-muted">
                            <x-icon_staff />
                            <p class="mt-2">No staff found.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
