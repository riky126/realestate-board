document.addEventListener('DOMContentLoaded', ProprietorPage, false);

function ProprietorPage () {
    // window.PROPRIETORS in comming from laravel
    // code here...
    setupSelectProprietors();
}

function setupSelectProprietors() {
    const selectField = document.querySelector('select[name="proprietor"]');
    const amountInput = document.getElementById('inputAmount');
    const modelCloseButton = document.querySelector('.btn-close');
    const modalContainer = document.getElementById('exampleModalToggle');

    selectField.onchange = function (event)  {
        const value = parseInt(event.target.value);
        const proprietor = window.PROPRIETORS.find((proprietor, i) => proprietor.id === value);
        amountInput.value = proprietor?.maintenance_fee || null;
    }

    const willCloseModel = (event) => {
        if(event.target !== event.currentTarget) return;
        amountInput.value = null;
        selectField.selectedIndex =0;
    }


    modelCloseButton.onclick = willCloseModel;
    modalContainer.onclick = willCloseModel;

}




