async function getServiceTypes() {
    var serviceTypes = [];

    // gets all service types from table `servico_afetado` and adds them all as Objects to serviceTypes array
    await $.post(`${getPhpPath()}/manifestation.php`, { function: 'getServiceTypes' }, (response) => {
        const responseArr = response.split('//\\').filter(serviceType => serviceType.trim());
        
        responseArr.forEach(serviceType => serviceTypes.push(JSON.parse(serviceType)));
    })
    
    return serviceTypes;
}

async function getManifestationTypes() {
    var  manifestationTypes = [];
    
    // gets all manifestation types from table `tipo_ouvidoria` and adds them all as Objects to manifestationTypes array
    await $.post(`${getPhpPath()}/manifestation.php`, { function: 'getManifestationTypes' }, (response) => {
        const responseArr = response.split('//\\').filter(manifestationType => manifestationType.trim());
        
        responseArr.forEach(manifestationType => manifestationTypes.push(JSON.parse(manifestationType)));
    })
    
    return manifestationTypes;
}

// function receives a data object containing the fields and their respective values
async function createManifestation(data) {
    var protocol;
    
    await $.post(`${getPhpPath()}/manifestation.php`, { function: 'createManifestation', ...data }, (response) => {
        protocol = response;
    })
    
    // returns false if registration failed
    if (protocol.split(' ')[1] == '500') return false;
    
    // returns the manifestation protocol if it was succeeded
    return protocol;
}

async function getManifestations() {
    var manifestations = [];
    
    await $.post(`${getPhpPath()}/manifestation.php`, { function: 'getManifestations' }, (response) => {
        const responseArr = response.split('//\\').filter(manifestation => manifestation.trim());
        
        responseArr.forEach(manifestation => manifestations.push(JSON.parse(manifestation)));
    })

    return manifestations;
}