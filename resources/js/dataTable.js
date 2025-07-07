// resources/js/dataTable.js

import { DataTable } from "simple-datatables";
document.addEventListener("DOMContentLoaded", function () {
    if (document.getElementById("data-table")) {
        const dataTable = new DataTable("#data-table", {
            header: true,
            searchable: true,
            sortable: true,
            perPage: 10,
            perPageSelect: [5, 10, 20, 50],
            firstLast: true,
            searchQuerySeparator: "AND",
        });
    }
    let search = document.querySelector('.datatable-input');
    search.classList.add('input');
    search.classList.add('bg-base-200');
});



