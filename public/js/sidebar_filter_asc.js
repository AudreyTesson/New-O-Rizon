const sidebar_filter_asc = {

    sidebarOpenBtn: null,
    sidebarCloseBtn: null,
    sidebarMenu: null,

    init: function() {
        sidebar_filter_asc.sidebarCloseBtn = document.querySelector(".close_filter");
        sidebar_filter_asc.sidebarOpenBtn = document.getElementById("filter_btn");
        sidebar_filter_asc.sidebarMenu = document.getElementById("filter_sidebar");
        sidebar_filter_asc.addEvents();
    },

    /**
     * Method adding click event to open and close the sidebar for filtering research by criteria
     */
    addEvents: function() {
        sidebar_filter_asc.sidebarCloseBtn.addEventListener('click', sidebar_filter_asc.handleSidebarClose);
        sidebar_filter_asc.sidebarOpenBtn.addEventListener('click', sidebar_filter_asc.handleSidebarOpen);
    }, 

   /**
    * Handler to manage sidebar opening
    */
    handleSidebarOpen: function() {
        sidebar_filter_asc.sidebarMenu.classList.remove('hidden'); 
    },

    /**
     * Handler to manager sidebar closing
     */
    handleSidebarClose: function() {
        sidebar_filter_asc.sidebarMenu.classList.add('hidden');
    }
}

document.addEventListener("DOMContentLoaded", sidebar_filter_asc.init);


