'use strict';

class Scroll
{
    load() 
    {
        let button = document.getElementById('top');

        if (button) {
            
            window.addEventListener('scroll', function () {
                let topPos = window.scrollY || document.documentElement.scrollTop;
    
                if (topPos > 100) {
                    button.style.opacity = '1';
                } else {
                    button.style.opacity = '0';
                }
            });

            
            button.addEventListener('click', function () {
                window.scrollTo({
                    top: 0, // Scroll to the top of the window
                    behavior: 'smooth' // Enable smooth scrolling
                });
            });
        }
    }
}


(function (window, document) {
    'use strict';

    // Initialize on window load
    window.addEventListener('load', function () {
        let scroll = new Scroll;
        scroll.load();
    });

})(window, document);