<div>
    <form wire:submit.prevent="update">

        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="appModalLabel"> {{ $title }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <!-- Nom du salon -->
                    <div class=" col-lg mb-3">
                        <div class="form-floating">
                            <input type="text" wire:model="name" id="company_name"
                                class="form-control @error('name') is-invalid @enderror" placeholder="">
                            <label for="company_name" class="form-label">{{ __('Nom du salon') }} <span
                                    class="text-danger">*</span></label>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- /.form-floating -->

                    </div>

                    <!-- Catégorie du salon -->
                    <div class=" col-lg mb-3">
                        <div class="form-floating">

                            <input type="text" wire:model="category" id="company_category"
                                class="form-control @error('category') is-invalid @enderror" placeholder="">
                            <label for="company_category" class="form-label">{{ __('Catégorie du salon') }} <span
                                    class="text-danger">*</span></label>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- /.form-floating -->
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">
                    Mettre à jour
                </button>
            </div>
        </div>

    </form>
</div>
