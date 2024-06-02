(function (window, document, $, undefined) {
    'use strict';

    var assuntos = (function () {

        var $private = {};
        var $public = {};

        //busca na área de links uteis
        $public.init = function() {
            $(document).ready(function() {
                $('#assunto').select2({
                    placeholder: "Select a state",
                    allowClear: true,
                    theme: "classic",
                    tags: true
                });
            });    
        };

        return $public;
    })();

    // Global
    window.assuntos = assuntos;
    assuntos.init();
})(window, document, jQuery);