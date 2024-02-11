Object.prototype.renameProperty = function (oldName, newName) {
    // Do nothing if the names are the same
    if (oldName === newName) {
        return this;
    }
   // Check for the old property name to avoid a ReferenceError in strict mode.
   if (this.hasOwnProperty(oldName)) {
       this[newName] = this[oldName];
       delete this[oldName];
   }
   return this;
};

document.addEventListener('DOMContentLoaded', ProprietorPage, false);

function ProprietorPage () {
    // window.PROPRIETORS in comming from laravel
    // code here...
    setupOptionsMenu();
    setupDateFilter();
}

function setupOptionsMenu() {
    const rowOptionItems = document.querySelectorAll('.menu-options .dropdown-item');
    const $form = document.getElementById('proprietorForm');
    const submitButton = $form.getElementsByTagName('button')[0];
    const defaultformAction = $form.action;
    const defaultButtonLabel = submitButton.innerText;
    const modelCloseButton = document.querySelector('.btn-close');
    const modalContainer = document.getElementById('exampleModalToggle');

    let proprietor;

    const commandAction = {
        edit: onUpdateCommand,
        delete: onDeleteCommand
    };

    const didClickMenu = (event) => {
        const command = event.currentTarget.getAttribute('data-action-command');
        commandAction[command](event);
    }

    function onUpdateCommand (event) {
        const rowId = event.currentTarget.getAttribute('data-row-id');
        proprietor = window.PROPRIETORS[rowId];
        setModelToUpdate();

        // Rename proprietor attribute to match input fields name;
        proprietor.renameProperty('unit_entitlement', 'unit_ent');
        proprietor.renameProperty('postal_address', 'address');

        for (i = 0; i < $form.elements.length; i++) {
            const field = $form.elements[i];

            if (proprietor[field.getAttribute('name')]) {
                field.value = proprietor[field.getAttribute('name')]
            }            
        }
    }

    function onDeleteCommand (event) {
        event.preventDefault();
       
        const rowId = event.currentTarget.getAttribute('data-row-id');
        const proprietor = window.PROPRIETORS[rowId];

        const url = window.location.origin + window.location.pathname;
        const csrfToken = document.querySelector('input[name=_token]')
        const form = document.createElement("form");
        const confirmMessage = `Deleting Proprietor: ${proprietor.lot_number} will remove all their contributions.`;
        
        if (confirm(confirmMessage)) {
            form.action =  `${url}/delete-proprietor/${proprietor.id}`;
            form.method = "post";
            form.setAttribute('id', 'deleteForm')

            const proprietorInput = document.createElement("input");
            proprietorInput.value = proprietor.id;
            proprietorInput.name = "proprietor_id";

            form.appendChild(proprietorInput);
            form.appendChild(csrfToken);
            document.body.appendChild(form);
            form.submit();
        }
    }

    const setModelToUpdate = () => {
        $form.action = `update-proprietor`;
        submitButton.innerHTML = 'Update';
    }

    const willCloseModel = (event) => {
        if(event.target !== event.currentTarget) return;
    
        $form.action = defaultformAction;
        submitButton.innerHTML = defaultButtonLabel;
        proprietor = null;
        $form.reset();
    }

    const onSubmit = () => {
        if (!proprietor) return;

        input = document.createElement('input');
        input.setAttribute('name', 'proprietor');
        input.setAttribute('value', proprietor.id);
        input.setAttribute('type', 'hidden');
        $form.appendChild(input);
    }

    $form.onsubmit = onSubmit;

    if (window.MODAL_ERROR?.updateError) {
        setModelToUpdate();
    }

    modelCloseButton.addEventListener('click', willCloseModel);
    modalContainer.addEventListener('click', willCloseModel);
    
    rowOptionItems.forEach((menuButton) => {
        menuButton.addEventListener('click', didClickMenu);
    });
}

function setupDateFilter() {
    const dateField = document.querySelector('input[name=date-period]');

    dateField.onblur = function(event) {
        let url = window.location.origin + window.location.pathname;
        const date = event.target.value;
        url += date ? `?accounting-period=${date}` : '';

        window.location.href = url;
    }
}



