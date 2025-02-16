window.addEventListener('elementor/init', () => {
    var form_select = elementor.modules.controls.BaseData.extend({
        onReady: function () {
            // elementor.modules.controls.BaseData.prototype.onReady.apply(this, arguments);
            var cur_val = this.getControlValue();
            this.form_select = this.$el.find('.rform-select-form');
            this.form_select_edit = this.$el.find('.rform-select-edit');
            this.hidden_form_id = this.$el.find('.hidden-form_id');
            this.select_save_btn = this.$el.find('.rform-select-savebtn');
            this.new_save_btn = this.$el.find('.rform-new-savebtn');
            this.form_select.val(cur_val).trigger('change');

            this.select_save_btn.on('click', () => {
                this.val = this.form_select.val();
                this.saveValue();
                this.$el.find('.rform-editform-modal').hide();
            });
            this.form_select_edit.on('click', () => {
                this.val = this.form_select.val();
                this.saveValue();
                this.$el.find('.rform-editform-modal').hide();
                var url = adminData.adminUrl + 'post.php?post=' + this.form_select.val() + '&action=elementor';
                this.$el.find('.rform-ifr-editor').attr('src', url);
                this.$el.find('.rform-editor-modal').show();
            });

            this.new_save_btn.on('click', () => {
                var form_data = this.new_save_btn.closest('#tab-content-new').find('#rform-newform').serialize();
                this.new_save_btn.html('Saving...');
                this.new_save_btn.prop('disabled', true);
                var nonce = adminData.nonce;
                var data = form_data + '&nonce=' + nonce;
                jQuery.ajax({
                    type: 'POST',
                    url: adminData.ajax_url,
                    data: data,
                    success: (e) => {
                        this.val = e.data.form_id;
                        this.saveValue();
                        this.$el.find('.rform-editform-modal').hide();
                        var url = adminData.adminUrl + 'post.php?post=' + e.data.form_id + '&action=elementor';
                        this.$el.find('.rform-ifr-editor').attr('src', url);
                        this.$el.find('.rform-editor-modal').show();
                        this.new_save_btn.html('Save $ Edit');
                        this.new_save_btn.removeProp('disabled');
                        var new_opt = jQuery('<option>', {
                            value: e.data.form_id,
                            text: e.data.form_name,
                            selected: true
                        });

                        this.$el.find('.rform-select-form').append(new_opt);
                        this.$el.find('#rform-newform').trigger('reset');
                        this.$el.find('#tab-select').prop('checked', true);
                        this.$el.find('#tab-content-new').hide();

                    }
                });
            });

        },
        saveValue: function () {
            this.setValue(this.val);
        },
    });
    elementor.addControlView('rform_control', form_select);
});