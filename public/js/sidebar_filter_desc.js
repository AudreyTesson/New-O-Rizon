const sidebar_filter_desc = {

    sidebarOpenBtn: null,
    sidebarCloseBtn: null,
    sidebarMenu: null,

    init: function() {
        sidebar_filter_desc.sidebarCloseBtn = document.querySelector(".close_filter");
        sidebar_filter_desc.sidebarOpenBtn = document.getElementById("filter_btn");
        sidebar_filter_desc.sidebarMenu = document.getElementById("filter_sidebar");
        sidebar_filter_desc.addEvents();
    },

    /**
     * Method adding click event to open and close the sidebar for filtering research by criteria
     */
    addEvents: function() {
        sidebar_filter_desc.sidebarCloseBtn.addEventListener('click', sidebar_filter_desc.handleSidebarClose);
        sidebar_filter_desc.sidebarOpenBtn.addEventListener('click', sidebar_filter_desc.handleSidebarOpen);
    }, 

   /**
    * Handler to manage sidebar opening
    */
    handleSidebarOpen: function() {
        sidebar_filter_desc.sidebarMenu.classList.remove('hidden'); 
    },

    /**
     * Handler to manager sidebar closing
     */
    handleSidebarClose: function() {
        sidebar_filter_desc.sidebarMenu.classList.add('hidden');
    }
}

document.addEventListener("DOMContentLoaded", sidebar_filter_desc.init);


