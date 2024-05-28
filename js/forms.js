function getCities(stateId) {
    $.post('../php/address.php', {function: 'getCities'})
}