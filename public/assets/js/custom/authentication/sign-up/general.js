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
                    email: {
                        validators: {
                            notEmpty: {
                                message: validationMessages.email_required
                            },
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
                    "confirm-password": {
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

                        setTimeout(function () {
                            submitButton.removeAttribute("data-kt-indicator");
                            submitButton.disabled = false;

                            Swal.fire({
                                text: validationMessages.success_message,
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            }).then(function (result) {
                                if (result.isConfirmed) {
                                    form.reset();
                                    passwordMeter.reset();
                                }
                            });
                        }, 1500);
                    } else {
                        Swal.fire({
                            text: validationMessages.error_message,
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
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
