@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-lg-8">
            <div class="card border-0">
                <div class="card-body">
                    <header class="d-flex justify-content-between align-items-start mb-4">
                        <div>
                            <h5 class="h5 mb-1">Staff roles</h5>
                            <p class="text-muted fw-light mb-0">Define roles for your team.</p>
                        </div>
                        <a href="{{ route('staff.function.create') }}" class="btn btn-primary">
                            <svg viewBox="0 0 24 24" width="1rem" height="1rem"><path fill="currentColor" d="M11 13H5v-2h6V5h2v6h6v2h-6v6h-2z"/></svg>
                            New role
                        </a>
                    </header>

                    <a href="{{ route('staff.index') }}" class="btn btn-sm btn-outline-secondary mb-3">
                        ← Back to staff
                    </a>

                    @if($functions->count() > 0)
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>Fonction</th>
                                        <th>Collaborateurs</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($functions as $fn)
                                        <tr>
                                            <td> 
                                                <span class="badge me-2" style="background:{{ $fn->color }}">&nbsp;</span>
                                                {{ $fn->name }}
                                            </td>
                                            <td>{{ $fn->staff_count }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown">
                                                        <x-icon_dots />
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="{{ route('staff.function.edit', $fn) }}">
                                                                Edit
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <form action="{{ route('staff.function.destroy', $fn) }}" method="POST"
                                                                onsubmit="return confirm('Delete this role?')">
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
                    @else
                        <p class="text-muted text-center py-4">No roles defined.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
