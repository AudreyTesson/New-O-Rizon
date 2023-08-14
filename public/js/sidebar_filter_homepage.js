const sidebar_filter_homepage = {

    sidebarOpenBtnMobile: null,
    sidebarOpenBtn: null,
    sidebarCloseBtn: null,
    sidebarMenu: null,

    init: function() {
        sidebar_filter_homepage.sidebarCloseBtn = document.querySelector(".close_filter");
        sidebar_filter_homepage.sidebarOpenBtn = document.getElementById("filter_btn");
        sidebar_filter_homepage.sidebarOpenBtnMobile = document.getElementById("filter_btn_mobile");
        sidebar_filter_homepage.sidebarMenu = document.getElementById("filter_sidebar");
        sidebar_filter_homepage.addEvents();
    },

    /**
     * Method adding click event to open and close the sidebar for filtering research by criteria
     */
    addEvents: function() {
        sidebar_filter_homepage.sidebarCloseBtn.addEventListener('click', sidebar_filter_homepage.handleSidebarClose);
        sidebar_filter_homepage.sidebarOpenBtnMobile.addEventListener('click', sidebar_filter_homepage.handleSidebarOpen);
        sidebar_filter_homepage.sidebarOpenBtn.addEventListener('click', sidebar_filter_homepage.handleSidebarOpen);
    }, 

   /**
    * Handler to manage sidebar opening
    */
    handleSidebarOpen: function() {
        sidebar_filter_homepage.sidebarMenu.classList.remove('hidden'); 
        const home_mobile = document.getElementById('home_map_mobile');
        const home_desktop = document.getElementById('home_map_desktop');
        if (home_mobile) {
            home_mobile.classList.add("blur-sm");
        }
        home_desktop.classList.add("blur-sm");
    },

    /**
     * Handler to manager sidebar closing
     */
    handleSidebarClose: function() {
        sidebar_filter_homepage.sidebarMenu.classList.add('hidden');
        const home_mobile = document.getElementById('home_map_mobile');
        const home_desktop = document.getElementById('home_map_desktop');
        if (home_mobile) {
            home_mobile.classList.remove("blur-sm");
        }
        home_desktop.classList.remove("blur-sm");
    }
}

document.addEventListener("DOMContentLoaded", sidebar_filter_homepage.init);


