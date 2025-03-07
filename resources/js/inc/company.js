import { Modal } from "bootstrap";

const modal = new Modal(document.getElementById("appCompanyModal"));

const m = document.getElementById("appCompanyModal");

$(function () {
    // Cache frequently used selectors
    const $btnEditCompany = $("#btnEditCompany");
    const $appCompanyModalDialog = $("#appCompanyModalDialog");
    const $metaCsrfToken = $('meta[name="csrf-token"]');

    // Event delegation for dynamic elements (if needed)
    $btnEditCompany.on("click", function () {
        const companyId = $(this).data("id");
        console.log("Editing company with ID:", companyId);

        $.ajax({
            url: `/changes/companies/${companyId}/edit`,
            type: "GET",
            success: function (formHtml) {
                $appCompanyModalDialog.html(formHtml);

                // Initialize the modal
                const modalElement = document.getElementById(
                    "appCompanyModalDialog"
                );
                if (!modalElement) {
                    console.error("Modal element not found!");
                    return;
                }

                modal.show();

                // Attach the update functionality
                updateCompany(modal);
            },
            error: function (xhr, status, error) {
                console.error("Error fetching company edit form:", error);
            },
        });
    });

    function updateCompany(modal) {
        const $form = $("#formUpdateCompany");

        $form.off("submit").on("submit", function (event) {
            event.preventDefault();

            const $submitButton = $form.find('[type="submit"]');
            const $nameError = $(".company-name-error");
            const $categoryError = $(".company-category-error");
            const $companyNameInput = $("#company_name");
            const $companyCategoryInput = $("#company_category");
            const $companyLogoInput = $("#company_logo");
            const $logoError = $(".company-logo-error");

            // Disable the submit button to prevent multiple submissions
            $submitButton.prop("disabled", true);

            // Clear previous errors
            $nameError.text("");
            $categoryError.text("");
            $companyNameInput.removeClass("is-invalid");
            $companyCategoryInput.removeClass("is-invalid");

            // Submit the form via AJAX
            $.ajax({
                url: $form.attr("action"),
                type: "POST",
                data: new FormData($form[0]),
                headers: {
                    "X-CSRF-TOKEN": $metaCsrfToken.attr("content"),
                },
                processData: false,
                contentType: false,
                enctype: "multipart/form-data",
                success: function (result) {
                    // Handle success response
                    modal.hide();
                    location.reload(); // Refresh the page after successful update
                },
                error: function (xhr, status, error) {
                    console.log("XHR:", xhr);

                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        // Handle validation errors
                        if (xhr.responseJSON.errors.name) {
                            $nameError.text(xhr.responseJSON.errors.name[0]);
                            $companyNameInput.addClass("is-invalid");
                        }
                        if (xhr.responseJSON.errors.category) {
                            $categoryError.text(
                                xhr.responseJSON.errors.category[0]
                            );
                            $companyCategoryInput.addClass("is-invalid");
                        }
                        if (xhr.responseJSON.errors.logo) {
                            $logoError.text(xhr.responseJSON.errors.logo[0]);
                            $companyLogoInput.addClass("is-invalid");
                        }
                    } else {
                        // Handle non-validation errors (e.g., 500 server errors)
                        alert(
                            "An unexpected error occurred. Please try again later."
                        );
                    }
                },
                complete: function () {
                    // Re-enable the submit button
                    $submitButton.prop("disabled", false);
                },
            });
        });
    }
});
