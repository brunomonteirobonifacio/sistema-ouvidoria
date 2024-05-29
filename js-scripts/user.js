// This file is dedicated to get user-related data from database, such as sign-up and log-in
async function createUser(data) {
    await $.post('../php-scripts/user.php', { function: 'createUser', ...data }, (response) => {
        
    })
}