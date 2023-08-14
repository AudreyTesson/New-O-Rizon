const sidebar_filter_cities = {

    sidebarOpenBtn: null,
    sidebarCloseBtn: null,
    sidebarMenu: null,

    init: function() {
        sidebar_filter_cities.sidebarCloseBtn = document.querySelector(".close_filter");
        sidebar_filter_cities.sidebarOpenBtn = document.getElementById("filter_btn");
        sidebar_filter_cities.sidebarMenu = document.getElementById("filter_sidebar");
        sidebar_filter_cities.addEvents();
    },

    /**
     * Method adding click event to open and close the sidebar for filtering research by criteria
     */
    addEvents: function() {
        sidebar_filter_cities.sidebarCloseBtn.addEventListener('click', sidebar_filter_cities.handleSidebarClose);
        sidebar_filter_cities.sidebarOpenBtn.addEventListener('click', sidebar_filter_cities.handleSidebarOpen);
    }, 

   /**
    * Handler to manage sidebar opening
    */
    handleSidebarOpen: function() {
        sidebar_filter_cities.sidebarMenu.classList.remove('hidden'); 
    },

    /**
     * Handler to manager sidebar closing
     */
    handleSidebarClose: function() {
        sidebar_filter_cities.sidebarMenu.classList.add('hidden');
    }
}

document.addEventListener("DOMContentLoaded", sidebar_filter_cities.init);


