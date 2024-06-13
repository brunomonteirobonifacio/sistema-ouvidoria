// =========================================================================================
// this file will contain field validation functions
// =========================================================================================

function validName(nameInput, form) {
    const name = nameInput.value;

    // checks if the "full name" is at least 2 words long
    if (name.split(' ').length < 2) {
        nameInput.classList.remove('is-valid');
        nameInput.classList.add('is-invalid');
        
        return false;
    }

    nameInput.classList.add('is-valid');
    nameInput.classList.remove('is-invalid');

    return true;
}

function validEmail(emailInput, form) {
    const email = emailInput.value;

    // this pattern would be *word characters, - or .*@*word characters or -*.*2 or 4 letters*
    const emailPattern = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;

    if (!emailPattern.test(email)) {
        emailInput.classList.remove('is-valid');
        emailInput.classList.add('is-invalid');

        return false;
    }
    
    emailInput.classList.remove('is-invalid');
    emailInput.classList.add('is-valid');

    return true;
}

function validPhone(phoneInput, form) {
    const phone = phoneInput.value;

    // this pattern takes possible DDD digits combinations, first number being 9, and all numbers being filled in, into consideration
    const phonePattern = /^\((?:[14689][1-9]|2[12478]|3[1234578]|5[1345]|7[134579])\) (?:[2-8]|9[0-9])[0-9]{3}\-[0-9]{4}$/;
    
    if (!phonePattern.test(phone)) {
        phoneInput.classList.remove('is-valid');
        phoneInput.classList.add('is-invalid');

        return false;
    }
    
    phoneInput.classList.remove('is-invalid');
    phoneInput.classList.add('is-valid');

    return true;
}

function validCPF(cpfInput, form) {
    const cpf = $(cpfInput).cleanVal();     // getting the value without its mask

    var sum = 0, rest;
        
    // checks if all cpf digits are the same
    if (cpf.split('').filter((digit, index) => digit == cpf[index - 1] || !cpf[index - 1]).join('') == cpf) {
        cpfInput.classList.remove('is-valid');
        cpfInput.classList.add('is-invalid');
        
        return false;
    }

    for (i = 1; i <= 9; i++) {
        sum = sum + parseInt(cpf.substring(i - 1, i)) * (11 - i);
    }
    
    rest = (sum * 10) % 11;
  
    if ((rest == 10) || (rest == 11)) {
        rest = 0;
    }

    if (rest != parseInt(cpf.substring(9, 10))) {
        cpfInput.classList.remove('is-valid');
        cpfInput.classList.add('is-invalid');

        return false;
    }
  
    sum = 0
    for (i = 1; i <= 10; i++) {
        sum = sum + parseInt(cpf.substring(i-1, i)) * (12 - i);
    }
    
    rest = (sum * 10) % 11;
  
    if ((rest == 10) || (rest == 11)) {
        rest = 0;
    }

    if (rest != parseInt(cpf.substring(10, 11))) {
        cpfInput.classList.remove('is-valid');
        cpfInput.classList.add('is-invalid');
        
        return false
    }

    cpfInput.classList.add('is-valid');
    cpfInput.classList.remove('is-invalid');
    
    return true;
    
}

function validBirthdate(birthdateInput, form) {
    if (!birthdateInput.value) {
        birthdateInput.classList.remove('is-valid');
        birthdateInput.classList.add('is-invalid');
    
        return false;
    }

    const birthdate = new Date(birthdateInput.value);

    // minDate = today - 18 years
    let minDate = new Date(Date.now());
    minDate.setFullYear(minDate.getFullYear() - 18);

    // checks for an impossible birthdate
    if (birthdate <= new Date('1900-12-31') || birthdate >= new Date(Date.now())) {
        birthdateInput.classList.remove('is-valid');
        birthdateInput.classList.add('is-invalid');
    
        document.getElementById('invalid-date').innerText = 'Digite uma data válida.';
        
        return false;
    }
    
    document.getElementById('invalid-date').innerText = 'É necessário ter mais de 18 anos para realizar o cadastro.';

    // checks if the birthdate adds up to at least 18 years
    if (birthdate > minDate) {
        birthdateInput.classList.remove('is-valid');
        birthdateInput.classList.add('is-invalid');
    
        return false;
    }

    birthdateInput.classList.add('is-valid');
    birthdateInput.classList.remove('is-invalid');

    return true;
}

function validState(stateInput, form) {
    const state = parseInt(stateInput.value) || 0;

    // checks if the state chosen has am invalid ID
    if (state < 1 || state > 27) {
        stateInput.classList.remove('is-valid');
        stateInput.classList.add('is-invalid');
        
        return false;
    }
    
    stateInput.classList.add('is-valid');
    stateInput.classList.remove('is-invalid');
    
    return true;
}

function validCity(cityInput, form) {
    const city = parseInt(cityInput.value) || 0;
    
    // checks if the city chosen has am invalid ID
    if (city < 1 || city > 5564) {
        cityInput.classList.remove('is-valid');
        cityInput.classList.add('is-invalid');
        
        return false;
    }

    cityInput.classList.add('is-valid');
    cityInput.classList.remove('is-invalid');
    
    return true;
}

