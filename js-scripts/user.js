// =========================================================================================
// this file is dedicated to get user-related data from database, such as signup and login
// =========================================================================================

// function receives a data object containing the fields and their respective values
async function createUser(data) {
    var statusCode;
    await $.post(`${getPhpPath()}/user.php`, { function: 'createUser', ...data }, (response) => {
        statusCode = response;
    })

    statusCode = parseInt(statusCode.split(' ')[1]) || 500;

    // returns false if registration failed
    if (statusCode != 201) return false;

    return true;
}

async function loginUser(email, password) {
    var successfulLogin;

    await $.post(`${getPhpPath()}/user.php`, { function: 'loginUser', email, password }, (response) => {
        
        // function will retrieve 1 if login was successful, 0 if it wasn't
        successfulLogin = Boolean(parseInt(response));
    })

    return successfulLogin;
}

async function getLoggedUsername() {
    var username;

    await $.post(`${getPhpPath()}/user.php`, { function: 'getLoggedUsername' }, (response) => {
        username = response;
    })

    return username
}

async function getStates() {
    var states = [];

    // gets all states from table `estado` and adds them all as Objects to states array
    await $.post(`${getPhpPath()}/address.php`, { function: 'getStates' }, (response) => {
        const responseArr = response.split('//\\').filter(state => state.trim());
        
        responseArr.forEach(state => states.push(JSON.parse(state)));
    })
    
    return states;
}

async function getCities(stateId) {
    var cities = [];

    // gets all cities from table `cidade` from given state and adds them all as Objects to cities array
    await $.post(`${getPhpPath()}/address.php`, { function: 'getCities', state: stateId }, (response) => {
        const responseArr = response.split('//\\').filter(state => state.trim());

        responseArr.forEach(city => cities.push(JSON.parse(city)));
    })

    return cities;
}

window.onload = () => {
    if (document.querySelector('.username')) {
        getLoggedUsername().then(response => {
            // gets first name of logged user
            $('.username').text(response.split(' ')[0]);
        })
    }

    if (document.querySelector('.user-options')) {
        getLoggedUsername().then(response => {

        })
    }
}