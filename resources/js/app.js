import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Mesej validasi custom dalam Bahasa Melayu untuk semua form bertanda [novalidate]
document.addEventListener('DOMContentLoaded', function () {
    const forms = document.querySelectorAll('form[novalidate]');

    forms.forEach(function (form) {
        const inputs = form.querySelectorAll('[required]');

        form.addEventListener('submit', function (e) {
            let valid = true;

            inputs.forEach(function (input) {
                input.setCustomValidity('');

                if (!input.checkValidity()) {
                    if (input.validity.valueMissing) {
                        input.setCustomValidity('Sila isi ruangan ini.');
                    } else if (input.validity.typeMismatch && input.type === 'email') {
                        input.setCustomValidity('Sila masukkan alamat emel yang sah.');
                    } else if (input.validity.tooShort) {
                        input.setCustomValidity('Terlalu pendek. Minimum ' + input.minLength + ' aksara diperlukan.');
                    } else {
                        input.setCustomValidity('Ruangan ini tidak sah.');
                    }
                    valid = false;
                }
            });

            if (!valid) {
                e.preventDefault();
                form.reportValidity();
            }
        });

        inputs.forEach(function (input) {
            input.addEventListener('input', function () {
                this.setCustomValidity('');
            });
        });
    });
});