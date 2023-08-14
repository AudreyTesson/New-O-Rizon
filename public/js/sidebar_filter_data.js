const sidebar_filter_data = {

    sidebarOpenBtn: null,
    sidebarCloseBtn: null,
    sidebarMenu: null,

    init: function() {
        sidebar_filter_data.sidebarCloseBtn = document.querySelector(".close_filter");
        sidebar_filter_data.sidebarOpenBtn = document.getElementById("filter_btn");
        sidebar_filter_data.sidebarMenu = document.getElementById("filter_sidebar");
        sidebar_filter_data.addEvents();
    },

    /**
     * Method adding click event to open and close the sidebar for filtering research by criteria
     */
    addEvents: function() {
        sidebar_filter_data.sidebarCloseBtn.addEventListener('click', sidebar_filter_data.handleSidebarClose);
        sidebar_filter_data.sidebarOpenBtn.addEventListener('click', sidebar_filter_data.handleSidebarOpen);
    }, 

   /**
    * Handler to manage sidebar opening
    */
    handleSidebarOpen: function() {
        sidebar_filter_data.sidebarMenu.classList.remove('hidden'); 
    },

    /**
     * Handler to manager sidebar closing
     */
    handleSidebarClose: function() {
        sidebar_filter_data.sidebarMenu.classList.add('hidden');
    }
}

document.addEventListener("DOMContentLoaded", sidebar_filter_data.init);


