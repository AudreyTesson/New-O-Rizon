const sort = {

    menuButton: document.getElementById('menu-button'),
    dropdownMenu:  document.getElementById('dropdownMenu'),
    closeIcon: document.getElementById('close-button'),

    init: function() {
        sort.menuButton.addEventListener('click', () => {
            sort.dropdownMenu.classList.toggle('hidden');
        });

        document.addEventListener('click', (event) => {
            const targetElement = event.target;
            if (!targetElement.closest('.relative')) {
                sort.dropdownMenu.classList.add('hidden');
            }
        });

        sort.closeIcon.addEventListener('click', (event) => {
            event.stopPropagation();
            sort.dropdownMenu.classList.add('hidden');
        });
    },
}

document.addEventListener('DOMContentLoaded', sort.init)