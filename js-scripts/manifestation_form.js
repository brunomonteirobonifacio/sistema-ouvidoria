$('#create_manifestation_btn').on('click', () => {
    const form = document.querySelector('form.needs-validation');
    
    if (!checkEmptyFields(form)) return;
    
    // TODO: Insert data on `ouvidoria` table and get its ID, then insert attachments in `anexo` table linked to the manifestation's ID

    const fileInput = form.querySelector('#manifestation-attachments');

    // assures the files are inside an array, even if its a single file
    const files = [ ...fileInput.files ];

    const extensionPattern = /\.(jpe?g|pdf|png)$/i
    
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

        // convert attached files to B64 and insert in database
        const reader = new FileReader()
        
        reader.readAsDataURL(file)
        reader.onload = () => {
            const base64Image = reader.result;

            // TODO: insert attachments linked to the manifestation's ID
        }
    })
})