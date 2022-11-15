$(document).ready(function() {
    $('#modal-opsi-trans, #modal-new-trans').modal({
        backdrop: 'static',
        keyboard: false
    });

    $('#modal-opsi-trans').modal('show');

    $('#show-option').on('click', function() {
        $('#modal-opsi-trans').modal('show');
    });

    $('#table-list-trans tbody tr').on('click', function() {
        let parent = $(this).parent();
        parent.addClass('disabled');
        let id = $(this).children().eq(0).html();

        $.ajax({
            url: "/transaksi/detail/" + id,
        }).done(function(data) {
            // console.log(data[0]);

            let trans = data;
            $('#id-trans').text(trans.id);
            $('#kode-trans').text(trans.kode);

            $('#input-parfum').val(trans.parfum_id);
            $('#formCheck-express').prop('checked', trans.express);
            if (trans.express) {
                $('#formCheck-express').val(1);
            }
            $('#formCheck-setrika').prop('checked', trans.setrika_only);
            if (trans.setrika_only) {
                $('#formCheck-setrika').val(1);
            }
            $('#input-catatan-trans').val(trans.catatan);

            let pelanggan = trans.pelanggan;
            $('#input-nama').val(pelanggan.nama);
            $('#input-telepon').val(pelanggan.telephone);
            $('#input-alamat').val(pelanggan.alamat);
            $('#input-email').val(pelanggan.email);
            $('#input-tanggal-lahir').val(pelanggan.tanggal_lahir);
            if (pelanggan.catatan_pelanggan != null) {
                $('#input-catatan-pelanggan').val(pelanggan.catatan_pelanggan.catatan_cuci);
            }

            $('#search-pelanggan').hide();
            $('#data-pelanggan').show();

            $('#select-outlet').val(trans.outlet_id);

            let pickup = trans.pickup_delivery[0];
            let delivery = trans.pickup_delivery[1];
            let penerima = trans.penerima;

            if (typeof pickup !== "undefined") {
                $('#select-driver-pickup').val(pickup.driver_id);
                $('#input-alamat-ambil').val(pickup.alamat);
                $('#formCheck-pickup').parent().next().show();
                $('#formCheck-pickup').prop('checked', true);
            } else {
                $('#formCheck-pickup').parent().next().hide();
                $('#formCheck-pickup').prop('checked', false);
                $('#select-driver-pickup').val('');
                $('#input-alamat-ambil').val('');
            }

            if (typeof delivery !== "undefined") {
                $('#select-driver-delivery').val(delivery.driver_id);
                $('#input-alamat-antar').val(delivery.alamat);
                $('#formCheck-delivery').parent().next().show();
                $('#formCheck-delivery').prop('checked', true);
            }else {
                $('#formCheck-delivery').parent().next().hide();
                $('#formCheck-delivery').prop('checked', false);
                $('#select-driver-delivery').val('');
                $('#input-alamat-antar').val('');
            }

            if (penerima) {
                $('#select-outlet-ambil').parent().addClass('disabled');
                $('#select-outlet-ambil').val(penerima.outlet_id);
                $('#input-nama-penerima').val(penerima.penerima);
                $('#input-date-penerimaan').val(penerima.tanggal_penerimaan);
                $('#input-foto-penerima').hide().prev().hide();

                $('#simpan-info-penerimaan').hide();
            } else {
                $('#select-outlet-ambil').parent().removeClass('disabled');
                $('#select-outlet-ambil').val('');
                $('#input-nama-penerima').val('');
                $('#input-date-penerimaan').val('');
                $('#input-foto-penerima').show().prev().show();

                $('#simpan-info-penerimaan').show();
            }

            if (!$('#show-data-pelanggan').hasClass('show')) {
                $('#show-data-pelanggan').trigger('click');
            }
            if (!$('#show-data-pickup-delivery').hasClass('show')) {
                $('#show-data-pickup-delivery').trigger('click');
            }
            if (!$('#show-data-outlet').hasClass('show')) {
                $('#show-data-outlet').trigger('click');
            }
            if (!$('#show-data-penerimaan').hasClass('show')) {
                $('#show-data-penerimaan').trigger('click');
            }

            let rowAdd = $('#table-trans-item tbody').children().last().detach();
            $('#table-trans-item tbody').empty();
            for (let i = 0; i < trans.item_transaksi.length; i++) {
                const item = trans.item_transaksi[i];
                $('#table-trans-item tbody').append("<tr id='" + item.id + "'><td>" + item.nama + "</td><td>" + item.nama_kategori + "</td><td></td><td></td><td></td><td class='text-center' style='padding-top: 4px;padding-bottom: 4px;'><button id='btn-catatan-item-" + item.id + "' class='btn btn-primary btn-sm show-catatan-item' type='button'>Catatan</button></td><td class='text-center' colspan='2'>" + item.bobot_bucket + "</td></tr>");
            }
            $('#table-trans-item tbody').append(rowAdd);

            $('#sub-total').html(trans.subtotal);
            $('#diskon').html(trans.diskon);
            $('#diskon-member').html(trans.diskon_member);
            $('#grand-total').html(trans.grand_total);
            setThousandSeparator();
            $('#form-transaksi').attr('action', 'update/' + trans.id);

            parent.removeClass('disabled');
            $('#modal-opsi-trans').modal('hide');
        });
    });

    $('#search-key-trans').on('click', function() {
        let key = $('#input-key-trans').val()
        $.ajax({
            url: "/transaksi/search/" + key,
        }).done(function(data) {
            console.log(data);
            let transaksi = data[0];

            $('#table-list-trans tbody').empty();
            for (let i = 0; i < transaksi.length; i++) {
                const trans = transaksi[i];
                console.log(trans);
                $('#table-list-trans tbody').prepend(
                    "<tr>" +
                        "<td>" + trans.id + "</td>" +
                        "<td>" + trans.outlet.nama + "</td>" +
                        "<td class='text-center'>" + trans.created_at + "</td>" +
                        "<td>" + trans.pelanggan.nama + "</td>" +
                        "<td>Rp</td>" +
                        "<td class='text-end thousand-separator'>" + trans.grand_total + "</td>" +
                        "<td class='text-center'>" + ((trans.lunas) ? 'Lunas' : 'Belum Lunas') + "</td>" +
                    "</tr>"
                );
            }
        });
    });

    $('#add-new-trans').on('click', function() {
        $('#modal-opsi-trans').modal('hide');
        $('#modal-new-trans').modal('show');
    });

    $('#new-trans-back').on('click', function() {
        $('#modal-opsi-trans').modal('show');
    });

    $('#search-pelanggan-2').on('click', function() {
        $(this).next().toggle();
    });

    $('#table-list-pelanggan-2 tbody tr').on('click', function() {
        let parent = $(this).parent();
        parent.addClass('disabled');
        let id = $(this).attr('id').substring($(this).attr('id').indexOf('row-') + 4);

        $.ajax({
            url: "/data/pelanggan/" + id,
        }).done(function(data) {
            let pelanggan = data[0];

            $('#input-id-2').val(pelanggan.id);
            $('#input-nama-2').val(pelanggan.nama);
            $('#input-telepon-2').val(pelanggan.telephone);
            $('#input-alamat-2').val(pelanggan.alamat);
            $('#input-email-2').val(pelanggan.email);
            $('#input-tanggal-lahir-2').val(pelanggan.tanggal_lahir);

        });

        $('#search-pelanggan-2').text('Ganti pelanggan');
        $(this).closest('.card').hide();
        parent.removeClass('disabled');
    });

    $('#create-trans').on('click', function() {
        let pelanggan_id = $('#input-id-2').val();
        $.ajax({
            url: "/transaksi/create?pelanggan_id=" + pelanggan_id,
        }).done(function(data) {
            window.location = window.location;
        });
    });

    function setThousandSeparator() {
        let length = $('.thousand-separator').length;
        if (length != 0) {
            $('.thousand-separator').each(function(index, element) {
                let val = $(element).text();
                if (val != '') {
                    while(val.indexOf('.') != -1) {
                        val = val.replace('.', '');
                    }
                    let number = parseInt(val);
                    $(element).text(number.toLocaleString(['ban', 'id']));
                }
            });
        }
    };

    $('#simpan-info-penerimaan').on('click', function() {
        $(this).addClass('disabled');
        let id_trans = $('#id-trans').text();
        let id_outlet = $('#select-outlet-ambil').val();
        let ambil_di_outlet = 0;
        if (id_outlet) {
            ambil_di_outlet = 1;
        }

        let formData = new FormData();
        formData.append('transaksi_id', id_trans);
        formData.append('ambil_di_outlet', ambil_di_outlet);
        formData.append('outlet_id', id_outlet);
        formData.append('tanggal_penerimaan', $('#input-date-penerimaan').val());
        formData.append('penerima', $('#input-nama-penerima').val());
        formData.append('image', $('#input-foto-penerima').prop("files")[0]);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            url: "/transaksi/penerima",
            method: "POST",
            contentType: false,
            processData: false,
            data: formData,
        }).done(function() {
            $('#simpan-info-penerimaan').removeClass('disabled');
            $('#simpan-info-penerimaan').hide();
        }).fail(function(message) {
            alert(console.log(message));
        });
    });

    // bagian kanan
    $('.show-data').on('click', function() {
        let dataType = $(this).attr('id').substring($(this).attr('id').indexOf('data-') + 5);
        if (!$(this).hasClass('show')) {
            $(this).addClass('show');
            $(this).children().addClass('fa-rotate-180');

            $('#info-' + dataType).show();
        } else {
            $(this).removeClass('show');
            $(this).children().removeClass('fa-rotate-180');

            $('#info-' + dataType).hide();
        }
    });

    $('#search-pelanggan').on('click', function() {
        $('#modal-list-pelanggan').modal('show');
    });

    // select pelanggan
    $('#table-list-pelanggan tbody tr').on('click', function() {
        let id = $(this).attr('id').substring($(this).attr('id').indexOf('row-') + 4);

        $.ajax({
            url: "/data/pelanggan/" + id,
        }).done(function(data) {
            let pelanggan = data[0];

            $('#input-nama').val(pelanggan.nama);
            $('#input-telepon').val(pelanggan.telephone);
            $('#input-alamat').val(pelanggan.alamat);
            $('#input-email').val(pelanggan.email);
            $('#input-tanggal-lahir').val(pelanggan.tanggal_lahir);

            // console.log(pelanggan);
        });

        $('#search-pelanggan').text('Ganti pelanggan');
        $('#data-pelanggan').show();
        $('#modal-list-pelanggan').modal('hide');
    });

    $('#to-pickup-delivery').on('click', function() {
        let transID = $('#id-trans').text();
        window.location = "/transaksi/pickup-delivery/";
    });

    // bottom
    $('#add-item').on('click', function() {
        $('#table-items tbody').empty();

        $.ajax({
            url: "/data/jenis-item/find?key=&tipe_transaksi=bucket",
        }).done(function(data) {
            let items = data[0];

            items.forEach(item => {
                $('#table-items tbody').append("<tr id='item-" + item.id + "'><td>" + item.nama + "</td><td>" + item.nama_kategori + "</td><td>" + parseFloat(item.bobot_bucket) + "</td></tr>");
            });
            $('#modal-add-item').modal('show');
        });
    });

    $('#search-item').on('click', function() {
        $('#table-items tbody').empty();
        let key = $('#input-nama-item').val();

        $.ajax({
            url: "/data/jenis-item/find?key=" + key + "&tipe_transaksi=bucket",
        }).done(function(data) {
            let items = data[0];

            items.forEach(item => {
                $('#table-items tbody').append("<tr id='item-" + item.id + "'><td>" + item.nama + "</td><td>" + item.nama_kategori + "</td><td>" + parseFloat(item.bobot_bucket) + "</td></tr>");
            });
        });
    });

    // tambah item
    $('#table-items tbody').on('click', 'tr', function() {
        let parent = $(this).parent();
        parent.addClass('disabled');
        let id = $(this).attr('id');
        id = id.substr(5);

        $.ajax({
            url: "/data/jenis-item/" + id,
        }).done(function(data) {
            let item = data[0];

            let rowAdd = $('#table-trans-item tbody').children().last().detach();
            let total_bobot = 0;
            $('#table-trans- item tbody tr').each(function() {
                total_bobot += parseFloat($(this).children().eq(6).html());
            });

            $.ajax({
                url: "/transaksi/addItem?jenis_item_id=" + item.id + "&transaksi_id=" + $('#id-trans').text(),
            }).done(function(data) {
                let trans = data[0];
                $('#sub-total').html(trans.subtotal);
                $('#diskon').html(trans.diskon);
                $('#diskon-member').html(trans.diskon_member);
                $('#grand-total').html(trans.grand_total);

                $('#table-trans-item tbody').append("<tr id='" + trans.item_transaksi[trans.item_transaksi.length - 1].id + "'><td>" + item.nama + "</td><td>" + item.nama_kategori + "</td><td></td><td></td><td></td><td class='text-center' style='padding-top: 4px;padding-bottom: 4px;'><button id='btn-catatan-item-" + item.id + "' class='btn btn-primary btn-sm show-catatan-item' type='button'>Catatan</button></td><td class='text-center' colspan='2'>" + item.bobot_bucket + "</td></tr>");
                $('#table-trans-item tbody').append(rowAdd);

                setThousandSeparator();
                parent.removeClass('disabled');
                $('#modal-add-item').modal('hide');
            });
        });
    });

    $('#show-catatan-trans').on('click', function() {
        $(this).next().toggle();
    });

    $('#save-catatan-trans').on('click', function() {
        $(this).closest('div').hide();
    });

    var currentlySelectedItemTransactionID = 0;
    var currentlySelectedItemName = '';
    $('#table-trans-item tbody').on('click', '.show-catatan-item', function() {
        currentlySelectedItemTransactionID = $(this).closest('tr').attr('id');
        currentlySelectedItemName = $(this).closest('tr').children().eq(0).html();

        $.ajax({
            url: "/transaksi/item/note/list/" + currentlySelectedItemTransactionID,
        }).done(function(data) {
            let notes = data[0];

            notes.forEach(note => {
                $('#table-list-catatan tbody').append("<tr id='" + note.id + "'><td>" + note.nama_user + "</td><td>" + note.catatan + "</td><td class='text-end' style='padding: 4px 8px;'><button class='btn btn-primary btn-sm' type='button'>Show</button></td></tr>");
            });

            $('#modal-list-catatan-item').modal('show');
        });
    });

    $('.stain-selection').on('click', function() {
        $(this).toggleClass('selected');
    });

    $('#formCheck-express, #formCheck-setrika').on('change', function() {
        if($(this).is(':checked')) {
            $(this).val(1);
        } else {
            $(this).val(0);
        }
    });

    // show catatan item
    $('#table-list-catatan tbody').on('click', '.btn', function() {
        $('#catatan-item-name').text(currentlySelectedItemName);
        $.ajax({
            url: "/transaksi/item/note/" + $(this).closest('tr').attr('id'),
        }).done(function(data) {
            let transNote = data[0];

            $('#penulis-catatan-item').val(transNote.nama_user);
            $('#catatan-item').val(transNote.catatan);
            $('#container-image-item').attr('src', transNote.image_path);

            transNote.front_top_left == 1 ? $('#td-kiri-atas').addClass('selected') : null;
            transNote.front_top_right == 1 ? $('#td-kanan-atas').addClass('selected') : null;
            transNote.front_bottom_left == 1 ? $('#td-kiri-bawah').addClass('selected') : null;
            transNote.front_bottom_right == 1 ? $('#td-kanan-bawah').addClass('selected') : null;
            transNote.back_top_left == 1 ? $('#tb-kiri-atas').addClass('selected') : null;
            transNote.back_top_right == 1 ? $('#tb-kanan-atas').addClass('selected') : null;
            transNote.back_bottom_left == 1 ? $('#tb-kiri-bawah').addClass('selected') : null;
            transNote.back_bottom_right == 1 ? $('#tb-kanan-bawah').addClass('selected') : null;

            $('#penulis-catatan-item').addClass('disabled');
            $('#catatan-item').addClass('disabled');
            $('#input-foto-item').hide();
            $('#tab-noda').addClass('disabled');

            $('#modal-catatan-item .modal-footer').hide();
            $('#modal-catatan-item').modal('show');
        });
    });

    // add catatan item
    $('#add-catatan-item').on('click', function() {
        $('#catatan-item-name').text(currentlySelectedItemName);

        $('#penulis-catatan-item').removeClass('disabled');
        $('#catatan-item').removeClass('disabled');
        $('#input-foto-item').show();
        $('#tab-noda').removeClass('disabled');

        // clear catatan
        $('#penulis-catatan-item').val('');
        $('#catatan-item').val('');
        $('#container-image-item').prop('src', '');
        $('#input-foto-item').val('');

        $('#td-kiri-atas').addClass('selected').removeClass('selected');
        $('#td-kanan-atas').addClass('selected').removeClass('selected');
        $('#td-kiri-bawah').addClass('selected').removeClass('selected');
        $('#td-kanan-bawah').addClass('selected').removeClass('selected');
        $('#tb-kiri-atas').addClass('selected').removeClass('selected');
        $('#tb-kanan-atas').addClass('selected').removeClass('selected');
        $('#tb-kiri-bawah').addClass('selected').removeClass('selected');
        $('#tb-kanan-bawah').addClass('selected').removeClass('selected');

        $('#modal-catatan-item .modal-footer').show();
        $('#modal-catatan-item').modal('show');
    });

    // save catatan item
    $('#simpan-catatan-item').on('click', function() {
        $(this).addClass('disabled');

        let formData = new FormData();
        formData.append('item_transaksi_id', currentlySelectedItemTransactionID);
        formData.append('modified_by', $('#penulis-catatan-item').val());
        formData.append('catatan', $('#catatan-item').val());
        formData.append('image', $('#input-foto-item').prop("files")[0]);

        formData.append('front_top_left', $('#td-kiri-atas').hasClass('selected') ? 1 : 0);
        formData.append('front_top_right', $('#td-kanan-atas').hasClass('selected') ? 1 : 0);
        formData.append('front_bottom_left', $('#td-kiri-bawah').hasClass('selected') ? 1 : 0);
        formData.append('front_bottom_right', $('#td-kanan-bawah').hasClass('selected') ? 1 : 0);
        formData.append('back_top_left', $('#tb-kiri-atas').hasClass('selected') ? 1 : 0);
        formData.append('back_top_right', $('#tb-kanan-atas').hasClass('selected') ? 1 : 0);
        formData.append('back_bottom_left', $('#tb-kiri-bawah').hasClass('selected') ? 1 : 0);
        formData.append('back_bottom_right', $('#tb-kanan-bawah').hasClass('selected') ? 1 : 0);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            url: "/transaksi/item/note/add",
            method: "POST",
            contentType: false,
            processData: false,
            data: formData,
        }).done(function() {
            $(this).removeClass('disabled');
            $('#modal-catatan-item').hide();
        }).fail(function(message) {
            alert(console.log(message));
        });
    });
});
