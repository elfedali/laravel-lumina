<main>

    <!-- Informations sur le propriétaire -->
    <div class="card">
        <div class="card-body">
            <h6 class="mb-3 fw-semibold">{{ __('Informations sur le local') }}</h6>
            <div class="row">
                <!-- Address -->
                <div class="col-lg-12 mb-3">
                    <div class="form-floating">

                        <input type="text" name="address" id="address"
                            class="form-control @error('address') is-invalid @enderror" placeholder=""
                            value="{{ $user->address ?? old('Nom de la rue') }}">
                        <label for="address" class="form-label">{{ __('Addresse') }} <span
                                class="text-danger">*</span></label>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


            </div>

            <div class="row">
                <!-- Quartier -->
                <div class=" col-lg mb-3">
                    <div class="form-floating">

                        <input type="text" name="neighborhood" id="neighborhood"
                            class="form-control @error('neighborhood') is-invalid @enderror"
                            placeholder="{{ __('Quartier') }}" value="{{ $user->neighborhood ?? old('neighborhood') }}">
                        <label for="neighborhood" class="form-label">{{ __('Quartier') }} <span
                                class="text-danger">*</span></label>
                        @error('neighborhood')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Ville -->
                <div class="col-lg mb-3">
                    <div class="form-floating">

                        <input type="text" name="ville" id="ville"
                            class="form-control @error('ville') is-invalid @enderror" placeholder="{{ __('Prénom') }}"
                            value="{{ $user->ville ?? old('ville') }}">
                        <label for="ville" class="form-label">{{ __('Ville') }} <span
                                class="text-danger">*</span></label>
                        @error('ville')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- phone -->
                <div class=" col-lg mb-3">
                    <div class="form-floating">

                        <input type="tel" name="phone" id="phone"
                            class="form-control @error('phone') is-invalid @enderror"
                            placeholder=" value="{{ $user->phone ?? old('phone') }}">
                        <label for="phone" class="form-label">{{ __('Téléphone 1') }} <span
                                class="text-danger">*</span></label>
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- phone 1 -->
                <div class="col-lg mb-3">
                    <div class="form-floating">

                        <input type="tel" name="phone2" id="phone2"
                            class="form-control @error('phone2') is-invalid @enderror" placeholder=""
                            value="{{ $user->phone2 ?? old('phone2') }}">
                        <label for="phone2" class="form-label">{{ __('Téléphone 2') }} </label>
                        @error('phone2')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>


        </div>
    </div>


    <div class="text-end">
        <button type="submit" class="btn btn-primary mt-3">
            {{ $isEdit ? __('Modifier le local') : __('Ajouter le local') }}
        </button>
    </div>
</main>
