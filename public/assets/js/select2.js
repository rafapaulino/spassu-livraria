(function (window, document, $, undefined) {
    'use strict';

    var select2 = (function () {

        var $private = {};
        var $public = {};

        //busca na área de links uteis
        $public.init = function() {
            $(document).ready(function() {

                $('.select-select2').each(function(){
                    var url = $(this).data('source');
                    
                    $(this).select2({
                        placeholder: "Selecione uma opção",
                        allowClear: true,
                        theme: "classic",
                        tags: true,
                        ajax: {
                            url: url,
                            dataType: 'json',
                            delay: 250,
                            data: function (params) {
                                return {
                                    q: params.term, // termo de busca
                                    page: params.page || 1
                                };
                            },
                            processResults: function (data, params) {
                                params.page = params.page || 1;
        
                                return {
                                    results: data.results,
                                    pagination: {
                                        more: data.pagination.more
                                    }
                                };
                            },
                            cache: true
                        },
                        minimumInputLength: 3
                    });
                });
            });    
        };

        return $public;
    })();

    // Global
    window.select2 = select2;
    select2.init();
})(window, document, jQuery);