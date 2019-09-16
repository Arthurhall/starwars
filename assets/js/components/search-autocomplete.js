(function($) {

    $.fn.searchAutocomplete=function(options) {
        // On définit nos paramètres par défaut
        var defaults = {
            "autocompleteRequestDataCallback": function(){ return null; },
            "autocompleteOnHideDropdownCallback": function(){ return null; }
        };

        // On fusionne nos deux objets
        var param = $.extend(defaults, options);
        Window.searchRequest = null;

        return this.each(function() {
            // On stocke notre élément dans une variable par commodité
            var $input = $(this);
            var $container = $input.parents('.dropdown');
            var $menu = $container.find('.dropdown-menu');

            /**
             * Searching on key up
             */
            var searching;
            $input.on("keyup", function( event ) {
                /**
                 * On lance la recherche que si l'utilisateur
                 * arrête d'ecrire pendant 1 seconde
                 */
                clearTimeout(searching);
                searching = setTimeout(function() {
                    makeRequest($menu, $input);
                }, 500 ); // searching setTimeout
            }); // on keyup

            $menu.on('click', 'a.list-group-item', function () {
                window.location = $(this).attr('href');
            });
            $input.click(function(e) {
                if ($menu.find('.contain-search').length === 0) {
                    e.stopPropagation();
                }
            });
        }); // Plugin return

        /**
         * @param {jqXHR} request
         * @param {object} $menu
         * @param {string} search
         */
        function makeRequest($menu, $input) {
            if ($input.val().length < 3) {
                return;
            }

            if (Window.searchRequest) {
                Window.searchRequest.abort();
            }

            $menu.dropdown('show');
            $menu.html('<div class="text-center"><div class="spinner-grow" role="status"><span class="sr-only">Loading...</span></div></div>');

            Window.searchRequest = $.ajax({
                type: 'get',
                url: $input.data('autocomplete-url') + '?search=' + $input.val(),
                dataType : 'html'
            });

            Window.searchRequest.done(function(html, status) {
                if(status == "success") {
                    $menu.html(html);
                } else {
                    $menu.html( '<div class="alert alert-danger m-4" role="alert">Une erreur est survenue !</div>' );
                }
            }).fail(function( jqXHR, textStatus ) {
                if (textStatus != 'abort') {
                    $menu.html( '<div class="alert alert-danger m-4" role="alert">Une erreur est survenue !</div>' );
                }
            });
        }
    }; // Plugin
})(jQuery);
