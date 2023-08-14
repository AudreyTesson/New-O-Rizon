const scroll = {

        init: function() {
        window.onscroll = function() {scroll.scrollUpTo200()}; 
        const toTopButton = document.getElementById("to-top-button");
        toTopButton.addEventListener('click', scroll.goToTop);
        },

        /**
         * Method to show the toTopButton after scrolling down 200px from the top of the document
         */
        scrollUpTo200: function() {
            const toTopButton = document.getElementById("to-top-button");
            if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
                toTopButton.classList.remove("hidden");
            } else {
                toTopButton.classList.add("hidden");
            }
        },

        /**
         * Method to smoothly scroll to the top of the document with click event on toTopButton
         */
        goToTop: function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

}

document.addEventListener('DOMContentLoaded', scroll.init)