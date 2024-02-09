
document.addEventListener('DOMContentLoaded', CreateAccountPage, false);

function CreateAccountPage () {
    // PLANS in comming from laravel
    // code here...
    const selectedClass = '--selected'
    const plansElements = document.querySelectorAll('.plan-group');

    const handleSelect = (event) => {
        const planElement = event.currentTarget;
        const currentSelected = document.querySelector(`.plan-group.${selectedClass}`);
       
        setPlanInputValue(planElement.getAttribute('data-id'));
        currentSelected.classList.remove(selectedClass);
        planElement.classList.add(selectedClass);
    }

    const setPlanInputValue = (planId) => {
        const inputField = document.getElementById('inputPlan');
        const plan = window.PLANS.find((plan) => plan.id === parseInt(planId));
        inputField.setAttribute('value', plan.id)
    }

    plansElements.forEach((item, i) =>  {
         
        if (i === 0) {
            item.classList.add(selectedClass);
            setPlanInputValue(window.PLANS[0].id);
        }
        item.addEventListener('click', handleSelect)
        
    });

}




