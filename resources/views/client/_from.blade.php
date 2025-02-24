<div class="row">
    <div class="col-12">
        <div class="mb-3 form-floating">
            <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror"
                id="client_last_name" placeholder="" value="{{ old('last_name') }}">
            <label for="client_last_name">
                Nom de famille
                <span class="text-danger">*</span>
            </label>
            @error('last_name')
                <div class="invalid-feedback">
                    Ce champ est obligatoire
                </div>
            @enderror
        </div>
    </div>
    <div class="col-12">
        <div class="mb-3 form-floating">
            <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror"
                id="client_first_name" placeholder="" value="{{ old('first_name') }}">
            <label for="client_first_name">
                Prénom
                <span class="text-danger">*</span>
            </label>
            @error('first_name')
                <div class="invalid-feedback">
                    Ce champ est obligatoire
                </div>
            @enderror
        </div>
    </div>
    <div class="col-12">
        <div class="mb-3 form-floating">
            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                id="client_phone" placeholder="" value="{{ old('phone') }}">
            <label for="client_phone">
                Téléphone
                <span class="text-danger">*</span>
            </label>
            @error('phone')
                <div class="invalid-feedback">
                    Ce champ est obligatoire
                </div>
            @enderror
        </div>
    </div>
    <div class="col-12">
        <div class="mb-3 form-floating">
            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                id="client_email" placeholder="" value="{{ old('email') }}">
            <label for="client_email">
                E-mail
            </label>
            @error('email')
                <div class="invalid-feedback">
                    Ce champ est obligatoire
                </div>
            @enderror
        </div>
    </div>
</div>
