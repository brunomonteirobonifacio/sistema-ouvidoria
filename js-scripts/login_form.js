// =========================================================================================
// this file contains functions used for form utilities within the system
// =========================================================================================

var form = document.querySelector('form.needs-validation')

$('button#login_btn').on('click', async () => {

    // only logs in if all fields are checked
    if (!checkEmptyFields(form)) return;

    // ... else it attempts to login
    const emailValue = form.email.value
    const passwordValue = form.password.value;

    // function will return true if successful, false if failed
    const userLogged = await loginUser(emailValue, passwordValue)

    if (!userLogged) {
        form.email.classList.add('is-invalid');    
        form.email.classList.remove('is-valid');
        $('#invalid-email').text('');
        
        form.password.classList.add('is-invalid');        
        form.password.classList.remove('is-valid');
        $('#invalid-password').text('Endereço de E-mail ou senha digitados estão incorretos.');

        return;
    }


    $('#loginModalLabel').text('Sucesso!');
    $('.modal-body').text('Login realizado com sucesso!');

    $('#closeModalBtn').hide();
    $('#confirmModalBtn').show();

    $('#loginModal').modal('show');
})

$('#loginModal').on('hide.bs.modal', () => {
    window.location.href = '../';
})