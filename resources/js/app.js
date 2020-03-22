window.Swal = require('sweetalert2');
window.select2 = require('select2');
window.mask = require('jquery-mask-plugin/src/jquery.mask');

window.Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    showClass: {
        popup: 'animated slideInRight'
    },
    hideClass: {
        popup: 'animated bounceOutRight'
    }
});

require('./bootstrap');
require('bootstrap-switch/dist/js/bootstrap-switch');
require('select2/dist/js/i18n/pt-BR');
require('@fancyapps/fancybox');

// CUSTOM
require('./custom').default;
