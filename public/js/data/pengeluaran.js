$(document).ready(function() {
    if ($('#table-pengeluaran tbody').children().length == 0) {
        $('#table-pengeluaran tbody').append('<tr><td colspan=6 class="text-center">Data masih kosong</td></tr>');
    }

    var btnIndex = -1, btnId = 0;
    $('#data-pengeluaran .btn-show-action').on('click', function() {
        btnIndex = $(this).index('.btn-show-action') + 1;
        btnId = $(this).attr('id').substring(4);
    });

    $('#data-pengeluaran .btn-tambah').on('click', function() {
        btnIndex = -1;
        $('#modal-form').attr('action', "/data/pengeluaran");
        $('#modal-title').text('Tambah pengeluaran baru');

        $('#input-nama-pengeluaran').val('');
        $('#input-deskripsi').val('');
        $('#input-nominal').val(0);

        $('#modal-update').modal('show');
    });

    $('#data-pengeluaran #action-update').on('click', function() {
        $('#modal-form').attr('action', "/data/pengeluaran/" + btnId);
        $('#modal-title').text('Rubah pengeluaran');

        $('#input-nama-pengeluaran').val($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(1)').html());
        $('#input-deskripsi').val($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(2)').html());
        $('#input-nominal').val($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(5)').html());

        $('#modal-update').modal('show');
    });

    $('#action-delete').on('click', function() {
        if (confirm('Yakin menghapus data ?')) {
            $.ajax({
                url: "/data/pengeluaran/delete/" + btnId,
            }).done(function() {
                location.reload();
            });
        }
    });
});
