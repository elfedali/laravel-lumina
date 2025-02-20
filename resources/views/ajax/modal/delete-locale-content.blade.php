<form action="{{ route('changes.locales.destroy', $locale->id) }}" method="POST" id="formDeleteLocale">
    @csrf
    @method('DELETE')
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="appDeleteLocaleModalLabel">
                Supprimer une adresse
            </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Souhaitez-vous vraiment supprimer
            <b><span>
                    {{ $locale->displayName2 }}
                </span>
            </b>
            de votre système ?
        </div>
        <div class="modal-footer border-0">
            <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">
                Non
            </button>
            <button type="submit" class="btn btn-danger">
                Oui, supprimer
            </button>
        </div>
    </div>
</form>
