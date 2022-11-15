$(document).ready(function() {
    if ($('#table-pelanggan tbody').children().length == 0) {
        $('#table-pelanggan tbody').append('<tr><td colspan=9 class="text-center">Data masih kosong</td></tr>');
    }

    var btnIndex = -1, btnId = 0;
    $('#data-pelanggan .btn-show-action').on('click', function() {
        btnIndex = $(this).index('.btn-show-action') + 1;
        btnId = $(this).attr('id').substring(4);
    });

    $('#data-pelanggan .btn-tambah').on('click', function() {
        btnIndex = -1;
        $('#modal-form').attr('action', "/data/pelanggan");
        $('#modal-title').text('Tambah pelanggan baru');

        $('#input-nama-pelanggan').val('');
        $('#input-alamat').val('');
        $('#input-tanggal-lahir').val('');
        $('#formCheck-member').attr('checked', false);
        $('#formCheck-non-member').attr('checked', true);
        $('#input-jenis-identitas').val('');
        $('#input-nomor-identitas').val('');
        $('#input-telepon').val('');
        $('#input-email').val('');
        $('#formCheck-aktif').attr('checked', true);
        $('#formCheck-tidakAktif').attr('checked', false);
        $('#modal-form .modal-body .row .col-12:nth-child(7)').removeClass('col-sm-4');
        $('#modal-form .modal-body .row .col-12:nth-child(8)').removeClass('col-sm-4');
        $('#modal-form .modal-body .row .col-12:nth-child(7)').addClass('col-sm-6');
        $('#modal-form .modal-body .row .col-12:nth-child(8)').addClass('col-sm-6');
        $('#modal-form .modal-body .row .col-12:nth-child(9)').hide();

        $('#modal-update').modal('show');
    });

    $('#data-pelanggan #action-update').on('click', function() {
        $('#modal-form').attr('action', "/data/pelanggan/" + btnId);
        $('#modal-title').text('Rubah data pelanggan');

        $('#input-nama-pelanggan').val($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(3)').html());
        $('#input-alamat').val($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(5)').html());
        $('#input-tanggal-lahir').val($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(4)').html());
        if ($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(2)').html() == "Member") {
            $('#formCheck-member').attr('checked', true);
        } else if ($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(2)').html() == "Bukan member") {
            $('#formCheck-non-member').attr('checked', true);
        }
        $('#input-jenis-identitas').val($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(6)').html());
        $('#input-nomor-identitas').val($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(7)').html());
        $('#input-telepon').val($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(8)').html());
        $('#input-email').val($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(9)').html());
        if ($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(10)').html() == "Aktif") {
            $('#formCheck-aktif').attr('checked', true);
        } else if ($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(10)').html() == "Tidak aktif") {
            $('#formCheck-tidakAktif').attr('checked', true);
        }
        $('#modal-form .modal-body .row .col-12:nth-child(7)').removeClass('col-sm-6');
        $('#modal-form .modal-body .row .col-12:nth-child(8)').removeClass('col-sm-6');
        $('#modal-form .modal-body .row .col-12:nth-child(7)').addClass('col-sm-4');
        $('#modal-form .modal-body .row .col-12:nth-child(8)').addClass('col-sm-4');
        $('#modal-form .modal-body .row .col-12:nth-child(9)').show();

        $('#modal-update').modal('show');
    });

    $('#action-delete').on('click', function() {
        if (confirm('Yakin menghapus data ?')) {
            $.ajax({
                url: "/data/pelanggan/delete/" + btnId,
            }).done(function() {
                location.reload();
            });
        }
    });
});
