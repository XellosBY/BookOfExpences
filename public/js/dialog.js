/**
 * Created by tim on 30.03.17.
 */
var updateDialog = {
    dialog : '',

    form : '',

    // From http://www.whatwg.org/specs/web-apps/current-work/multipage/states-of-the-type-attribute.html#e-mail-state-%28type=email%29
    emailRegex : /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/,

    valid_date : $('#modal_date'),

    valid_summ : $('#modal_summ'),

    tips : $(".validateTips"),

    updateTips: function (t) {
        $(".validateTips")
            .text(t)
            .addClass("ui-state-highlight");
        setTimeout(function () {
            $(".validateTips").removeClass("ui-state-highlight", 1500);
        }, 500);
    },

    checkRegexp: function(o, regexp, n)  {
        if (!( regexp.test(o.val()) )) {
            o.addClass("ui-state-error");
            updateDialog.updateTips(n);
            return false;
        } else {
            return true;
        }
    },


    checkLength: function (o, n, min, max) {
        if (o.val().length > max || o.val().length < min) {
            o.addClass("ui-state-error");
            updateDialog.updateTips("Length of " + n + " must be between " +
                min + " and " + max + ".");
            return false;
        } else {
            return true;
        }
    },

    updateExpence: function() {
        var valid = true;

        date = $('#modal_date').val();
        summ = $('#modal_summ').val();
        direct_id = $('#modal_payment_direct_id').val();
        category_id = $('#modal_payment_category_id').val();
        id = $('#model_id').val();

        data_arr = {'date': date, 'summ': summ, 'direct_id': direct_id, 'category_id': category_id, 'id': id};

        valid = valid && updateDialog.checkLength($('#modal_date'), "дата", 8, 12);
        valid = valid && updateDialog.checkLength($('#modal_summ'), "сумма", 1, 80);

        valid = valid && updateDialog.checkRegexp($('#modal_summ'), /^\d+$/, "Поле Сумма заполнено некорректно");
        valid = valid && updateDialog.checkRegexp($('#modal_date'), /^\d{2}\.\d{2}\.\d{4}/, "корректный формат даты 'дд.мм.уууу.'");

        if (valid) {
            $.ajax({
                'url': url + "/book/updateExpence",
                'data': data_arr,
                'type': 'post',
                'dataType': 'text',
            }).done(function (result) {
                $("#dialog-form").dialog("close");
                $('#show_payments_list').trigger('click');
            });
        }
    },

    update_payment_row: function (id) {
        $.ajax(url + "/book/ajaxLoadPayment/"+id)
            .done(function(result){
                $('#place_for_dialog').html(result);
                $('#modal_date').datepicker({dateFormat: 'dd.mm.yy'});
                this.dialog = $( "#dialog-form" ).dialog({
                    autoOpen: false,
                    height: 400,
                    width: 350,
                    modal: true,
                    buttons: {
                        "Сохранить": updateDialog.updateExpence,
                        "Отмена": function() {
                            this.dialog.dialog( "close" );
                        }
                    },
                    close: function() {

                    }
                });

                this.form = this.dialog.find( "form" ).on( "submit", function( event ) {
                    event.preventDefault();
                    updateDialog.updateExpence();
                });

                this.dialog.dialog( "open" );
            });
    },



}

/////end dialog part ///////