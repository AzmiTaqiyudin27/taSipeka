let jquery_datatable = $("#table1").DataTable({
    responsive: true,
    ordering: false,
    // order: [[0, "desc"]], // Urutan ascending pada kolom pertama (indeks 0)
    searching: true, // Menyalakan fitur pencarian
    language: {
        // lengthMenu: "_MENU_",
        search: "Cari:",
        info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
        // paginate: {
        //     first: "Awal",
        //     last: "Akhir",
        //     next: "Selanjutnya",
        //     previous: "Sebelumnya",
        // },
    },
});
let jquery_datatablehasil = $("#tablehasil").DataTable({
    responsive: true,
    lengthChange: false,
    paging: false,
    ordering: false,
    info: false,
    // order: [[0, "desc"]], // Urutan ascending pada kolom pertama (indeks 0)
    searching: false, // Menyalakan fitur pencarian
    language: {
        // lengthMenu: "_MENU_",
        search: "Cari:",
        info: false,
        lengthChange: false,
        paging: false,
        // paginate: {
        //     first: "Awal",
        //     last: "Akhir",
        //     next: "Selanjutnya",
        //     previous: "Sebelumnya",
        // },
    },
});
let jquery_datatable2 = $("#table12").DataTable({
    responsive: true,
    ordering: false,
    // order: [[0, "desc"]], // Urutan ascending pada kolom pertama (indeks 0)
    searching: true, // Menyalakan fitur pencarian
    language: {
        // lengthMenu: "_MENU_",
        search: "Cari:",
        info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
        // paginate: {
        //     first: "Awal",
        //     last: "Akhir",
        //     next: "Selanjutnya",
        //     previous: "Sebelumnya",
        // },
    },
});
let jquery_datatable3 = $("#table13").DataTable({
    responsive: true,
    ordering: false,
    // order: [[0, "desc"]], // Urutan ascending pada kolom pertama (indeks 0)
    searching: true, // Menyalakan fitur pencarian
    language: {
        // lengthMenu: "_MENU_",
        search: "Cari:",
        info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
        // paginate: {
        //     first: "Awal",
        //     last: "Akhir",
        //     next: "Selanjutnya",
        //     previous: "Sebelumnya",
        // },
    },
});
let jquery_datatable4 = $("#table14").DataTable({
    responsive: true,
    ordering: false,
    // order: [[0, "desc"]], // Urutan ascending pada kolom pertama (indeks 0)
    searching: true, // Menyalakan fitur pencarian
    language: {
        // lengthMenu: "_MENU_",
        search: "Cari:",
        info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
        // paginate: {
        //     first: "Awal",
        //     last: "Akhir",
        //     next: "Selanjutnya",
        //     previous: "Sebelumnya",
        // },
    },
});
let customized_datatable = $("#table2").DataTable({
    responsive: true,
    pagingType: "simple",
    dom:
        "<'row'<'col-3'l><'col-9'f>>" +
        "<'row dt-row'<'col-sm-12'tr>>" +
        "<'row'<'col-4'i><'col-8'p>>",
    language: {
        info: "Page _PAGE_ of _PAGES_",
        lengthMenu: "_MENU_ ",
        search: "",
        searchPlaceholder: "Search..",
    },
    order: [], // Menonaktifkan urutan default
});

const setTableColor = () => {
    document
        .querySelectorAll(".dataTables_paginate .pagination")
        .forEach((dt) => {
            dt.classList.add("pagination-primary");
        });
};
setTableColor();
jquery_datatable.on("draw", setTableColor);
