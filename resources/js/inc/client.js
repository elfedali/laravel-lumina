import axios from "axios";
import { Modal } from "bootstrap";

$(function () {
    let buttonsToDeleteClients = $(".classBtnDeleteClient");

    for (let button of buttonsToDeleteClients) {
        button.addEventListener("click", async function () {
            const clientId = this.dataset.id;
            const clientNameTodelete = this.dataset.name;
            const span = $("#clientNameTodelete");
            span.text(clientNameTodelete);

            const hiddenInput = $("#clientIdTodelete");
            hiddenInput.val(clientId);
        });
    }

    // keep the modal visible in load if it has addClientModal
    const addClientModal = $("#addClientModal");
    const modal = new Modal(addClientModal);
    if (addClientModal.hasClass("modalHasErrors")) {
        modal.show();
    }

    // edit button click
    const classBtnsEditClient = $(".classBtnEditClient");
    const modal_EditClient = new Modal(
        document.getElementById("editClientModal")
    );

    for (let button of classBtnsEditClient) {
        button.addEventListener("click", async function () {
            modal_EditClient.show();
            console.log(this.dataset);
            let id = this.dataset.id;
            let first_name = this.dataset.first_name;
            let last_name = this.dataset.last_name;
            let email = this.dataset.email;
            let phone = this.dataset.phone;

            // get the form
            const $form = $("#editClientForm");
            // delete all is_invalid class
            $form.find(".is-invalid").removeClass("is-invalid");
            $form.find(".invalid-feedback").text("");

            // set the form name client_id
            $form.find('[name="id"]').val(id);
            $form.find('[name="first_name"]').val(first_name);
            $form.find('[name="last_name"]').val(last_name);
            $form.find('[name="email"]').val(email);
            $form.find('[name="phone"]').val(phone);
        });
    }

    // handle submit the form
    $("#editClientForm").on("submit", function (event) {
        event.preventDefault();
        // get the form
        const $form = $(this);

        axios
            .put($form.attr("action"), $form.serialize())
            .then((response) => {
                console.log(response);
                // close the modal
                modal_EditClient.hide();
                // reload the page
                location.reload();
            })
            .catch((error) => {
                // form errors
                $form.find(".is-invalid").removeClass("is-invalid");
                $form.find(".invalid-feedback").text("");
                if (error.response.status === 422) {
                    const errors = error.response.data.errors;
                    for (const field in errors) {
                        const input = $form.find(`[name="${field}"]`);
                        if (input.length) {
                            input.addClass("is-invalid");
                            input.after(
                                `<div class="invalid-feedback">${errors[field][0]}</div>`
                            );
                        }
                    }
                }
            });
    });

    // add new client
    $("#addClientForm").on("submit", function (event) {
        event.preventDefault();
        // get the form
        const $form = $(this);

        axios
            .post($form.attr("action"), $form.serialize())
            .then((response) => {
                console.log(response);
                // close the modal
                modal.hide();
                // reload the page
                location.reload();
            })
            .catch((error) => {
                // form errors
                $form.find(".is-invalid").removeClass("is-invalid");
                $form.find(".invalid-feedback").text("");
                if (error.response.status === 422) {
                    const errors = error.response.data.errors;
                    for (const field in errors) {
                        const input = $form.find(`[name="${field}"]`);
                        if (input.length) {
                            input.addClass("is-invalid");
                            input.after(
                                `<div class="invalid-feedback">${errors[field][0]}</div>`
                            );
                        }
                    }
                }
            });
    });

    // delete client
});
