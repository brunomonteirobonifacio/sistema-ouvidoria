if (document.querySelector('#accordionManifestations')) {
    var i = 0;
    getManifestations().then(manifestations => {
        const accordion = document.querySelector('#accordionManifestations');

        // creates an accordion item for each manifestation
        manifestations.forEach(async manifestation => {
            i++
            const item = document.createElement('div');
            
            // setting classes
            item.classList.add('accordion-item');

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

            debugger;
            
            // setting bootstrap attributes
            itemCollapse.setAttribute('data-bs-parent', '#accordionManifestations');

            const itemBody = document.createElement('div');

            // setting ID and classes
            itemBody.classList.add('accordion-body');
            
            const itemDescription = document.createElement('div');

            // setting ID and classes
            itemDescription.classList.add('row');
            itemDescription.id = 'description';
            
            const itemAttachments = document.createElement('div');
            
            // setting ID and classes
            itemAttachments.classList.add('row');
            itemAttachments.id = 'attachments';

            // adds values to their places
            let data = new Date(manifestation.data_ouvidoria);
            data = data.getDate() + '/' + data.getMonth() + '/' + data.getFullYear();

            itemButton.innerHTML = `${manifestation.protocolo_ouvidoria} <div class="vr mx-1"></div> ${manifestation.tipo_ouvidoria}, ${manifestation.tipo_servico_afetado} <div class="vr mx-1"></div> Data: ${data}`;
            
            itemDescription.innerHTML = `<div class="col"><span class="fw-bold">Descrição:</span> ${manifestation.descricao_ouvidoria}</div>`;
            
            // adds attachments right below the description
            const attachments = await getManifestationAttachments(manifestation.protocolo_ouvidoria);

            itemAttachments.innerHTML = '<span class="fw-bold"> Anexos: </span><div class="row">';

            attachments.forEach(attachment => {
                
            })

            itemAttachments.innerHTML += '</div>'

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