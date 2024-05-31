// this function won't do anything by standard, only if the user registration was successful will it redirect to homepage
var closeModalAction = () => {}

// check form validity, then sign up
if ($('button#signup_btn')) {
    // this will be the function called when success or failure modal closes, and it will determine what will happen when modal is hidden

    $('button#signup_btn').on('click', async () => {
        var form = document.querySelector('form.needs-validation')

        
        // boolean function, checks each field of form and returns true if it's all valid
        const validForm = await checkFormValidity(form)
        
        if (!validForm) return
        
        // using FormData.entries() to create an object structured as {*input[i]_name*: *input[i]_value*}
        const formData = new FormData(form)
        const dataObj = Object.fromEntries(formData.entries())
        
        // sign up user with given data
        const userCreated = await createUser(dataObj)
        
        // activate error message modal if there was an error in user registration
        if (!userCreated) {
            $('#signupModalLabel').text('Erro ao realizar o cadastro')
            $('.modal-body').text('Ocorreu um erro na realização de seu cadastro. Por favor, tente novamente mais tarde.')

            $('#confirmModalBtn').hide()
            $('#closeModalBtn').show()

            $('#signupModal').modal('show')
            
            return
        } 
        
        // will set closeModalAction to direct to homepage if registration was successful
        closeModalAction = () => {
            window.location.href = '../'
        }

        // else activate success message modal
        $('#signupModalLabel').text('Sucesso!')
        $('.modal-body').text('Seu cadastro foi realizado com sucesso!')

        $('#closeModalBtn').hide()
        $('#confirmModalBtn').show()

        $('#signupModal').modal('show')
    })
}

if ($('#signupModal')) {
    $('#signupModal').on('hide.bs.modal', () => {
        closeModalAction()
    })
}

if ($('form#signup.needs-validation')) {
    form = document.querySelector('form.needs-validation')

    // validates invalid and valid fields again every time the user changes input values
    form.querySelectorAll('input').forEach(field => {
        field.addEventListener('blur', () => {
            field.value = field.value.trim()
            validateField[field.name](field, form)
        })
    })

    // also validates as before but with select fields
    form.querySelectorAll('select').forEach(field => {
        field.addEventListener('change', () => {
            validateField[field.name](field)

            // if state is changed, then city changes back as well
            if (field.name == 'state') {
                validateField['city'](form.city)
            }
        })
    })
}