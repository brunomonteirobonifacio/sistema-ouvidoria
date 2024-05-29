function validEmail(emailInput) {
    const email = emailInput.value
    const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/
    // this pattern would be *any characters but space*@*any characters but space*.*2 or 3 letters*

    if (!emailPattern.test(email)) {
        emailInput.classList.remove('is-valid')
        emailInput.classList.add('is-invalid')
        return false;
    }
    
    emailInput.classList.remove('is-invalid')
    emailInput.classList.add('is-valid')
    return true;
}

function validPhone(phoneInput) {
    const phone = phoneInput.value
    const phonePattern = /^\((?:[14689][1-9]|2[12478]|3[1234578]|5[1345]|7[134579])\) (?:[2-8]|9[0-9])[0-9]{3}\-[0-9]{4}$/
    // this pattern takes possible DDD digits combinations, first number being 9, and all numbers being filled in, into consideration
    
    if (!phonePattern.test(phone)) {
        phoneInput.classList.remove('is-valid')
        phoneInput.classList.add('is-invalid')
        return false;
    }
    
    phoneInput.classList.remove('is-invalid')
    phoneInput.classList.add('is-valid')
    return true;
}

function validCPF(cpfInput) {
    const cpf = $(cpfInput).cleanVal()  // getting the value without its mask
    
    var sum = 0,
        rest

    if (cpf == '00000000000') {
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

    if (isValidCpf) {
        cpfInput.classList.remove('is-valid')
        cpfInput.classList.add('is-invalid')

        return false
    }
}