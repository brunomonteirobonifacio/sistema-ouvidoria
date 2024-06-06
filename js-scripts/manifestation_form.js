$('#create_manifestation_btn').on('click', async () => {
    const form = document.querySelector('form.needs-validation');
    
    // if (!checkEmptyFields(form)) return;
    
    // TODO: Insert data on `ouvidoria` table and get its ID, then insert attachments in `anexo` table linked to the manifestation's ID

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
        
        // convert attached files to B64 and insert in database
        var reader = new FileReader();
            
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
            
            // creates manifestation with given data, function returns true for successful, false for failure
            const manifestationCreated = await createManifestation(formDataObj);
    
            if (!manifestationCreated) {
                
            }
        }

        reader.readAsDataURL(file)

    })
})
