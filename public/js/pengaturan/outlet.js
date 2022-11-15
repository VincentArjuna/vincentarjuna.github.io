$(document).ready(function() {
    $('#table-pengaturan-outlet').DataTable();

    var btnIndex = -1;
    $('.btn-show-action').on('click', function() {
        btnIndex = $(this).index('.btn-show-action') + 1;
    });

    $('#pengaturan-outlet-master #action-update').on('click', function() {
        $('#input-kode').val($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(1)').html());
        $('#input-nama').val($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(2)').html());
        $('#input-alamat').val($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(3)').html());
        $('#input-telp1').val($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(4)').html());
        $('#input-telp2').val($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(5)').html());
        $('#input-fax').val($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(6)').html());
        if ($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(7)').html() == 'Aktif') {
            $('#radio-status-aktif').attr('checked', true);
        } else if ($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(7)').html() == 'Non-aktif') {
            $('#radio-status-nonaktif').attr('checked', true);
        }

        $('#modal-update-outlet').modal('show');
    });
});
