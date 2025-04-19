"use strict";

var KTSignupGeneral = (function () {
    let form, submitButton, validator, passwordMeter;

    const isPasswordStrong = () => passwordMeter.getScore() === 100;

    return {
        init: function () {
            form = document.querySelector("#kt_sign_up_form");
            submitButton = document.querySelector("#kt_sign_up_submit");
            passwordMeter = KTPasswordMeter.getInstance(form.querySelector('[data-kt-password-meter="true"]'));

            validator = FormValidation.formValidation(form, {
                fields: {
                    "first-name": {
                        validators: {
                            notEmpty: {
                                message: validationMessages.first_name_required
                            }
                        }
                    },
                    "last-name": {
                        validators: {
                            notEmpty: {
                                message: validationMessages.last_name_required
                            }
                        }
                    },
                    username: {
                        validators: {
                            notEmpty: {
                                message: validationMessages.username_required
                            }
                        }
                    },
                    email: {
                        validators: {
                            emailAddress: {
                                message: validationMessages.email_invalid
                            }
                        }
                    },
                    password: {
                        validators: {
                            notEmpty: {
                                message: validationMessages.password_required
                            },
                            callback: {
                                message: validationMessages.password_invalid,
                                callback: function (input) {
                                    if (input.value.length > 0) return isPasswordStrong();
                                }
                            }
                        }
                    },
                    "password_confirmation": {
                        validators: {
                            notEmpty: {
                                message: validationMessages.confirm_required
                            },
                            identical: {
                                compare: function () {
                                    return form.querySelector('[name="password"]').value;
                                },
                                message: validationMessages.confirm_not_match
                            }
                        }
                    },
                    toc: {
                        validators: {
                            notEmpty: {
                                message: validationMessages.accept_toc
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger({
                        event: {
                            password: false
                        }
                    }),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: ""
                    })
                }
            });

            submitButton.addEventListener("click", function (e) {
                e.preventDefault();
                validator.revalidateField("password");

                validator.validate().then(function (status) {
                    if (status === "Valid") {
                        submitButton.setAttribute("data-kt-indicator", "on");
                        submitButton.disabled = true;
                        form.submit();
                    } else {
                        Swal.fire({
                            text: validationMessages.error_message,
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: validationMessages.got_it,
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    }
                });
            });

            form.querySelector('input[name="password"]').addEventListener("input", function () {
                if (this.value.length > 0) {
                    validator.updateFieldStatus("password", "NotValidated");
                }
            });
        }
    };
})();

KTUtil.onDOMContentLoaded(function () {
    KTSignupGeneral.init();
});
