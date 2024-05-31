// =========================================================================================
// this file contains functions used for form utilities within the system
// =========================================================================================
var form = document.querySelector('form.needs-validation')

$('button#login_btn').on('click', async () => {
    // only logs in if all fields are checked
    if (!checkEmptyFields(form)) return


})


// validates invalid and valid fields again every time the user changes input values
form.querySelectorAll('input[required]').forEach(field => {
    field.addEventListener('blur', () => {
        field.value = field.value.trim()

        validateField[field.name](field, form)
        debugger
    })
})