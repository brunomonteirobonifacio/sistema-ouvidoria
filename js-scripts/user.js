// This file is dedicated to get user-related data from database, such as sign-up and log-in
async function createUser(data) {
    var statusCode
    await $.post('../php-scripts/user.php', { function: 'createUser', ...data }, (response) => {
        statusCode = response
    })

    statusCode = parseInt(statusCode.split(' ')[1]) || 500

    return statusCode

    if (statusCode != 201) return false

    return true
}