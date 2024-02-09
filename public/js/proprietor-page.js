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
        $form.action = `update-proprietor`;
        submitButton.innerHTML = 'Update';

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

    modelCloseButton.addEventListener('click', willCloseModel);
    modalContainer.addEventListener('click', willCloseModel);
    
    rowOptionItems.forEach((menuButton) => {
        menuButton.addEventListener('click', didClickMenu);
    });
}




