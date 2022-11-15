$(document).ready(function() {
    $('#table-rewash').DataTable();

    var btnIndex = -1;
    $('#data-rewash .btn-show-action').on('click', function() {
        btnIndex = $(this).index('.btn-show-action') + 1;
    });

    $('#data-rewash .btn-tambah').on('click', function() {
        // reset form data

        $('#modal-update').modal('show');
    });

    $('#data-rewash #action-update').on('click', function() {
        // get data

        $('#modal-update').modal('show');
    });
});
