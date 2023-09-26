//@ sourceURL=/plugins/LeuchtfeuerLogBundle/Assets/js/log.js

document.addEventListener('DOMContentLoaded', () => {
    const filterForm = document.getElementById('filter-form');
    const filterInputs = filterForm.querySelectorAll('input');
    const actionBundleSelect = filterForm.querySelector('select[name="log_filter[actionBundle][]"]');
    const filterFormContainer = document.getElementById('filterFormContainer');

    filterFormContainer.addEventListener('change', (event) => {
        if(event.target.tagName === 'SELECT' && event.target.name === 'log_filter[actionBundle][]') {
            filterForm.submit();
        }
    });

    filterInputs.forEach(input => {
        input.addEventListener('input', () => {
            filterForm.submit();
        });
    });
    console.log(filterInputs);
    console.log(actionBundleSelect);

    actionBundleSelect.addEventListener('change', () => {

        filterForm.submit();
    });

    const clearFiltersButton = filterForm.querySelector('button');
    clearFiltersButton.addEventListener('click', () => {
        console.log('button clicked');
    });
});



// clearFiltersButton.addEventListener('click', () => {
//     console.log('Button clicked');
//     fetch('/log/clear-filters', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/json',
//         },
//     })
//     .then((response) => response.json())
//     .then((data) => {
//         const clearFiltersMessage = document.getElementById('clear-filters-message');
//         clearFiltersMessage.textContent = data.message;
//     })
//     .catch((error) => {
//         console.error('Error clearing filters:', error);
//     })
// });
