function loadManifestationsAccordion(search = '') {
    var i = 0;
    getManifestations(search).then(manifestations => {
        const accordion = document.querySelector('#accordionManifestations');

        accordion.innerHTML = '';

        // if there were no manifestations, print on the screen and don't proceed the code
        if (!manifestations.length) {
            accordion.classList.add('text-center');
            accordion.innerHTML = '<p class="lead border fs-4 my-3 py-3">Nenhuma ouvidoria encontrada</p>';
            
            return;
        }

        accordion.classList.remove('text-center');
        
        // creates an accordion item for each manifestation
        manifestations.forEach(async manifestation => {
            i++
            const verticalRule = document.createElement(`div`);
            
            // setting classes
            verticalRule.classList.add('vr', 'mx-2')


            const item = document.createElement('div');

            // setting classes
            item.classList.add('accordion-item', 'my-2','border');

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
            itemCollapse.classList.add('accordion-collapse', 'collapse');
            
            // setting bootstrap attributes
            itemCollapse.setAttribute('data-bs-parent', '#accordionManifestations');


            const itemBody = document.createElement('div');

            // setting ID and classes
            itemBody.classList.add('accordion-body');
            

            const itemDescription = document.createElement('div');

            // setting ID and classes
            itemDescription.id = 'description';
            itemDescription.classList.add('row','text-start');
            

            const itemAttachments = document.createElement('div');
            
            // setting ID and classes
            itemAttachments.id = 'attachments';
            itemAttachments.classList.add('row', 'text-start');

            // adds values to text spans
            let date = new Date(manifestation.data_ouvidoria);
            date = date.getDate() + '/' + date.getMonth() + '/' + date.getFullYear();

            const protocolText = document.createElement('span');
            protocolText.textContent = manifestation.protocolo_ouvidoria;
            
            const serviceTypeText = document.createElement('span');
            serviceTypeText.textContent = manifestation.tipo_servico_afetado;

            const manifestationTypeText = document.createElement('span');
            manifestationTypeText.textContent = manifestation.tipo_ouvidoria;

            const dateText = document.createElement('span');
            dateText.textContent = 'Data: ' + date
            
            // adds all text spans
            itemButton.append(protocolText, verticalRule.cloneNode(true), serviceTypeText, verticalRule.cloneNode(true), manifestationTypeText, verticalRule.cloneNode(true), dateText)
            
            const descriptionDiv = document.createElement('div');
            descriptionDiv.classList.add('col');

            // adds description title to a bold-stlyled span, then description right after it
            const descriptionTitle = document.createElement('span');
            descriptionTitle.classList.add('fw-bold');
            descriptionTitle.textContent = 'Descrição: ';

            descriptionDiv.append(descriptionTitle);
            descriptionDiv.append(manifestation.descricao_ouvidoria);
            itemDescription.append(descriptionDiv);
            
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
