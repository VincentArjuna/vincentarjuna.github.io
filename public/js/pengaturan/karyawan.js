$(document).ready(function() {
    $('#table-pengaturan-karyawan').DataTable();
    
    var btnIndex = -1;
    $('.btn-show-action').on('click', function() {
        btnIndex = $(this).index('.btn-show-action') + 1;
    });
    
    $('#pengaturan-karyawan #action-update').on('click', function() {
        $('#update-username').val($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(1)').html());
        $('#update-nama').val($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(2)').html());
        $('#update-telepon').val($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(3)').html());
        $('#update-email').val($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(4)').html());
        $('#update-role').val($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(5)').html().toLowerCase());
        
        $('#modal-update').modal('show');
    });
    
    $('#action-change-password').on('click', function() {
        $('#modal-change-password').modal('show');
    });
});