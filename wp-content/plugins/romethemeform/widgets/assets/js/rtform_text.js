function validate_input(cls_id, cls_err, id) {
    const input = document.getElementById(cls_id + id);
    const err = document.getElementById(cls_err + id);
    var data_val = input.getAttribute('data-val');
    var data_maxLength = input.getAttribute('data-val-maxLength');
    var data_minLength = input.getAttribute('data-val-minLength');
    if (input.hasAttribute('required')) {
        if (!input.value) {
            input.setAttribute('aria-invalid', true)
        } else {
            if (input.getAttribute('type') == 'email') {
                var validRegex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                if (!input.value.match(validRegex)) {
                    input.setAttribute('aria-invalid', true);
                } else {
                    if (data_maxLength != null || data_minLength != null) {
                        if (data_val == 'by_char') {
                            if (data_minLength > input.value.length || data_maxLength < input.value.length) {
                                input.setAttribute('aria-invalid', true)
                            } else {
                                input.setAttribute('aria-invalid', false);
                            }
                        } else if (data_val == 'by_word') {
                            var text = input.value;
                            var word_length = (text) ? text.match(/(\w+)/g).length : 0;
                            if (data_minLength > word_length || data_maxLength < word_length) {
                                input.setAttribute('aria-invalid', true)
                            } else {
                                input.setAttribute('aria-invalid', false);
                            }
                        } else {
                            input.setAttribute('aria-invalid', false);
                        }
                    } else {
                        input.setAttribute('aria-invalid', false);
                    }
                }
            } else {
                if (data_maxLength != null || data_minLength != null) {
                    if (data_val == 'by_char') {
                        if (data_minLength > input.value.length || data_maxLength < input.value.length) {
                            input.setAttribute('aria-invalid', true)
                        } else {
                            input.setAttribute('aria-invalid', false);
                        }
                    } else if (data_val == 'by_word') {
                        var text = input.value;
                        var word_length = (text) ? text.match(/(\w+)/g).length : 0;
                        if (data_minLength > word_length || data_maxLength < word_length) {
                            input.setAttribute('aria-invalid', true)
                        } else {
                            input.setAttribute('aria-invalid', false);
                        }
                    } else {
                        input.setAttribute('aria-invalid', false);
                    }
                } else {
                    input.setAttribute('aria-invalid', false);
                }
            }
        }
    } else {
        if (input.getAttribute('type') == 'email' && input.value != '' ) {
            var validRegex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if (!input.value.match(validRegex)) {
                input.setAttribute('aria-invalid', true);
            } else {
                if (data_maxLength != null || data_minLength != null) {
                    if (data_val == 'by_char') {
                        if (data_minLength > input.value.length || data_maxLength < input.value.length) {
                            input.setAttribute('aria-invalid', true)
                        } else {
                            input.setAttribute('aria-invalid', false);
                        }
                    } else if (data_val == 'by_word') {
                        var text = input.value;
                        var word_length = (text) ? text.match(/(\w+)/g).length : 0;
                        if (data_minLength > word_length || data_maxLength < word_length) {
                            input.setAttribute('aria-invalid', true)
                        } else {
                            input.setAttribute('aria-invalid', false);
                        }
                    } else {
                        input.setAttribute('aria-invalid', false);
                    }
                } else {
                    input.setAttribute('aria-invalid', false);
                }
            }
        } else {
            if (data_maxLength != null || data_minLength != null) {
                if (data_val == 'by_char') {
                    if (data_minLength > input.value.length || data_maxLength < input.value.length) {
                        input.setAttribute('aria-invalid', true)
                    } else {
                        input.setAttribute('aria-invalid', false);
                    }
                } else if (data_val == 'by_word') {
                    var text = input.value;
                    var word_length = (text) ? text.match(/(\w+)/g).length : 0;
                    if (data_minLength > word_length || data_maxLength < word_length) {
                        input.setAttribute('aria-invalid', true)
                    } else {
                        input.setAttribute('aria-invalid', false);
                    }
                } else {
                    input.setAttribute('aria-invalid', false);
                }
            } else {
                input.setAttribute('aria-invalid', false);
            }
        }
    }

}