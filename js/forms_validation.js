function validEmail(emailInput) {
    const email = emailInput.value()
    const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/

    if (!emailPattern.test(email)) {
        
        return false;
    }
}

// TODO: make this vaildateForm() work and use it instead of Bootstraps
function checkFormValidity(form) {
    var allValid = true
    
    form.entries().forEach(input => {
        if (!allValid) return

        if (input[0] == 'email') {
            allValid = validEmail(input[1])

            if (!allValid) {
                document.getElementsByName(input[0]).style.color = red
            }

            return
        }

        if (input[0] == 'phone') {
            allValid = validPhone(input[1])
        }
    })

    return allValid
}

(() => {
    var form = document.querySelector('form.needs-validation')
        'use strict'
      
        $('button#signup_btn').click(() => {
            if (!checkFormValidity(form)) {
              event.preventDefault()
              event.stopPropagation()
            }

            form.classList.add('was-validated')

            // using FormData.entries() to create an object structured as {*input[i]_name*: *input[i]_value*}
            const formData = new FormData(form)
            const dataObj = Object.fromEntries(formData.entries())

            createUser(dataObj).then();
        }, false)
      })()
