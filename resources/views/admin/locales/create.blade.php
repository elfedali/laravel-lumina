@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <header>
                    <a href={{ route('locales.index') }} class="text-decoration-none d-flex align-items-center">
                        <svg width=".6rem" viewBox="0 0 12 24">
                            <path fill="currentColor" fill-rule="evenodd"
                                d="m3.343 12l7.071 7.071L9 20.485l-7.778-7.778a1 1 0 0 1 0-1.414L9 3.515l1.414 1.414z" />
                        </svg>
                        <span class="ms-2">
                            {{ __('Retour') }}
                        </span>
                    </a>
                    <div class="mt-4">
                        <h1 class="h5 mb-3 fw-semibold">
                            {{ __('Ajouter un local') }}
                        </h1>
                    </div>
                </header>

                <form action="{{ route('locales.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @include('admin.locales._form', ['isEdit' => false])
                </form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
@endsection
