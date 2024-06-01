// =========================================================================================
// this file is dedicated to get user-related data from database, such as signup and login
// =========================================================================================

async function createUser(data) {
    var statusCode;
    await $.post('../php-scripts/user.php', { function: 'createUser', ...data }, (response) => {
        statusCode = response;
        debugger
    })

    statusCode = parseInt(statusCode.split(' ')[1]) || 500;

    // returns false if registration failed
    if (statusCode != 201) return false;

    return true;
}

async function loginUser(email, password) {
    var successfulLogin;

    await $.post('../php-scripts/user.php', { function: 'loginUser', email: email, password: password }, (response) => {
        
        // function will retrieve 1 if login was successful, 0 if it wasn't
        successfulLogin = Boolean(parseInt(response));
    })

    return successfulLogin;
}