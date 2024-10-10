document.addEventListener('DOMContentLoaded', function() {
    const table = document.getElementById('dynamicTable');
    const tbody = table.querySelector('tbody');
    let rowIndex = 0;

    function addRow(event) {
        rowIndex++;
        const newRow = tbody.querySelector('tr').cloneNode(true);

        // Update input names
        newRow.querySelector('select[name^="indicator_weights"]').name = `indicator_weights[${rowIndex}][indicator_id]`;
        newRow.querySelector('select[name$="[weight]"]').name = `indicator_weights[${rowIndex}][weight]`;
        
        newRow.querySelector('.add-row').addEventListener('click', addRow);
        newRow.querySelector('.delete-row').addEventListener('click', deleteRow);
        tbody.appendChild(newRow);
    }

    function deleteRow(event) {
        if (tbody.querySelectorAll('tr').length > 1) {
            event.target.closest('tr').remove();
        }
    }

    tbody.querySelectorAll('.add-row').forEach(btn => btn.addEventListener('click', addRow));
    tbody.querySelectorAll('.delete-row').forEach(btn => btn.addEventListener('click', deleteRow));

});