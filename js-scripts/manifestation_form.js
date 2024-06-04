$('#create_manifestation_btn').on('click', () => {
    const form = document.querySelector('form.needs-validation');
    
    
    if (!checkEmptyFields(form)) return;

    const fileInput = form.querySelector('#manifestation-attachments');
    const files = fileInput.files;

    const extensionPattern = /\.(jpe?g|pdf)$/i
    
    files.forEach(file => {
        // checks if file is type PDF or JPEG
        if (!extensionPattern.test(file.name)) {
            $('#invalid-attachment').text('Tipo de arquivo inválido.')
            fileInput.classList.add('is-invalid');
            fileInput.classList.remove('is-valid');
            
            return;
        }

        $('#invalid-attachment').text('É necessário pelo menos um anexo.')
        // convert attached files to B64 and insert in database
        const reader = new FileReader()
        
        reader.readAsDataURL(file)
        reader.onload = () => {
            
        }
    })
})