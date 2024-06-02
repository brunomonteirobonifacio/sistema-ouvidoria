// =========================================================================================
// this file contains general purpouse functions used within the system
// =========================================================================================

function getPhpPath() {
    const local = window.location.pathname;
    const directory = local.substring(0, local.lastIndexOf('/'));
    let phpPath = '';

    // checks if current folder is root folder
    if (directory.split('/')[directory.split('/').length - 1] != directory.split('/')[1]) {
        phpPath = '../';
    }

    phpPath += 'php-scripts';

    return phpPath
}

if ($('.username')) {
    getLoggedUsername().then(response => {
        document.querySelector('.username').innerText = response
    })
}