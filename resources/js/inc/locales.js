import axios from "axios";
import { Modal } from "bootstrap";

const modal = new Modal(document.getElementById("appLocaleModal"));

$(function () {
    const $btnNewLocale = $("#btnNewLocale");

    $btnNewLocale.on("click", function () {
        axios.get("/changes/locales/create").then((response) => {
            document.getElementById("appLocaleModalDialog").innerHTML =
                response.data;
            saveLocale();
            modal.show();
        });
    });

    function saveLocale() {
        const form = $("#formCreateLocale");
        form.on("submit", function (e) {
            e.preventDefault();

            const submitButton = form.find('[type="submit"]');
            submitButton.prop("disabled", true);

            // Clear previous errors
            $(".is-invalid").removeClass("is-invalid");
            $(".invalid-feedback").text("");

            axios
                .post(form.attr("action"), form.serialize())
                .then((response) => {
                    modal.hide();

                    if (response.data.locale && response.data.locale.id) {
                        axios
                            .get(
                                `/locales/${response.data.locale.id}/set-active-json`
                            )
                            .then(() => {
                                window.location.href = "/"; // Redirect to home
                            })
                            .catch((error) => {
                                console.error(
                                    "Error setting active locale:",
                                    error
                                );
                            });
                    } else {
                        console.error("Locale ID not found in response.");
                        window.location.href = "/"; // Fallback to home
                    }
                })
                .catch((error) => {
                    if (error.response && error.response.status === 422) {
                        const errors = error.response.data.errors;
                        for (const field in errors) {
                            const input = $(`[name="${field}"]`);
                            input.addClass("is-invalid");
                            input
                                .siblings(".invalid-feedback")
                                .text(errors[field][0]);
                        }
                    } else {
                        console.error("Form submission error:", error);
                    }
                })
                .finally(() => {
                    submitButton.prop("disabled", false);
                });
        });
    }
});

$(function () {
    // click on the edit button
    $(document).on("click", "[id^='edit-locale-']", function () {
        const localeId = $(this).data("id"); // Get ID from data-id attribute
        axios.get(`/changes/locales/${localeId}/edit-form`).then((response) => {
            // /changes/locales/{id}/edit-form
            const modalEditLocale = new Modal("#appModalEditLocale");
            $("#appModalEditLocaleDialog").html(response.data);
            console.log(response.data);
            saveLocale();
            modalEditLocale.show();
        });
    });

    function saveLocale() {
        const form = $("#formEditLocale");
    }
    // click on the delete button
    $(document).on("click", "[id^='delete-locale-']", function () {
        const localeId = $(this).data("id"); // Get ID from data-id attribute
        axios
            .get(`/changes/locales/${localeId}/destroy-form`)
            .then((response) => {
                const modalDeleteLocale = new Modal("#appDeleteLocaleModal");
                $("#appDeleteLocaleModalDialog").html(response.data);
                modalDeleteLocale.show();
            });
        // open the modal
    });
});
