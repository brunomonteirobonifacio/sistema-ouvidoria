// =========================================================================================
// this file contains functions used exclusively in manifestation creation
// =========================================================================================

var form = document.querySelector('form.needs-validation');

// this will be the function called when success or failure modal closes, and it will determine what will happen when modal is hidden
// it won't do anything by standard, only if the user registration was successful will it redirect to homepage
var closeModalAction = () => {}

$('#create_manifestation_btn').on('click', async () => {

    trimFields(form);

    if (!checkEmptyFields(form) || !checkFormValidity(form)) return;
    
    const fileInput = form.querySelector('input#attachments');

    // assures the files are inside an array, even if its a single file
    const files = [ ...fileInput.files ];
    var filesInB64 = [];

    const extensionPattern = /\.(jpe?g|pdf|png)$/i;
    
    files.forEach(file => {
        // checks if file is type PDF or JPEG
        if (!extensionPattern.test(file.name)) {
            $('#invalid-attachment').text('Tipo de arquivo inválido.')
            fileInput.classList.add('is-invalid');
            fileInput.classList.remove('is-valid');
            
            return;
        }
        
        // resets error message in case file is valid
        $('#invalid-attachment').text('É necessário pelo menos um anexo.')
        fileInput.classList.remove('is-invalid');
        
        var reader = new FileReader();
            
        // after if reads, the B64 file is added to filesInB64 array
        reader.onload = () => {
            filesInB64.push(reader.result);
        }
        
        reader.onloadend = async () => {
            // assures that the action will only be done after all files are added to the array
            if (files.length != filesInB64.length) return;
            
            const formData = new FormData(form);
            let formDataObj = Object.fromEntries(formData.entries());
            
            // adding images as base64 to the form Data object
            formDataObj.files = filesInB64;
            
            // creates manifestation with given data, function returns protocol for successful, false for failure
            const manifestationProtocol = await createManifestation(formDataObj);

            if (!manifestationProtocol) {
                $('#createManifestModalLabel').text('Erro na criação da ouvidoria');
                $('.modal-body').text('Ocorreu um erro na criação de sua ouvidoria. Por favor, tente novamente mais tarde');
            
                $('#closeModalBtn').show();
                $('#confirmModalBtn').hide();
            
                $('#createManifestModal').modal('show');

                return;
            }

            // will set closeModalAction to direct to homepage if registration was successful
            closeModalAction = () => {
                window.location.href = '../';
            }

            $('#createManifestModalLabel').text('Ouvidoria criada com sucesso!');
            $('.modal-body').text(`Número de protocolo: ${manifestationProtocol}`);
        
            $('#closeModalBtn').hide();
            $('#confirmModalBtn').show();
        
            $('#createManifestModal').modal('show');
        }

        // reads file as B64
        reader.readAsDataURL(file)
    })
})

$('#createManifestModal').on('hide.bs.modal', () => {
    closeModalAction();
})

// goes through every field and checks if they are empty
form.querySelectorAll('input[required], textarea[required]').forEach(field => {
    $(field).on('change', () => {

        if (!field.value.trim()) {
            field.classList.add('is-invalid');
            field.classList.remove('is-valid');
            
            return;
        }
        
        

        // if its not empty, return to the original no-warning form
        field.classList.remove('is-invalid');
    })
})

form.querySelectorAll('select[required]').forEach(field => {
    $(field).on('change', () => {

        if (!validateField[field.name](field, form, false)) {
            field.classList.add('is-invalid');
            field.classList.remove('is-valid');
            
            return;
        }
        
        // if its not empty, return to the original no-warning form
        field.classList.remove('is-invalid');
    })
})