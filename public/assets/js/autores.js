(function (window, document, $, undefined) {
    'use strict';

    var autores = (function () {

        var $private = {};
        var $public = {};

        //busca na área de links uteis
        $public.init = function() {
            $(document).ready(function() {
                $('#autores').select2({
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
    window.autores = autores;
    autores.init();
})(window, document, jQuery);