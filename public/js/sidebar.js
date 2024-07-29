document.addEventListener('DOMContentLoaded', () => {
    // Get the current URL path
    const currentPath = window.location.pathname.split('/')[1];
    console.log("Menu : " + currentPath);

    // Get all menu items
    const menuItems = document.querySelectorAll('.menu-item');

    // Loop through menu items and add 'bg-blue-500' class to the current page
    menuItems.forEach(item => {
        const itemId = item.getAttribute('id');


        if (itemId === covertHomeCurrentPath(currentPath)) {
            item.classList.add('bg-primary');
            item.classList.add('text-tileBackground');
        }
    });
});

function covertHomeCurrentPath(path) {

    if (path === "") {
        return "home"
    }

    return path
}