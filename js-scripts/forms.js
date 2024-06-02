// =========================================================================================
// this file contains functions used for form utilities within the system
// =========================================================================================

async function getStates() {
    var states = [];

    // gets all states from table `estado` and adds them all as Objects to states array
    await $.post(`${getPhpPath()}/address.php`, { function: 'getStates' }, (response) => {
        const responseArr = response.split('//\\').filter(state => state.trim());
        
        responseArr.forEach(state => states.push(JSON.parse(state)));
    })
    
    return states;
}

async function getCities(stateId) {
    var cities = [];

    // gets all cities from table `cidade` from given state and adds them all as Objects to cities array
    await $.post(`${getPhpPath()}/address.php`, { function: 'getCities', state: stateId }, (response) => {
        const responseArr = response.split('//\\').filter(state => state.trim());

        responseArr.forEach(city => cities.push(JSON.parse(city)));
    })

    return cities;
}

window.addEventListener('load', () => {

    if ($('state')) {
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

    if ($('service-type')) {
        getServiceTypes().then(serviceType => {

        })
    }

    if ($('manifestation-type')) {

    }
})

if ($('city')) {
    document.getElementsByName('state').forEach(element => 
        element.addEventListener('change', () => {

            document.getElementsByName('city').forEach(selector => selector.innerHTML = `<option selected>Cidade *</option>`);

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
    form.querySelectorAll('input[required]').forEach(field => {
        if (!field.value.trim()) {
            field.classList.add('is-invalid');
            field.classList.remove('is-valid');
            
            hasEmpty = true;
        }
    })

    if (hasEmpty) {
        return false;
    }

    form.querySelectorAll('select[required]').forEach(field => {
        if (!$.isNumeric(field.value)) {
            field.classList.add('is-invalid');
            field.classList.remove('is-valid');
            
            hasEmpty = true;
        }
    })

    return !hasEmpty;
}