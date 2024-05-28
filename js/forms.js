function getStates() {
    $.post('../pphp/address.php', {function: 'getStates'})
}

function getCities(stateId) {
    $.post('../php/address.php', {function: 'getCities', state: stateId}, (response) => {

    })
}


if ($('estado')) {
    let option = document.createElement('option')
    option.value = '1'
    option.innerText = 'pinto'

    document.querySelector('estado').append(option)
}