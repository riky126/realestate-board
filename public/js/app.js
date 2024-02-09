document.addEventListener('DOMContentLoaded', App, false);

function App() {
    Modals();
}

function Modals () {
    const modalButtonTrigger = document.querySelector('button[data-bs-toggle="modal"]');
    
    if (Object.keys($MODAL_ERROR).length > 0 && modalButtonTrigger) {
        modalButtonTrigger.click();
    }
}