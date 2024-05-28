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

(() => {
    var form = document.querySelector('form.needs-validation')
        'use strict'
      
          form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
              event.preventDefault()
              event.stopPropagation()
            }
      
            form.classList.add('was-validated')

            
          }, false)
      })()
