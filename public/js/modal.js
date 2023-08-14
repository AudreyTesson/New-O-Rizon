const modal = {

    init: function() {
        const closeElements = document.querySelectorAll(".close_modal");
        if (closeElements) {
            closeElements.forEach((close) => {
                close.addEventListener('click', modal.closeModal);
            });
        }
    },

    /**
     * Method to close the modal on click event
     */
    closeModal: function(){
        const modalSuccessElements = document.querySelectorAll(".modal");
        modalSuccessElements.forEach((modalSuccess) => {
            modalSuccess.classList.add("hidden");
        })
    },      
}

document.addEventListener('DOMContentLoaded', modal.init);