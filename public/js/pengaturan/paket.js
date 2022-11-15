$(document).ready(function() {
    $('#table-paket-cuci').DataTable();
    $('#table-paket-deposit').DataTable();

    var btnIndex = -1;
    var tipePaket = '';
    $('.btn-show-action').on('click', function() {
        tipePaket = $(this).closest('section').attr('id');
        tipePaket = tipePaket.substring(17);
        if (tipePaket == 'cuci') {
            btnIndex = $(this).index('.btn-show-action') + 1;
        } else if (tipePaket == 'deposit') {
            btnIndex = $(this).index('.btn-show-action') + 1 - $('#pengaturan-paket-cuci .btn-show-action').length;
        }
    });

    $('#action-update').on('click', function() {
        if (tipePaket != '') {
            $('#pengaturan-paket-' + tipePaket + ' #input-nama-paket').val($('#table-paket-' + tipePaket + ' tbody tr:nth-child(' + btnIndex + ') td:nth-child(1)').html());
            $('#pengaturan-paket-' + tipePaket + ' #input-deskripsi').val($('#table-paket-' + tipePaket + ' tbody tr:nth-child(' + btnIndex + ') td:nth-child(2)').html());
            console.log($('#table-paket-' + tipePaket + ' tbody tr:nth-child(' + btnIndex + ') td:nth-child(3)').html());
            $('#pengaturan-paket-' + tipePaket + ' #input-harga-paket').val($('#table-paket-' + tipePaket + ' tbody tr:nth-child(' + btnIndex + ') td:nth-child(3)').html().replace('.', ''));
            if (tipePaket == 'cuci') {
                $('#pengaturan-paket-cuci #input-bobot-paket').val($('#table-paket-cuci tbody tr:nth-child(' + btnIndex + ') td:nth-child(5)').html());
            } else if (tipePaket == 'deposit') {
                $('#pengaturan-paket-deposit #input-nominal').val($('#table-paket-deposit tbody tr:nth-child(' + btnIndex + ') td:nth-child(4)').html().replace('.', ''));
            }
            $('#modal-update-paket-' + tipePaket).modal('show');
        } else {
            console.log(tipePaket);
        }
    });
});
