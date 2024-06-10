window.onload = async () => {
    if (document.querySelector('span.service-types')) {
        const serviceTypes = await getServiceTypes();

        // display service types on span
        $('span.service-types').text(serviceTypes.map(serviceType => serviceType.nome_servico).join(', '))
    }

    if (document.querySelector('ul.manifestation-types-list')) {
        const list = document.querySelector('ul.manifestation-types-list');

        const manifestationTypes = await getManifestationTypes();
        
        manifestationTypes.forEach(manifestationType => {
            const typeItem = document.createElement('li');
            typeItem.innerHTML = `<span class="fw-bold"> ${manifestationType.nome_tipo} </span> ${manifestationType.descricao_tipo}`;

            list.append(typeItem);
        })
    }
}

const createManifestationSelector = document.querySelector('#createManifestationSelector');
const viewManifestationSelector = document.querySelector('#viewManifestationSelector');

createManifestationSelector.addEventListener('click', () => {
    createManifestationSelector.setAttribute('aria-current', 'page');
    viewManifestationSelector.removeAttribute('aria-current');
    
    createManifestationSelector.classList.add('active');
    viewManifestationSelector.classList.remove('active');

    // adding cursor interaction
    createManifestationSelector.style = '';
    viewManifestationSelector.style.cursor = 'pointer';
    
    $('#viewManifestationIntroduction').hide();
    $('#createManifestationIntroduction').show();
})
    
viewManifestationSelector.addEventListener('click', () => {
    viewManifestationSelector.setAttribute('aria-current', 'page');
    createManifestationSelector.removeAttribute('aria-current');

    viewManifestationSelector.classList.add('active');
    createManifestationSelector.classList.remove('active');

    // adding cursor interaction
    viewManifestationSelector.style = '';
    createManifestationSelector.style.cursor = 'pointer';
    
    document.querySelector('#viewManifestationSelector').removeAttribute('aria-current');
    document.querySelector('#createManifestationSelector').setAttribute('aria-current', 'page');

    $('#createManifestationIntroduction').hide()
    $('#viewManifestationIntroduction').show()
})