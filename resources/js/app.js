import './bootstrap';

import Alpine from 'alpinejs'
import $ from 'jquery'

window.Alpine = Alpine
Alpine.start()

window.jQuery = window.$ = $

window.addEventListener('modal', function (e) {
    $('#' + e.detail.name).modal(e.detail.action);
});

window.addEventListener('swal', function (e) {
    Swal.fire(e.detail);
});
