function validEmail(emailInput) {
    const email = emailInput.value()
    const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/

    if (!emailPattern.test(email)) {

    }
}

function validateForm(form) {
    
    form.entries().forEach(input => {
        let allValid = true

        if (input[0] == 'email') {
            allValid = !allValid || validEmail(input[1])

            
        }

        if (input[0] == 'telefone') {
            
        }
    })
}

if (form = document.querySelector('form.needs-validation')){
    (() => {
        $('.validate_form').click(() => {
            if (!form.checkValidity()) {
                return
              }
          
              form.classList.add('was-validated')
          
        })
    })()
}