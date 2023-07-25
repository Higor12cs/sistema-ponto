import './bootstrap';

import Alpine from 'alpinejs'
import $ from 'jquery'
import 'jquery-mask-plugin'

window.Alpine = Alpine
Alpine.start()

window.jQuery = window.$ = $

window.addEventListener('modal', function (e) {
    $('#' + e.detail.name).modal(e.detail.action);
});

window.addEventListener('swal', function (e) {
    Swal.fire(e.detail);
});

$("#bootstrap-alert").fadeTo(4000, 400).slideUp(400, function () {
    $("#bootstrap-alert").slideUp(400);
});

window.applyMask = function (id) {
    $('#' + id).mask('00:00');
}
