const moreCriteria = {

    criteriaBtn: document.getElementById("toggle-criteria"),

    init: function(){
        
        // event listener on criteriaBtn 
        moreCriteria.criteriaBtn.addEventListener('click', moreCriteria.expandCriteria);
        
    },


    /**
     * Method to add criteria and reveal a new button to hide criteria on click event
     */
    expandCriteria: function() {
        const addCriteria = document.querySelectorAll(".criteria-expanded");
        const textBtn = moreCriteria.criteriaBtn.textContent;

        if (textBtn == "Plus de critères") {
            moreCriteria.criteriaBtn.textContent = "Moins de critères";
            addCriteria.forEach(function(criteria) {
                criteria.classList.remove("hidden");
            });

        } else {
            addCriteria.forEach(function(criteria) {
                criteria.classList.add("hidden");
            });
            moreCriteria.criteriaBtn.textContent = "Plus de critères";
        }
    },      
}

document.addEventListener('DOMContentLoaded', moreCriteria.init);
