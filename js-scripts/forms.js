// =========================================================================================
// this file contains functions used for form utilities within the system
// =========================================================================================

window.addEventListener('load', () => {

    if (document.querySelector('#state')) {
        getStates().then(states => {
            // creates an option in the selector for each state
            states.forEach(state => {

                const option = document.createElement('option');
                option.value = state.id_estado;
                option.innerText = state.nome_estado;
                
                document.getElementsByName('state').forEach(selector => selector.append(option));
            })
        })
    }

    if (document.querySelector('#service-type')) {
        getServiceTypes().then(serviceTypes => {   
            // creates an option in the selector for each service type
            serviceTypes.forEach(serviceType => {
            
                const option = document.createElement('option');
                option.value = serviceType.id_servico;
                option.innerText = serviceType.nome_servico;
                
                document.getElementsByName('service-type').forEach(selector => selector.append(option));
            })
        })
    }

    if (document.querySelector('#manifestation-type')) {
        getManifestationTypes().then(manifestationTypes => {
            // creates an option in the selector for each manifestation type
            manifestationTypes.forEach(manifestationType => {

                const option = document.createElement('option');
                option.value = manifestationType.id_tipo;
                option.innerText = manifestationType.nome_tipo;
                
                document.getElementsByName('manifestation-type').forEach(selector => selector.append(option));
            })
        })
    }
})

if (document.querySelector('#city')) {
    document.getElementsByName('state').forEach(element => 
        element.addEventListener('change', () => {

            document.getElementsByName('city').forEach(selector => selector.innerHTML = `<option selected>Cidade (selecione)*</option>`);

            var state = $(element).val();
            
            // if there was no selected state (the selected state having no numeric value), it disables the city selector and doesn't proceed
            if (!parseInt(state)) {
                document.getElementsByName('city').forEach(selector => selector.setAttribute('disabled', true));
                return;
            }

            // ... or it enables if any state was selected
            document.getElementsByName('city').forEach(selector => selector.removeAttribute('disabled'));
            
            getCities(state).then(cities => {

                // creates an option in the selector for each state
                cities.forEach(city => {

                    const option = document.createElement('option');
                    option.value = city.id_cidade;
                    option.innerText = city.nome_cidade;

                    document.getElementsByName('city').forEach(selector => selector.append(option));
                })
            }
            )

        })
    )
}

// TODO: make this vaildateForm() work and use it instead of Bootstraps
function checkFormValidity(form) {
    const formData = new FormData(form);
    var allValid = true;

    formData.entries().forEach(input => {
        if (validateField[input[0]]) {
            const formInput = form[input[0]];
            
            const validField = validateField[input[0]](formInput, form);

            // the next valid fields won't change the result if there was an invalid field before
            // this won't stop the verification though, as all invalid fields should be warned to the user
            if (!validField) {
                allValid = false;
            }
        }
    })

    return allValid;
}

async function checkFormAvailability(form) {
    const formData = new FormData(form);
    var allValid = true;

    await formData.entries().forEach(async input => {
        if (checkAvailable[input[0]]) {
            const formInput = form[input[0]];
            
            const available = await checkAvailable[input[0]](formInput, form);

            // the next valid fields won't change the result if there was an invalid field before
            // this won't stop the verification though, as all invalid fields should be warned to the user
            if (!available) {
                allValid = false;
            }
        }
    })

    return allValid;
}

function checkEmptyFields(form) {
    var hasEmpty = false;

    // goes through every field and checks if they are empty
    form.querySelectorAll('input[required], textarea[required]').forEach(field => {
        if (!field.value) {
            field.classList.add('is-invalid');
            field.classList.remove('is-valid');
            
            hasEmpty = true;
            return;
        }

        // if its not empty, return to the original no-warning form
        field.classList.remove('is-invalid');
    })
    
    form.querySelectorAll('select[required]').forEach(field => {
        if (!$.isNumeric(field.value)) {
            field.classList.add('is-invalid');
            field.classList.remove('is-valid');
            
            hasEmpty = true;
            return;
        }
        
        // if its not empty, return to the original no-warning form
        field.classList.remove('is-invalid');
    })

    return !hasEmpty;
}

function trimFields(form) {
    // iterates through every field and trims its value
    form.querySelectorAll('input, textarea, select').forEach(field => {
        // doesn't try trimming if input is type file
        if (field == form.querySelector('input[type=file]')) return;
        field.value = field.value.trim();
    })
}