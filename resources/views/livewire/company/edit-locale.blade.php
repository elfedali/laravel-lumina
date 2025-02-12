<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">
                {{ $title }}
            </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            {{-- --------------------------START------------------------- --}}


            <main>

                <!-- Informations sur le propriétaire -->

                <div class="card">
                    <div class="card-body">


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
                                {{-- ici error multiple alpine instance are runing --}}
                                {{-- <x-horaires :hours="$locale->hours ?? null" /> --}}
                            </div>
                        </div>

                    </div>
                </div>


            </main>


            {{-- --------------------------START------------------------- --}}



        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Understood</button>
        </div>
    </div>
</div>
