async function getStates() {
    var states = []

    // gets all states from table `estado` and adds them all as Objects to states array
    await $.post('../php/address.php', {function: 'getStates'}, (response) => {
        responseArr = response.split('//\\').filter(state => state.trim())
        
        responseArr.forEach(state => states.push(JSON.parse(state)))
    })
    
    return states
}

async function getCities(stateId) {
    var cities = []

    // gets all cities from table `cidade` from given state and adds them all as Objects to cities array
    await $.post('../php/address.php', {function: 'getCities', state: stateId}, (response) => {
        responseArr = response.split('//\\').filter(state => state.trim())

        responseArr.forEach(city => cities.push(JSON.parse(city)))
    })

    return cities
}

if ($('estado')) {
    getStates().then(states => {
        states.forEach(state => {

            const option = document.createElement('option')
            option.value = state.id_estado
            option.innerText = state.nome_estado
            
            document.getElementsByName('estado').forEach(select => select.append(option))
        })
    })
}

if ($('cidade')) {
    document.getElementsByName('estado').forEach(element => 
        element.addEventListener('change', () => {

            document.getElementsByName('cidade').forEach(select => select.innerHTML = `<option selected>Cidade</option>`)

            var state = $(element).val()
            
            if (state == 'Estado') {
                document.getElementsByName('cidade').forEach(select => select.setAttribute('disabled', 'true'))
                return
            }

            document.getElementsByName('cidade').forEach(select => select.removeAttribute('disabled'))
            
            getCities(state).then(cities => {
                cities.forEach(city => {

                    const option = document.createElement('option')
                    option.value = city.id_cidade
                    option.innerText = city.nome_cidade

                    document.getElementsByName('cidade').forEach(select => select.append(option))
                })
            }
            )

        })
    )
}