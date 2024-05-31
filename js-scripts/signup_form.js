// check form validity, then sign up
if ($('button#signup_btn')) {
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

        // User creation working
        // TODO: activate a modal to show when user registration succeeds (or fails)
        if (!userCreated) {
            // activate error message modal
            return
        } 
        
        // else activate success message modal
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