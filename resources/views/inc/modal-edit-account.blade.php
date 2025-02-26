<!-- Modal -->
<div class="modal fade" id="editAccountModal" tabindex="-1" aria-labelledby="editAccountModalLabel" aria-hidden="true">
    <form action="{{ route('edit-account-ajax') }}" id="editAccountForm" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ auth()->user()->id }}">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-5" id="editAccountModalLabel">
                        Mon compte
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            {{-- firstname --}}
                            <div class="mb-3 form-floating">
                                <input type="text" class="form-control" placeholder="" name="lastname"
                                    id="user_lastname" value="{{ auth()->user()->lastname }}">
                                <label for="user_lastname">Nom de famille <span class="text-danger">*</span></label>
                            </div>
                            {{-- lastname --}}
                            <div class="mb-3 form-floating">
                                <input type="text" class="form-control" placeholder="" name="firstname"
                                    id="user_firstname" value="{{ auth()->user()->firstname }}">
                                <label for="user_firstname">Prénom <span class="text-danger">*</span></label>
                            </div>
                            {{-- phone --}}
                            <div class="mb-3 form-floating">
                                <input type="text" class="form-control" placeholder="" name="phone"
                                    id="user_telephone" value="{{ auth()->user()->phone }}">
                                <label for="user_telephone">Téléphone <span class="text-danger">*</span></label>
                            </div>
                            {{-- email --}}
                            <div class="mb-3 form-floating">
                                <input type="email" class="form-control" placeholder="" name="email" id="user_email"
                                    value="{{ auth()->user()->email }}">
                                <label for="user_email">
                                    Adresse e-mail <span class="text-danger">*</span>
                                </label>
                                <span class="text-muted" style="font-size: 12px">
                                    Cette adresse sera utilisée pour vous connecter et recevoir des notifications
                                </span>
                            </div>


                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Annuler
                    </button>
                    <button type="sumit" class="btn btn-primary">
                        Mettre à jours
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
