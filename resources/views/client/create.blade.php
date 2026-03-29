@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mt-3 justify-content-center">
        <div class="col-lg-6">
            <div class="card border-0">
                <div class="card-body">
                    <header class="mb-4">
                        <a href="{{ route('client.index') }}" class="text-muted small d-inline-flex align-items-center gap-1 mb-2">
                            ← Back to clients
                        </a>
                        <h5 class="h5 mb-1">Add client</h5>
                        <p class="text-muted fw-light mb-0">Create a client record.</p>
                    </header>

                    <form action="{{ route('client.store') }}" method="POST">
                        @csrf
                        @include('client._from')
                        <div class="d-flex gap-2 mt-2">
                            <button type="submit" class="btn btn-primary">Add</button>
                            <a href="{{ route('client.index') }}" class="btn btn-outline-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
