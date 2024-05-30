function validName(nameInput) {
    const name = nameInput.value

    // checks if the "full name" is at least 2 words long
    if (name.split(' ').length < 2) {
        nameInput.classList.remove('is-valid')
        nameInput.classList.add('is-invalid')
        
        return false;
    }

    nameInput.classList.add('is-valid')
    nameInput.classList.remove('is-invalid')

    return true;
}

async function validEmail(emailInput) {
    const email = emailInput.value

    // checks if the Email is already registered
    var isValid
    await $.post('../php-scripts/user.php', { function: 'checkEmail', email: emailInput.value }, (response) => {
        isValid = !Boolean(parseInt(response))
    }).then(() => {
        if (!isValid) { 
            document.getElementById('invalid-email').innerText = 'Este E-mail já está em uso.'
            cpfInput.classList.remove('is-valid')
            cpfInput.classList.add('is-invalid')
            
            return
        }
    
    document.getElementById('invalid-email').innerText = 'Digite um endereço de E-mail válido.'
    })

    // doesn't proceed the verification if the E-mail is already in use
    if (!isValid) return false

    // this pattern would be *any characters but space*@*any characters but space*.*2 or 3 letters*
    const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/

    if (!emailPattern.test(email)) {
        emailInput.classList.remove('is-valid')
        emailInput.classList.add('is-invalid')
        return false;
    }
    
    emailInput.classList.remove('is-invalid')
    emailInput.classList.add('is-valid')
    return true;
}

async function validPhone(phoneInput) {
    const phone = phoneInput.value
    
    // this indicates whether it's a whatsapp number or a phone number
    const phoneType = phoneInput.name
    
    // checks if the phone or whatsapp number is already registered
    var isValid
    await $.post('../php-scripts/user.php', { function: `check${phoneType[0].toUpperCase() + phoneType.substring(1)}`, phone: phoneInput.value }, (response) => {
        isValid = !Boolean(parseInt(response))
    }).then(() => {
        if (!isValid) { 
            // changes the invalid-feedback message
            document.getElementById(`invalid-${phoneType}`).innerText = phoneType == 'phone' ? 'Este número de telefone já está em uso.' : 'Este número WhatsApp já está em uso.'
            cpfInput.classList.remove('is-valid')
            cpfInput.classList.add('is-invalid')
            
            return
        }
        
        // changse back the invalid-feedback message
        document.getElementById(`invalid-${phoneType}`).innerText = 'Digite um número ' + (phoneType == 'phone' ? 'de telefone' : 'WhatsApp') + ' válido.'
    })

    // doesn't proceed the verification if the phone number is already in use
    if (!isValid) return false

    // this pattern takes possible DDD digits combinations, first number being 9, and all numbers being filled in, into consideration
    const phonePattern = /^\((?:[14689][1-9]|2[12478]|3[1234578]|5[1345]|7[134579])\) (?:[2-8]|9[0-9])[0-9]{3}\-[0-9]{4}$/
    
    if (!phonePattern.test(phone)) {
        phoneInput.classList.remove('is-valid')
        phoneInput.classList.add('is-invalid')
        return false;
    }
    
    phoneInput.classList.remove('is-invalid')
    phoneInput.classList.add('is-valid')
    return true;
}

async function validCPF(cpfInput) {
    const cpf = $(cpfInput).cleanVal()  // getting the value without its mask

    // checks if the CPF is already registered
    var isValid = false
    await $.post('../php-scripts/user.php', { function: 'checkCPF', cpf: cpfInput.value }, (response) => {
        isValid = !Boolean(parseInt(response))
    }).then(() => {
        if (!isValid) {            
            document.getElementById('invalid-cpf').innerText = 'Este CPF já está em uso.'
            cpfInput.classList.remove('is-valid')
            cpfInput.classList.add('is-invalid')
            
            return
        }
        
        document.getElementById('invalid-cpf').innerText = 'Digite um CPF válido.'
    })
    
    // doesn't proceed the verification if CPF is already in use
    if (!isValid) return false

    var sum = 0, rest
        
    // checks if all cpf digits are the same
    if (cpf.split('').filter((digit, index) => digit == cpf[index - 1] || !cpf[index - 1]).join('') == cpf) {
        cpfInput.classList.remove('is-valid')
        cpfInput.classList.add('is-invalid')
        
        return false
    }

    for (i = 1; i <= 9; i++) {
        sum = sum + parseInt(cpf.substring(i-1, i)) * (11 - i)
    }
    
    rest = (sum * 10) % 11
  
    if ((rest == 10) || (rest == 11)) {
        rest = 0
    }

    if (rest != parseInt(cpf.substring(9, 10))) {
        cpfInput.classList.remove('is-valid')
        cpfInput.classList.add('is-invalid')

        return false
    }
  
    sum = 0
    for (i = 1; i <= 10; i++) {
        sum = sum + parseInt(cpf.substring(i-1, i)) * (12 - i)
    }
    
    rest = (sum * 10) % 11
  
    if ((rest == 10) || (rest == 11)) {
        rest = 0
    }

    if (rest != parseInt(cpf.substring(10, 11))) {
        cpfInput.classList.remove('is-valid')
        cpfInput.classList.add('is-invalid')

        return false
    }
    
    return true
    
}

function validBirthdate(birthdateInput) {
    if (!birthdateInput.value) {
        birthdateInput.classList.remove('is-valid')
        birthdateInput.classList.add('is-invalid')
    
        return false
    }

    const birthdate = new Date(birthdateInput.value)

    // minDate = today - 18 years
    let minDate = new Date(Date.now())
    minDate.setFullYear(minDate.getFullYear() - 18)

    // checks if the birthdate adds up to at least 18 years
    if (birthdate > minDate) {
        birthdateInput.classList.remove('is-valid')
        birthdateInput.classList.add('is-invalid')
    
        return false
    }

    birthdateInput.classList.add('is-valid')
    birthdateInput.classList.remove('is-invalid')

    return true
}

function validState(stateInput) {
    const state = parseInt(stateInput.value) || 0
    debugger
    // checks if the state chosen has am invalid ID
    if (state < 1 || state > 27) {
        stateInput.classList.remove('is-valid')
        stateInput.classList.add('is-invalid')
        
        return false
    }
    
    stateInput.classList.add('is-valid')
    stateInput.classList.remove('is-invalid')
    
    return true

}

function validCity(cityInput) {
    // someone help me, oh please god help me
    
}