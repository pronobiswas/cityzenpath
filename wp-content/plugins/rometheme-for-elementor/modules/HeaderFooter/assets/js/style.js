jQuery(document).ready(($) => {
    $('#ModalEdit').on('show.bs.modal', (event) => {
        var edit_button = $(event.relatedTarget);
        var post_id = edit_button.data('post-id');
        var post_name = edit_button.data('post-name');
        var type = edit_button.data('type');
        var active = edit_button.data('active');
        var modal = $('#ModalEdit');
        var condition = edit_button.data('condition');
        modal.find('#id').val(post_id);
        modal.find('#inputTitle').val(post_name);
        modal.find('#inputType').val(type);

        // Pastikan condition adalah array dan tidak null
        if (typeof condition === "object") {
            $.each(condition, (key, item) => {
                $.each(item, (index, val) => {
                    // Membuat container untuk elemen-elemen baru
                    var selectcontainer = $('<div class="d-flex flex-row"></div>');
                    // Membuat div untuk input group
                    var inputGroup = $('<div class="input-group"></div>');
                    // Membuat tombol close
                    var closeBtn = $('<button class="btn p-3 del-condition"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16"><path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>/svg></button>');

                    closeBtn.click(function () {
                        // Hapus elemen selectcontainer saat tombol close diklik
                        selectcontainer.remove();
                    });

                    // Membuat select untuk kondisi
                    var selectCondition = $('<select class="form-select w-25 py-2 condition-select"></select>');
                    selectCondition.append('<option value="include"' + (key === "include" ? " selected" : "") + '>Include</option>');
                    selectCondition.append('<option value="exclude"' + (key === "exclude" ? " selected" : "") + '>Exclude</option>');

                    selectCondition.change(function (event) {
                        var select = $(event.currentTarget);
                        // Ubah properti 'name' pada dropdown halaman sesuai dengan nilai dropdown "Include/Exclude" yang dipilih
                        select.closest('.input-group').find('.page-select').prop('name', select.val() + '[]');
                    });

                    // Membuat select untuk halaman
                    var selectPage = $('<select class="form-select w-75 py-2 page-select" name="' + key + '[]"></select>');
                    selectPage.append('<option value="all" selected>Entire Site</option>');
                    selectPage.append('<option value="archives"' + (val === "archives" ? " selected" : "") + '>Archives</option>');
                    selectPage.append('<option value="singular"' + (val === "singular" ? " selected" : "") + '>Singular</option>');
                    selectPage.append('<option value="404"' + (val === "404" ? " selected" : "") + '>404</option>');
                    // Menambahkan selectCondition dan selectPage ke dalam inputGroup
                    inputGroup.append(selectCondition);
                    inputGroup.append(selectPage);
                    // Menambahkan inputGroup dan closeBtn ke dalam selectcontainer
                    selectcontainer.append(inputGroup);
                    selectcontainer.append(closeBtn);
                    // Menambahkan selectcontainer ke dalam dokumen
                    modal.find('.conditions').append(selectcontainer);
                });
            });
        }

        if (active === true) {
            modal.find('#active').prop("checked", true)
        } else {
            modal.find('#active').prop("checked", false)
        }
    });

    $('#ModalEdit').on('hidden.bs.modal', (event) => {
        var modal = $(event.currentTarget);
        modal.find('.conditions').empty();
    });

    $('#edit-submit-btn').click((event) => {
        $(event.currentTarget).html('Saving...');
        $(event.currentTarget).prop('disabled', true);
        $('#edit_form').find('#close-btn').prop('disabled', true);
        $('#edit_form').find('.btn-close').prop('disabled', true);
        form_data = $("#edit_form").serialize();
        nonce = rometheme_ajax_url.nonce;
        var data = form_data + '&nonce=' + nonce;
        $.ajax({
            type: 'post',
            url: rometheme_ajax_url.ajax_url,
            data: data,
            success: (data) => {
                location.href = rometheme_url.themebuilder_url;
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("The following error occured: " + textStatus, errorThrown);
            },
        });
    });

    $('#add-submit-btn').click((event) => {
        event.preventDefault();
        $(event.currentTarget).html('Saving...');
        $(event.currentTarget).prop('disabled', true);
        $('#add-new-post').find('#close-btn').prop('disabled', true);
        $('#add-new-post').find('.btn-close').prop('disabled', true);
        form_data = $('#add-new-post').serialize();
        nonce = rometheme_ajax_url.nonce;
        var data = form_data + '&nonce=' + nonce;
        data = form_data + '&nonce=' + nonce;  
        $.ajax({
            type: 'post',
            url: rometheme_ajax_url.ajax_url,
            data: data,
            success: (data) => {
                location.href = rometheme_url.themebuilder_url;
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("The following error occured: " + textStatus, errorThrown);
            },
        });
    });

    $('.add-condition').click(function (event) {
        event.preventDefault();
        // Buat elemen baru menggunakan sintaks yang lebih mudah dibaca
        var select = $('<div class="d-flex flex-row"><div class="input-group"><select class="form-select w-25 py-2 condition-select"><option value="include" selected>Include</option><option value="exclude">Exclude</option></select><select class="form-select w-75 py-2 page-select" name="include[]"><option value="all" selected>Entire Site</option><option value="archives">Archives</option><option value="singular">Singular</option><option value="404">404</option></select></div><button class="btn p-3 del-condition"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16"><path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>/svg></button></div>');

        // Simpan referensi ke container kondisi terdekat
        var conditionContainer = $(event.currentTarget).closest('.condition-container');

        // Tambahkan elemen baru ke dalam container kondisi
        conditionContainer.find('.conditions').append(select);

        // Tambahkan event listener untuk perubahan pada dropdown "Include/Exclude"
        select.find('.condition-select').change((event) => {
            var select = $(event.currentTarget);
            // Ubah properti 'name' pada dropdown halaman sesuai dengan nilai dropdown "Include/Exclude" yang dipilih
            select.closest('.input-group').find('.page-select').prop('name', select.val() + '[]');
        });

        // Tambahkan event listener untuk tombol "delete condition"
        select.find('.del-condition').click(function () {
            // Hapus elemen kondisi saat tombol "delete condition" diklik
            select.remove();
        });
    });



});
