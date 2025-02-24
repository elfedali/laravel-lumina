import axios from "axios";

$(function () {
    $("#editAccountForm").on("submit", function (e) {
        e.preventDefault();
        const $form = $(this);
        console.log($form);

        axios
            .put($form.attr("action"), $form.serialize())
            .then((response) => {
                console.log("response");
                // hide modal
                location.reload();
            })
            .catch((error) => {
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
});
