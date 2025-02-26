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
                    location.reload();

                    // if (response.data.locale && response.data.locale.id) {
                    //     axios
                    //         .get(
                    //             `/locales/${response.data.locale.id}/set-active-json`
                    //         )
                    //         .then(() => {
                    //             window.location.href = "/"; // Redirect to home
                    //         })
                    //         .catch((error) => {
                    //             console.error(
                    //                 "Error setting active locale:",
                    //                 error
                    //             );
                    //         });
                    // } else {
                    //     console.error("Locale ID not found in response.");
                    //     window.location.href = "/"; // Fallback to home
                    // }
                })
                .catch((error) => {
                    if (error.response && error.response.status === 422) {
                        const errors = error.response.data.errors;

                        for (const field in errors) {
                            const input = $(`[name="${field}"]`);
                            if (input.length) {
                                input.addClass("is-invalid");
                                input.after(
                                    `<div class="invalid-feedback">${errors[field][0]}</div>`
                                );
                            }

                            // Gérer les erreurs des horaires (ex: hours.sunday.end)
                            if (field.startsWith("hours.")) {
                                const parts = field.split(".");
                                if (parts.length === 3) {
                                    const day = parts[1];
                                    const type = parts[2]; // "start" ou "end"

                                    const inputField = $(
                                        `[name="hours[${day}][${type}]"]`
                                    );
                                    inputField.addClass("is-invalid");
                                    inputField.after(
                                        `<div class="invalid-feedback">${errors[field][0]}</div>`
                                    );
                                }
                            }
                            if (field === "hours") {
                                const errorMessage = `<div class="invalid-feedback d-block mb-3">${errors[field][0]}</div>`;
                                console.log(errorMessage);
                                form.find(".hoursSection").prepend(
                                    errorMessage
                                ); // Afficher l'erreur en haut de la section des horaires
                            }
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
        form.on("submit", function (e) {
            e.preventDefault();

            const submitButton = form.find('[type="submit"]');
            submitButton.prop("disabled", true);

            // Clear previous errors
            $(".is-invalid").removeClass("is-invalid");
            $(".invalid-feedback").remove(); // Supprimer les anciens messages d'erreur

            axios
                .post(form.attr("action"), form.serialize())
                .then((response) => {
                    modal.hide();
                    location.reload(); // Rafraîchir la page après une mise à jour réussie
                })
                .catch((error) => {
                    submitButton.prop("disabled", false);

                    if (error.response && error.response.status === 422) {
                        const errors = error.response.data.errors;

                        for (const field in errors) {
                            const input = $(`[name="${field}"]`);
                            if (input.length) {
                                input.addClass("is-invalid");
                                input.after(
                                    `<div class="invalid-feedback">${errors[field][0]}</div>`
                                );
                            }

                            // Gérer les erreurs des horaires (ex: hours.sunday.end)
                            if (field.startsWith("hours.")) {
                                const parts = field.split(".");
                                if (parts.length === 3) {
                                    const day = parts[1];
                                    const type = parts[2]; // "start" ou "end"

                                    const inputField = $(
                                        `[name="hours[${day}][${type}]"]`
                                    );
                                    inputField.addClass("is-invalid");
                                    inputField.after(
                                        `<div class="invalid-feedback">${errors[field][0]}</div>`
                                    );
                                }
                            }
                            if (field === "hours") {
                                const errorMessage = `<div class="invalid-feedback d-block mb-3">${errors[field][0]}</div>`;
                                console.log(errorMessage);
                                form.find(".hoursSection").prepend(
                                    errorMessage
                                ); // Afficher l'erreur en haut de la section des horaires
                            }
                        }
                    } else {
                        console.error("Form submission error:", error);
                    }
                });
        });
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
