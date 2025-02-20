<form action="{{ route('changes.locales.update', $locale->id) }}" id="formEditLocale">
    @csrf
    @method('PUT')
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5">
                Modifier une adresse
            </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <!-- Address -->
                <div class="col-lg-12 mb-3">
                    <div class="form-floating">
                        <input type="text" name="address" id="locale_address" class="form-control" placeholder=""
                            value="{{ $locale->address }}">
                        <label for="locale_address" class="form-label">
                            Adresse <span class="text-danger">*</span>
                        </label>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>

                <div class="row">
                    <!-- Quartier -->
                    <div class=" col-lg mb-3">
                        <div class="form-floating">
                            <input type="text" name="neighborhood" id="locale_neighborhood" class="form-control"
                                placeholder="" value="{{ $locale->neighborhood }}">
                            <label for="locale_neighborhood" class="form-label">
                                Quartier <span class="text-danger">*</span>
                            </label>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <!-- Ville -->
                    <div class="col-lg mb-3">
                        <div class="form-floating">
                            <input type="text" name="city" id="locale_city" class="form-control" placeholder=""
                                value="{{ $locale->city }}">
                            <label for="locale_city" class="form-label">
                                Ville <span class="text-danger">*</span>
                            </label>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- phone -->
                    <div class=" col-lg mb-3">
                        <div class="form-floating">
                            <input type="tel" name="phone" id="locale_phone" class="form-control" placeholder=""
                                value="{{ $locale->phone }}">
                            <label for="locale_phone" class="form-label">
                                Téléphone 1 <span class="text-danger">*</span>
                            </label>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <!-- phone 2 -->
                    <div class="col-lg mb-3">
                        <div class="form-floating">
                            <input type="tel" name="phone2" id="locale_phone2" class="form-control" placeholder=""
                                value="{{ $locale->phone2 }}">
                            <label for="locale_phone2" class="form-label">
                                Téléphone 2
                            </label>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg">
                        <x-horaires :hours="$locale->hours ?? null" />
                    </div>
                </div>

            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                Annuler
            </button>
            <button type="button" class="btn btn-primary">
                Enregistrer les modifications
            </button>
        </div>
    </div>
</form>
