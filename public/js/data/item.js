$(document).ready(function() {
    if ($('#table-item tbody').children().length == 0) {
        $('#table-item tbody').append('<tr><td colspan=16 class="text-center">Data masih kosong</td></tr>');
    }

    var btnIndex = -1, btnId = 0;
    $('#data-item .btn-show-action').on('click', function() {
        btnIndex = $(this).index('.btn-show-action') + 1;
        btnId = $(this).attr('id').substring(4);
    });

    $('#data-item .btn-tambah').on('click', function() {
        btnIndex = -1;
        $('#modal-form').attr('action', "/data/jenis-item");
        $('#modal-title').text('Tambah jenis item');

        $('#input-kategori').val('');
        $('#input-nama-item').val('');
        $('#input-unit').val('pcs');
        $('#input-bobot-bucket').val(0);
        $('#input-harga-kilo').val(0);
        $('#input-harga-bucket').val(0);
        $('#input-harga-premium').val(0);
        $('#input-beban-produksi').val(0);
        $('#formCheck-kilo-aktif').attr('checked', true);
        $('#formCheck-kilo-tidakAktif').attr('checked', false);
        $('#formCheck-bucket-aktif').attr('checked', true);
        $('#formCheck-bucket-tidakAktif').attr('checked', false);
        $('#formCheck-premium-aktif').attr('checked', true);
        $('#formCheck-premium-tidakAktif').attr('checked', false);
        $('#formCheck-item-aktif').attr('checked', true);
        $('#formCheck-item-tidakAktif').attr('checked', false);
        $('#modal-form .modal-body .row .col-12:nth-child(12)').hide();

        $('#modal-update').modal('show');
    });

    $('#data-item #action-update').on('click', function() {
        $('#modal-form').attr('action', "/data/jenis-item/" + btnId);
        $('#modal-title').text('Rubah jenis item');

        $('#input-kategori').val($('#input-kategori option:contains(' + $('tbody tr:nth-child(' + btnIndex + ') td:nth-child(1)').html() + ')').val());
        $('#input-nama-item').val($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(2)').html());
        $('#input-unit').val($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(3)').html());
        $('#input-bobot-bucket').val($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(4)').html());
        $('#input-harga-kilo').val($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(7)').html());
        $('#input-harga-bucket').val($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(9)').html());
        $('#input-harga-premium').val($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(11)').html());
        $('#input-beban-produksi').val($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(12)').html());

        if ($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(13)').html() == "Aktif") {
            $('#formCheck-kilo-aktif').attr('checked', true);
        } else if ($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(13)').html() == "Tidak aktif") {
            $('#formCheck-kilo-tidakAktif').attr('checked', true);
        }
        if ($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(14)').html() == "Aktif") {
            $('#formCheck-bucket-aktif').attr('checked', true);
        } else if ($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(14)').html() == "Tidak aktif") {
            $('#formCheck-bucket-tidakAktif').attr('checked', true);
        }
        if ($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(15)').html() == "Aktif") {
            $('#formCheck-premium-aktif').attr('checked', true);
        } else if ($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(15)').html() == "Tidak aktif") {
            $('#formCheck-premium-tidakAktif').attr('checked', true);
        }
        if ($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(16)').html() == "Aktif") {
            $('#formCheck-item-aktif').attr('checked', true);
        } else if ($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(16)').html() == "Tidak aktif") {
            $('#formCheck-item-tidakAktif').attr('checked', true);
        }
        $('#modal-form .modal-body .row .col-12:nth-child(12)').show();

        $('#modal-update').modal('show');
    });

    $('#action-delete').on('click', function() {
        if (confirm('Yakin menghapus data ?')) {
            $.ajax({
                url: "/data/jenis-item/delete/" + btnId,
            }).done(function() {
                location.reload();
            });
        }
    });
});
