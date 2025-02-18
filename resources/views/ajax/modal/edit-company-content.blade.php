<?php
/**
 * @var $company \App\Models\Company
 *
 */
?>

<form id="formUpdateCompany" method="POST" action="{{ route('change-company', ['companyId' => $company->id]) }}">

    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="appModalLabel">
                Modifier le salon
            </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <div class="row">
                <div class=" col-lg mb-3">
                    <div class="form-floating">
                        <input type="text" name='name' value="{{ $company->name }}" id="company_name"
                            class="form-control" placeholder="">
                        <label for="company_name" class="form-label">{{ __('Nom du salon') }} <span
                                class="text-danger">*</span></label>
                        <div class="invalid-feedback company-name-error"></div>
                    </div>
                </div>

                <div class=" col-lg mb-3">
                    <div class="form-floating">

                        <input type="text" name="category" value="{{ $company->category }}" id="company_category"
                            class="form-control " placeholder="">
                        <label for="company_category" class="form-label">{{ __('Catégorie du salon') }} <span
                                class="text-danger">*</span></label>
                        <div class="invalid-feedback company-category-error"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                Fermer
            </button>
            <button type="submit" class="btn btn-primary">
                Mettre à jour
            </button>
        </div>
    </div>
</form>
{{-- 
<script>
    const form = document.getElementById('formUpdateCompany');
    const submitButton = form.querySelector('[type="submit"]');

    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        submitButton.disabled = true;
        const nameError = document.querySelector('.name-error');
        const categoryError = document.querySelector('.category-error');
        nameError.textContent = '';
        categoryError.textContent = '';


        try {
            const formData = new FormData(form);
            const response = await fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                        .getAttribute('content'),
                },
            });

            if (response.ok) {
                const result = await response.json();
                if (result.success) {
                    alert(result.message);
                    const modalElement = document.getElementById(
                        'appCompanyModal'); // Make sure you have the correct ID of the modal
                    const modal = bootstrap.Modal.getInstance(modalElement);
                    modal.hide();

                    // Optionally, you can trigger a refresh of the companies list here.
                    // For example, if you have a function called loadCompanies() you can call it here.

                } else {
                    console.error('Server error:', result);
                    if (result.errors) {
                        if (result.errors.name) {
                            nameError.textContent = result.errors.name[0];
                        }
                        if (result.errors.category) {
                            categoryError.textContent = result.errors.category[0];
                        }
                    } else {
                        alert('An error occurred during update.');
                    }
                }
            } else {
                console.error('HTTP error:', response.status);
                alert('A network error occurred. Please try again.');
            }
        } catch (error) {
            console.error('AJAX error:', error);
            alert('An error occurred. Please check your connection.');
        } finally {
            submitButton.disabled = false;
        }
    });
</script> --}}
