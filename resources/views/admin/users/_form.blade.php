<main>

    <!-- Informations sur le propriétaire -->
    <div class="card">
        <div class="card-body">
            <h6 class="mb-3 fw-semibold">{{ __('Informations sur le propriétaire.') }}</h6>
            <div class="row">
                <!-- Nom de famille -->
                <div class="col-lg mb-3">
                    <div class="form-floating">

                        <input type="text" name="lastname" id="lastname"
                            class="form-control @error('lastname') is-invalid @enderror"
                            placeholder="{{ __('Nom de la famille') }}"
                            value="{{ $user->lastname ?? old('lastname') }}">
                        <label for="lastname" class="form-label">{{ __('Nom de la famille') }} <span
                                class="text-danger">*</span></label>
                        @error('lastname')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Prénom -->
                <div class="col-lg mb-3">
                    <div class="form-floating">

                        <input type="text" name="firstname" id="firstname"
                            class="form-control @error('firstname') is-invalid @enderror"
                            placeholder="{{ __('Prénom') }}" value="{{ $user->firstname ?? old('firstname') }}">
                        <label for="firstname" class="form-label">{{ __('Prénom') }} <span
                                class="text-danger">*</span></label>
                        @error('firstname')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Téléphone -->
                <div class=" col-lg mb-3">
                    <div class="form-floating">

                        <input type="text" name="phone" id="phone"
                            class="form-control @error('phone') is-invalid @enderror"
                            placeholder="{{ __('Téléphone') }}" value="{{ $user->phone ?? old('phone') }}">
                        <label for="phone" class="form-label">{{ __('Téléphone') }} <span
                                class="text-danger">*</span></label>
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Email -->
                <div class=" col-lg mb-3">
                    <div class="form-floating">

                        <input type="email" name="email" id="email"
                            class="form-control @error('email') is-invalid @enderror"
                            placeholder="{{ __('Adresse e-mail') }}" value="{{ $user->email ?? old('email') }}"
                            @if ($isEdit) disabled @endif autocomplete="off">
                        <label for="email" class="form-label">{{ __('Adresse e-mail') }} <span
                                class="text-danger">*</span></label>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Mot de passe -->
                <div class=" col-lg mb-3">
                    <div class="form-floating">

                        <input type="text" name="password" id="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="{{ __('Mot de passe') }}" autocomplete="off"
                            @if ($isEdit) disabled @endif>
                        <label for="password" class="form-label">{{ __('Mot de passe') }} <span
                                class="text-danger">*</span></label>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

            </div>
        </div>
    </div>

    <!-- Informations sur le salon -->
    <div class="card mt-4">
        <div class="card-body">
            <h6>{{ __('Informations sur le salon.') }}</h6>
            <div class="row">
                <!-- Nom du salon -->
                <div class=" col-lg mb-3">
                    <div class="form-floating">
                        <input type="text" name="company[name]" id="company_name"
                            class="form-control @error('company.name') is-invalid @enderror"
                            placeholder="{{ __('Nom du salon') }}"
                            value="{{ old('company.name', $user->company->name ?? '') }}">
                        <label for="company_name" class="form-label">{{ __('Nom du salon') }} <span
                                class="text-danger">*</span></label>
                        @error('company.name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- /.form-floating -->

                </div>

                <!-- Catégorie du salon -->
                <div class=" col-lg mb-3">
                    <div class="form-floating">

                        <input type="text" name="company[category]" id="company_category"
                            class="form-control @error('company.category') is-invalid @enderror"
                            placeholder="{{ __('Catégorie du salon') }}"
                            value="{{ old('company.category', $user->company->category ?? '') }}">
                        <label for="company_category" class="form-label">{{ __('Catégorie du salon') }} <span
                                class="text-danger">*</span></label>
                        @error('company.category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- /.form-floating -->
                </div>
            </div>


            <div class="row">
                <div class="form-floating col-lg mb-3">
                    <div class="border p-3 rounded">
                        <div class="d-flex justify-content-between align-items-center">

                            <input type="file" name="company[logo]" id="logo" class="d-none"
                                accept="image/png, image/jpeg, image/jpg">

                            <div>

                                <h6 class="m-0">

                                    {{ __('Logo du salon') }}
                                </h6>
                                @if (isset($user) and $user->company?->logo)
                                    <div class="mt-2">
                                        <img src="{{ $user->company?->logoURL }}" alt="logo" class="rounded"
                                            height="50">
                                    </div>
                                @endif

                                @if (!$isEdit or !$user->company?->logo)
                                    <p class="text-muted m-0">
                                        <small id="logo_name">
                                            {{ __('Aucun logo n\'est importé') }}
                                        </small>
                                    </p>
                                @endif
                            </div>
                            <div>
                                <a href="#" id="link_upload_logo" class="btn btn-sm btn-outline-dark">
                                    <svg width="1.1rem" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 24 24">
                                        <g fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-2"></path>
                                            <path d="M7 9l5-5l5 5"></path>
                                            <path d="M12 4v12"></path>
                                        </g>
                                    </svg>

                                    {{ __('Importer un logo') }}
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="text-end">
        <button type="submit" class="btn btn-primary mt-3">
            {{ $isEdit ? __('Modifier le client') : __('Ajouter le client') }}
        </button>
    </div>
</main>



@section('scripts')
    <script>
        // onload
        window.addEventListener('load', function() {
            // upload logo
            document.getElementById('logo').addEventListener('change', function() {
                var fileName = this.files[0].name;
                document.getElementById('logo_name').textContent = fileName;
            });

            // upload logo
            document.getElementById('link_upload_logo').addEventListener('click', function(event) {
                event.preventDefault();
                document.getElementById('logo').click();
            });
        });
    </script>
@endsection

{{-- @if (!$isEdit)
<script>
    window.addEventListener('load', function() {
        setTimeout(() => {
            document.getElementById('email').value = '';
            document.getElementById('password').value = '';
        }, 500);
    });
</script>
@endif --}}
