async function getServiceTypes() {
    
}

async function getManifestationTypes() {
    var types;

    await $.post(`${getPhpPath()}/manifestation.php`, { function: 'getManfestationTypes' }, (response) => {
        types = response;
    })

    return response;
}