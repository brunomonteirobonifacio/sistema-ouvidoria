function loadManifestationsAccordion(search = '') {
    var i = 0;
    getManifestations(search).then(manifestations => {
        const accordion = document.querySelector('#accordionManifestations');

        accordion.innerHTML = '';

        // creates an accordion item for each manifestation
        manifestations.forEach(async manifestation => {
            i++
            const item = document.createElement('div');
            
            // setting classes
            item.classList.add('accordion-item');
            item.classList.add('my-2');
            item.classList.add('border');

            const itemHeader = document.createElement('h2');

            // setting classes
            itemHeader.classList.add('accordion-header');

            const itemButton = document.createElement('button');

            // setting classes
            itemButton.classList.add('accordion-button');
            itemButton.classList.add('collapsed');

            // setting bootstrap attributes
            itemButton.setAttribute('type', 'button');
            itemButton.setAttribute('data-bs-toggle', 'collapse');
            itemButton.setAttribute('data-bs-target', '#item' + i);
            itemButton.setAttribute('aria-expanded', 'true');
            itemButton.setAttribute('aria-controls', 'item' + i);
            
            const itemCollapse = document.createElement('div');

            // setting ID and classes
            itemCollapse.id = `item${i}`;
            itemCollapse.classList.add('accordion-collapse');
            itemCollapse.classList.add('collapse');
            
            // setting bootstrap attributes
            itemCollapse.setAttribute('data-bs-parent', '#accordionManifestations');

            const itemBody = document.createElement('div');

            // setting ID and classes
            itemBody.classList.add('accordion-body');
            
            const itemDescription = document.createElement('div');

            // setting ID and classes
            itemDescription.classList.add('row');
            itemDescription.classList.add('text-start');
            itemDescription.id = 'description';
            
            const itemAttachments = document.createElement('div');
            
            // setting ID and classes
            itemAttachments.classList.add('row');
            itemAttachments.classList.add('text-start');
            itemAttachments.id = 'attachments';

            // adds values to their places
            let data = new Date(manifestation.data_ouvidoria);
            data = data.getDate() + '/' + data.getMonth() + '/' + data.getFullYear();

            itemButton.innerHTML = `${manifestation.protocolo_ouvidoria} <div class="vr mx-2"></div> ${manifestation.tipo_ouvidoria}, ${manifestation.tipo_servico_afetado} <div class="vr mx-2"></div> Data: ${data}`;
            
            itemDescription.innerHTML = `<div class="col"><span class="fw-bold">Descrição:</span> ${manifestation.descricao_ouvidoria}</div>`;
            
            // adds attachments right below the description
            const attachments = await getManifestationAttachments(manifestation.protocolo_ouvidoria);

            itemAttachments.innerHTML = '<span class="fw-bold"> Anexos: </span> <div class="row align-self-start">';

            attachments.forEach(attachment => {
                const file = attachment['arquivo_anexo'];

                // shows image if file is PNG JPEG or JPG, shows 

                // attachment type will be image or application (PDF)
                const attachmentType = file.split('/')[0].substring(5);

                if (attachmentType == 'image') {
                    itemAttachments.innerHTML += `<img src="${file}" class="img-thumbnail img-preview mx-2"/>`;
                    
                    return;
                }

                itemAttachments.innerHTML += `<iframe src="${file}" style="width:600px; height:500px;" frameborder="0"></iframe>`;
            })

            // appends all elements to accordion
            itemBody.append(itemDescription);
            itemBody.append(itemAttachments);

            itemHeader.append(itemButton);
            itemCollapse.append(itemBody);

            item.append(itemHeader);
            item.append(itemCollapse);
            
            accordion.append(item);
            
        })
    })
}

window.onload = () => {
    if (document.querySelector('#accordionManifestations')) {
        loadManifestationsAccordion()
    }
}

$('#searchInput').on('change', () => {
    const search = $('#searchInput').val().trim();
    loadManifestationsAccordion(search);
})
