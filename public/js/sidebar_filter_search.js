const sidebar_filter_search = {

    sidebarOpenBtn: null,
    sidebarCloseBtn: null,
    sidebarMenu: null,

    init: function() {
        sidebar_filter_search.sidebarCloseBtn = document.querySelector(".close_filter");
        sidebar_filter_search.sidebarOpenBtn = document.getElementById("filter_btn");
        sidebar_filter_search.sidebarMenu = document.getElementById("filter_sidebar");
        sidebar_filter_search.addEvents();
    },

    /**
     * Method adding click event to open and close the sidebar for filtering research by criteria
     */
    addEvents: function() {
        sidebar_filter_search.sidebarCloseBtn.addEventListener('click', sidebar_filter_search.handleSidebarClose);
        sidebar_filter_search.sidebarOpenBtn.addEventListener('click', sidebar_filter_search.handleSidebarOpen);
    }, 

   /**
    * Handler to manage sidebar opening
    */
    handleSidebarOpen: function() {
        sidebar_filter_search.sidebarMenu.classList.remove('hidden'); 
    },

    /**
     * Handler to manager sidebar closing
     */
    handleSidebarClose: function() {
        sidebar_filter_search.sidebarMenu.classList.add('hidden');
    }
}

document.addEventListener("DOMContentLoaded", sidebar_filter_search.init);


