// =========================================================================================
// this file contains functions used exclusively in signup
// =========================================================================================

// this will be the function called when success or failure modal closes, and it will determine what will happen when modal is hidden
// it won't do anything by standard, only if the user registration was successful will it redirect to homepage
var closeModalAction = () => {}

var form = document.querySelector('form.needs-validation');

// check form validity, then sign up
$('button#signup_btn').on('click', async () => {
    
    // boolean function, checks each field of form and returns true if it's all valid
    const validForm = checkFormValidity(form) && await checkFormAvailability(form);
    
    if (!validForm) return;
    
    // using FormData.entries() to create an object structured as {*input[i]_name*: *input[i]_value*}
    const formData = new FormData(form);
    const dataObj = Object.fromEntries(formData.entries());
    
    // sign up user with given data, function returns true for successful, false for failure
    const userCreated = await createUser(dataObj);
    
    // activate error message modal if there was an error in user registration
    if (!userCreated) {
        $('#signupModalLabel').text('Erro ao realizar o cadastro');
        $('.modal-body').text('Ocorreu um erro na realização de seu cadastro. Por favor, tente novamente mais tarde.');
    
        $('#confirmModalBtn').hide();
        $('#closeModalBtn').show();
    
        $('#signupModal').modal('show');
        
        return;
    } 
    
    // will set closeModalAction to direct to homepage if registration was successful
    closeModalAction = () => {
        window.location.href = '../';
    }

    // activate success message modal
    $('#signupModalLabel').text('Sucesso!');
    $('.modal-body').text('Seu cadastro foi realizado com sucesso!\nPor favor verifique seu E-mail para ativar sua conta');

    $('#closeModalBtn').hide();
    $('#confirmModalBtn').show();

    $('#signupModal').modal('show');
})

$('#signupModal').on('hide.bs.modal', () => {
    closeModalAction();
})

// validates invalid and valid fields again every time the user changes input values
form.querySelectorAll('input[required], select[required]').forEach(field => {
    field.addEventListener('blur', async () => {
        field.value = field.value.trim();
        
        
        // only checks availability if the field needs it
        if (checkAvailable[field.name]) {
            const availableField = await checkAvailable[field.name](field);

            if (!availableField) return;
        }
        
        validateField[field.name](field, form);
        
        // if state is changed, then city changes back and needs to be reverified
        if (field.name == 'state') {
            validateField['city'](form.city);
        }
    })
})