// passwords must be at laest 8 characters long, contain uppercase and lowercase letters, at least one special character and at least one numnber
function validPassword(passwordInput, form) {
    const password = passwordInput.value.trim();
    const confirmPasswordInput = form.confirm_password;

    // checks if there is at least one lowercase and one uppercase letter
    const hasUpperAndLower = Boolean(password.split('').filter(char => char === char.toUpperCase() && /[a-zA-Z]/.test(char)).length && password.split('').filter(char => char === char.toLowerCase() && /[a-zA-Z]/.test(char)).length);
    
    // checks if there is at least one special character
    const hasSpecialCharacters = Boolean(password.split('').filter(char => !(/[^A-Za-z0-9]/.test(char))).length);
    
    // checks if there is at least one numeric character
    const hasNumeric = Boolean(password.split('').filter(char => $.isNumeric(char)).length);

    if (!hasUpperAndLower || !hasSpecialCharacters || !hasNumeric || password.length < 8) {
        passwordInput.classList.remove('is-valid');
        passwordInput.classList.add('is-invalid');

        confirmPasswordInput.classList.remove('is-valid');
        confirmPasswordInput.classList.add('is-invalid');
        
        document.querySelector('.password_requirements').style.color = 'var(--bs-form-invalid-color)';
        document.getElementById('invalid-password').innerText = 'Digite uma senha válida.';
        
        return false;
    }
    
    
    document.querySelector('.password_requirements').style.color = 'var(--bs-form-valid-color)';

    passwordInput.classList.add('is-valid');
    passwordInput.classList.remove('is-invalid');
    
    return true;
}

function validConfirmPassword(confirmPasswordInput, form) {
    const confirmPassword = confirmPasswordInput.value.trim();
    const passwordInput = form.password;
    const password = form.password.value.trim();
    
    if (password !== confirmPassword || password == '' || confirmPassword == '') {
        passwordInput.classList.remove('is-valid');
        passwordInput.classList.add('is-invalid');

        confirmPasswordInput.classList.remove('is-valid');
        confirmPasswordInput.classList.add('is-invalid');
        
        document.querySelector('.password_requirements').style.color = 'var(--bs-form-invalid-color)';
        
        document.getElementById('invalid-password').innerText = 'Digite uma senha válida.';

        if (password != '' || confirmPassword != '') {
            document.getElementById('invalid-password').innerText = 'Ambas as senhas precisam ser iguais.';
        }
        
        return false;
    }

    if (!validPassword(passwordInput, form)) {
        passwordInput.classList.remove('is-valid');
        passwordInput.classList.add('is-invalid');

        confirmPasswordInput.classList.remove('is-valid');
        confirmPasswordInput.classList.add('is-invalid');

        document.querySelector('.password_requirements').style.color = 'var(--bs-form-invalid-color)';
        document.getElementById('invalid-password').innerText = 'Digite uma senha válida.';

        return false;
    }

    document.querySelector('.password_requirements').style.color = 'var(--bs-form-valid-color)';

    passwordInput.classList.add('is-valid');
    passwordInput.classList.remove('is-invalid');

    confirmPasswordInput.classList.add('is-valid');
    confirmPasswordInput.classList.remove('is-invalid');

    return true;
}

// TODO: Refactor code and split apart valid from available

async function availableEmail(emailInput) {

    // checks if the Email is already registered
    var isAvaliable;
    await $.post('../php-scripts/user.php', { function: 'checkEmail', email: emailInput.value }, (response) => {
        isAvaliable = !Boolean(parseInt(response));
    }).then(() => {
        if (!isAvaliable) { 
            document.getElementById('invalid-email').innerText = 'Este E-mail já está em uso.';
            emailInput.classList.remove('is-valid');
            emailInput.classList.add('is-invalid');
            
            return;
        }
    
        // changes back the invalid-feedback message
        document.getElementById('invalid-email').innerText = 'Digite um endereço de E-mail válido.';
    })

    return isAvaliable;
}

async function availablePhone(phoneInput) {

    // this indicates whether it's a whatsapp number or a phone number
    const phoneType = phoneInput.name;
    
    // checks if the phone or whatsapp number is already registered
    var isAvaliable;
    await $.post('../php-scripts/user.php', { function: `check${phoneType[0].toUpperCase() + phoneType.substring(1)}`, phone: phoneInput.value }, (response) => {
        isAvaliable = !Boolean(parseInt(response));
    }).then(() => {
        if (!isAvaliable) { 
            // changes the invalid-feedback message
            document.getElementById(`invalid-${phoneType}`).innerText = phoneType == 'phone' ? 'Este número de telefone já está em uso.' : 'Este número WhatsApp já está em uso.';
            phoneInput.classList.remove('is-valid');
            phoneInput.classList.add('is-invalid');
            
            return;
        }
        
        // changse back the invalid-feedback message
        document.getElementById(`invalid-${phoneType}`).innerText = 'Digite um número ' + (phoneType == 'phone' ? 'de telefone' : 'WhatsApp') + ' válido.';
    })

    return isAvaliable;
}

async function availableCPF(cpfInput) {

    // checks if the CPF is already registered
    var isAvaliable = false;
    await $.post('../php-scripts/user.php', { function: 'checkCPF', cpf: cpfInput.value }, (response) => {
        isAvaliable = !Boolean(parseInt(response));
    }).then(() => {
        if (!isAvaliable) {            
            document.getElementById('invalid-cpf').innerText = 'Este CPF já está em uso.';
            cpfInput.classList.remove('is-valid');
            cpfInput.classList.add('is-invalid');
            
            return;
        }
    })

    return isAvaliable;
}

// an object containing every field validator
var validateField = {
    name: validName,
    email: validEmail,    
    phone: validPhone,
    whatsapp: validPhone,
    cpf: validCPF,
    birthdate: validBirthdate,
    state: validState,
    city: validCity,
    password: validPassword,
    confirm_password: validConfirmPassword
}

// an object containing availability check for every needed field
var checkAvailable = {
    email: availableEmail,
    phone: availablePhone,
    whatsapp: availablePhone,
    cpf: availableCPF,
}