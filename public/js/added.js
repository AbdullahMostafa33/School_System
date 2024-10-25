//show message for 4 sec
document.addEventListener('DOMContentLoaded', function () {
    const notification = document.getElementById('notification');
    if (notification) {
        // Show the notification
        notification.classList.add('show');

        // Hide the notification after 4 seconds
        setTimeout(() => {
            notification.classList.remove('show');
            // Optionally remove the notification from the DOM
            setTimeout(() => notification.remove(), 500); // Allow fade out to complete
        }, 4000);
    }
});

//check all
$('#all').on('change', function () {
    // Check/uncheck all the checkboxes
    $('.selected-checkbox').prop('checked', this.checked);
});

//  exportTableToExcel
    function exportTableToExcel(tableID, filename = '', excludeCols = []) {
        let downloadLink;
    const dataType = 'application/vnd.ms-excel';

    // Clone the original table
    const originalTable = document.getElementById(tableID);
    const clonedTable = originalTable.cloneNode(true);

    // Remove the specified columns from each row in the cloned table
    for (const row of clonedTable.rows) {
        for (let i = excludeCols.length - 1; i >= 0; i--) {
        row.deleteCell(excludeCols[i]);
        }
    }

    const tableHTML = clonedTable.outerHTML.replace(/ /g, '%20');

    // Specify filename
    filename = filename ? filename + '.xls' : 'excel_data.xls';

    // Create download link
    downloadLink = document.createElement("a");
    document.body.appendChild(downloadLink);

    if (navigator.msSaveOrOpenBlob) {
        // For IE
        const blob = new Blob(['\ufeff', tableHTML], {type: dataType });
    navigator.msSaveOrOpenBlob(blob, filename);
    } else {
        // For other browsers
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    downloadLink.download = filename;
    downloadLink.click();
    }

    document.body.removeChild(downloadLink);
}
