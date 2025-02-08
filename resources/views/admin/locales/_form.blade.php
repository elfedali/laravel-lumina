<main>

    <!-- Informations sur le propriétaire -->

    <div class="card">
        <div class="card-body">
            <h6 class="mb-3 fw-semibold">{{ __('Informations sur le local') }}</h6>

            @php
                $companies = \App\Models\Company::pluck('name', 'id');
            @endphp

            <div class="row">
                <div class="col-lg mb-4">
                    <div class="form-floating">
                        <select name="company_id" id="company_id" @if ($isEdit) disabled @endif
                            class="form-select @error('company_id') is-invalid @enderror">
                            <option value="">{{ __('Sélectionner une entreprise') }}</option>
                            @foreach ($companies as $id => $name)
                                <option value="{{ $id }}" @if (isset($locale) && $id == $locale->company_id ?? null) selected @endif>
                                    {{ $name }}</option>
                            @endforeach
                        </select>
                        <label for="company_id" class="form-label">{{ __('Le salon') }} <span
                                class="text-danger">*</span></label>
                        @error('company_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- /.col-lg -->
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <!-- Address -->
                <div class="col-lg-12 mb-3">
                    <div class="form-floating">

                        <input type="text" name="address" id="address"
                            class="form-control @error('address') is-invalid @enderror" placeholder=""
                            value="{{ $locale->address ?? old('Nom de la rue') }}">
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
                            placeholder="{{ __('Quartier') }}"
                            value="{{ $locale->neighborhood ?? old('neighborhood') }}">
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

                        <input type="text" name="city" id="city"
                            class="form-control @error('city') is-invalid @enderror" placeholder=""
                            value="{{ $locale->city ?? old('city') }}">
                        <label for="ville" class="form-label">
                            Ville
                            <span class="text-danger">*</span>
                        </label>
                        @error('city')
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
                            class="form-control @error('phone') is-invalid @enderror" placeholder=""
                            value="{{ $locale->phone ?? old('phone') }}">
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
                            value="{{ $locale->phone2 ?? old('phone2') }}">
                        <label for="phone2" class="form-label">{{ __('Téléphone 2') }} </label>
                        @error('phone2')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <hr>
            <div class="row">
                <div class="col-lg">
                    <x-horaires :hours="$locale->hours ?? null" />
                </div>
            </div>

        </div>
    </div>


    <div class="d-flex justify-content-between mt-4">
        @if ($isEdit)
            <div>
                <a href="#" class="btn btn-outline-danger"
                    onclick="
event.preventDefault();
if(confirm('Voulez-vous vraiment supprimer ce local?')){
document.getElementById('delete-form').submit()
}">
                    {{ __('Supprimer') }}
                </a>
            </div>
        @endif
        <button type="submit" class="btn btn-primary">
            {{ $isEdit ? __('Modifier le local') : __('Ajouter le local') }}
        </button>
    </div>
</main>
