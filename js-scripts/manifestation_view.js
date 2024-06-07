if (document.querySelector('#accordionManifestations')) {
    getManifestations().then(manifestations => {
        const accordion = document.querySelector('#accordionManifestations');
        var i = 1;

        // creates an accordion item for each manifestation
        manifestations.forEach(async manifestation => {
            const item = document.createElement('div.accordion-item');

            const itemHeader = document.createElement('h2.accordion-header');
            const itemTitle = document.createElement('button.accordion-button.collapsed');

            // setting bootstrap attributes
            itemTitle.setAttribute('type', 'button');
            itemTitle.setAttribute('data-bs-toggle', 'collapse');
            itemTitle.setAttribute('data-bs-target', `#item${i}`);
            itemTitle.setAttribute('aria-expanded', 'false');
            itemTitle.setAttribute('aria-controls', `item${i}`);
            
            const itemCollapse = document.createElement('div.accordion-collapse.collapse');
            // setting ID
            itemCollapse.id = `item${i}`;
            
            // setting bootstrap attributes
            itemCollapse.setAttribute('data-bs-parent', '#accordionManifestations');

            const itemBody = document.createElement('div.accordion-body');
            
            const itemDescription = document.createElement('div.row');
            itemDescription.id = 'description';
            
            const itemAttachments = document.createElement('div.row');
            itemAttachments.id = 'attachments';

            // adds values to their places
            let data = new Date(manifestation.data_ouvidoria);
            data = data.getDate() + '/' + data.getMonth() + '/' + data.getFullYear();

            itemTitle.innerHTML = `Protocolo: ${manifestation.protocolo_ouvidoria} <div class="vr"></div> ${manifestation.tipo_ouvidoria}, ${manifestation.tipo_servico_afetado} <div class="vr"></div> Data: ${data}`;
            
            itemDescription.innerHTML = `<div class="col">Descrição: ${manifestation.descricao_ouvidoria}</div>`;
            
            // adds images right below description
            const attachments = await getManifestationAttachments(manifestation.protocolo_ouvidoria);

            attachments.forEach(attachment => {
                
            })

            // appends all elements to accordion
            itemHeader.append(itemTitle);
            itemCollapse.append(itemBody);

            item.append(itemHeader);
            item.append(itemCollapse);
            
            accordion.append(item);
            i++;
        })
    })
}