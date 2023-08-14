const sidebar_filter_citiesCountry = {

    sidebarOpenBtn: null,
    sidebarCloseBtn: null,
    sidebarMenu: null,

    init: function() {
        sidebar_filter_citiesCountry.sidebarCloseBtn = document.querySelector(".close_filter");
        sidebar_filter_citiesCountry.sidebarOpenBtn = document.getElementById("filter_btn");
        sidebar_filter_citiesCountry.sidebarMenu = document.getElementById("filter_sidebar");
        sidebar_filter_citiesCountry.addEvents();
    },

    /**
     * Method adding click event to open and close the sidebar for filtering research by criteria
     */
    addEvents: function() {
        sidebar_filter_citiesCountry.sidebarCloseBtn.addEventListener('click', sidebar_filter_citiesCountry.handleSidebarClose);
        sidebar_filter_citiesCountry.sidebarOpenBtn.addEventListener('click', sidebar_filter_citiesCountry.handleSidebarOpen);
    }, 

   /**
    * Handler to manage sidebar opening
    */
    handleSidebarOpen: function() {
        sidebar_filter_citiesCountry.sidebarMenu.classList.remove('hidden'); 
    },

    /**
     * Handler to manager sidebar closing
     */
    handleSidebarClose: function() {
        sidebar_filter_citiesCountry.sidebarMenu.classList.add('hidden');
    }
}

document.addEventListener("DOMContentLoaded", sidebar_filter_citiesCountry.init);


