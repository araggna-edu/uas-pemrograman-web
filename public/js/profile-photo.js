window.onload = function () {
    var profilePhoto = document.getElementById('profilePhoto');
    var userName = profilePhoto.getAttribute('data-name');

    var initials = userName.split(' ').map(name => name.charAt(0)).join('');
    profilePhoto.textContent = initials;
}