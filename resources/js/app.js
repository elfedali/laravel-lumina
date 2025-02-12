import './bootstrap';

import * as bootstrap from 'bootstrap';


// document.addEventListener('DOMContentLoaded', () => {
//     const modal = new bootstrap.Modal(document.getElementById('appModal'));

//     document.getElementById('editCompanyButton').addEventListener('click', async function () {
//         const companyId = this.dataset.id;
//         console.log(companyId);

//         // Load the form content
//        const response = await fetch(`/changes/companies/${companyId}/edit`);
//        const formHtml = await response.text();

//         // Inject the form into the modal and show it
//         document.getElementById("editShopModalDialog").innerHTML = formHtml;
//         modal.show();
//     });
// });