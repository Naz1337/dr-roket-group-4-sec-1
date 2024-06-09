import 'datatables.net-dt/css/dataTables.dataTables.css';
import 'datatables.net-bs5/css/dataTables.bootstrap5.css';

import DataTable from 'datatables.net-bs5'


let table = new DataTable('#draftsTable', {
    "footerCallback": function ( tr, data, start, end, display ) {
        const api = this.api()
        let total = 0

        api.column(5).data().each(function (value, index) {
            total += parseInt(value)
        })

        $(api.column(5).footer()).html(total.toLocaleString());
    },
    "order" : [
        [0, 'desc']
    ],
    "scrollX": false
})

document.querySelector('#draftsTable tbody').addEventListener('click', function (event) {
    let tr = event.target.closest('tr')
    if (tr) {
        // let data = table.row(tr).data();
        let rowData = tr.dataset;
        if (rowData['rowLink'] !== undefined)
            window.location.href = rowData['rowLink']
    }
})