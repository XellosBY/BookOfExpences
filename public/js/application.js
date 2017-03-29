$(function() {

    $('#accordeon').accordion(
        {
            heightStyle: "content",
            icons:{
                header: "ui-icon-circle-arrow-e",
                activeHeader: "ui-icon-circle-arrow-s"
            },
        });

    // just a super-simple JS demo

    var demoHeaderBox;

    // simple demo to show create something via javascript on the page
    if ($('#javascript-header-demo-box').length !== 0) {
        demoHeaderBox = $('#javascript-header-demo-box');
        demoHeaderBox
            .hide()
            .text('Hello from JavaScript! This line has been added by public/js/application.js')
            .css('color', 'green')
            .fadeIn('slow');
    }

    $('#exit_button').on('click', function () {
        deleteCookie('id');
        deleteCookie('hash');
    });

    $('#show_category_list').on('click', function(){
        ajaxLoadContent($('#show_category_list'), $('#all_category_list'),'ajaxGetCategoryList');
    });

    $('#hide_payments_list').on('click', function () {
        $('#all_payments_list').html('');
        $('#hide_payments_list').addClass('hidden');
    });

    $('#clear_payments_list_filter').on('click', function () {
        date_start = $('#date_start').val('');
        date_end = $('#date_end').val('');
        period = $('#period').val('');
        category_id = $('#filter_category_id').val('');
        direct_id = $('#filter_direct_id').val('');
        summ = $('#filter_summ').val('');
        sort = $('#filter_sort').val('');
        sort_option = $('#filter_sort_option').val('');
    });

    $('#show_payments_list').on('click', function(){
        ajaxLoadContent($('#show_payments_list'), $('#all_payments_list'),'ajaxGetPaymentsList');
    });
});

$(function(){
    //$('#date').datepicker({dateFormat: 'yyyy-mm-dd'}); //calendar

    $('#show_add_expence_row').on('click',function (event) {
        event.preventDefault();
        $('#add_expence_row').toggleClass('hidden');
        swapClass($('#show_add_expence_row'), 'icon-chevron-down', 'icon-chevron-up');
    });
    $('#show_add_category_row').on('click',function (event) {
        event.preventDefault();
        $('#add_category_row').toggleClass('hidden');
        swapClass($('#show_add_category_row'), 'icon-chevron-down', 'icon-chevron-up');
    })
});


///////////////////////////// CRUD ACTIONS ////////////////////
function delete_payment(id) {
    confirm('Вы уверены что хотите удалить платеж?');
    addr = location.search+'book/deleteExpence/'+id;
    $.ajax({
        'url': addr,
        'type': 'get',
        'dataType': 'json',
    });
}

function delete_category(id) {
    confirm('Вы уверены что хотите удалить категорию?');
    addr = location.search+'book/deleteCategory/'+id;
    $.ajax({
        'url': addr,
        'type': 'get',
        'dataType': 'json',
    });
}
///////////////////////////// END CRUD ACTIONS ////////////////

function ajaxLoadContent(button, area, action) {
        //console.log($('#period').val(),$('#date_start').val(),$('#date_end').val()); //todo отправляем параметры по УРЛУ и модиф скюэль
        date_start = $('#date_start').val();
        date_end = $('#date_end').val();
        period = $('#period').val();
        category_id = $('#filter_category_id').val();
        direct_id = $('#filter_direct_id').val();
        summ = $('#filter_summ').val();
        sort = $('#filter_sort').val();
        sort_option = $('#filter_sort_option').val();
        data = {
            'date_start': date_start,
            'date_end': date_end,
            'period':period,
            'category_id':category_id,
            'direct_id':direct_id,
            'summ':summ,
            'sort':sort,
            'sort_option':sort_option,
            'with_filters': 1,
        };
        $.ajax({
            'url': url + "/book/" + action,
            'data': data,
            'type': 'post',
            'dataType': 'text',
            //'error': function(jqXHR, textStatus, errorThrown) { console.log(errorThrown); console.log(textStatus); }
        }).done(function(data) {
            if(button.val()=='Скрыть'){
                area.html('');
                button.val('Показать');
            }else{
                if(action != 'ajaxGetPaymentsList'){
                    button.val('Скрыть');
                }
                area.html(data);
            }

            if(action == 'ajaxGetPaymentsList'){
                countPaymentSummItogo();
                $('#hide_payments_list').removeClass('hidden');
            }

        }).fail(function() {
            area.html('Не удалось загрузить информацию');
        });
}

function enter_admin_mode(id, admin_mode) {
    if(admin_mode == 'on'){
        $.ajax(url + "/book/ajaxGetAdminRow/"+id)
            .done(function(result) {
                $('#paymentrow_'+id).html(result);
                setNumberColumn(id);
            });
    }else if(admin_mode == 'off'){
        $.ajax(url + "/book/ajaxNormalPaymentRow/"+id)
            .done(function(result) {
                $('#paymentrow_'+id).html(result);
                setNumberColumn(id);
            });
    }
}

function setNumberColumn(id) {
    next = $('#paymentrow_'+id).next().children(':nth-child(1)').html();
    current = parseInt(next - 1);
    $('#id_'+id).html(current);
}

function countPaymentSummItogo() {
    var summ_array = $('.payment_summ');
    var i = 0;
    if(summ_array.length != 0){
        f_summ = 0;
        dohod = 0;
        rashod = 0;
        for (i = 0; i < summ_array.length; i++) {
            array = $(summ_array[i]).attr('id').split('_');
            if(array[0] == 1){
                f_summ += parseFloat($(summ_array[i]).html());
                dohod += parseFloat($(summ_array[i]).html());
            }else{
                f_summ -= parseFloat($(summ_array[i]).html());
                rashod -= parseFloat($(summ_array[i]).html());
            }
            //console.log(f_summ);
            if(i == (summ_array.length - 1)){
                $('#payment_summ_itogo').html(f_summ.toFixed(2));
                $('#dohod').html(dohod.toFixed(2));
                $('#rashod').html(rashod.toFixed(2));
            }
        }
    }else{
        $('#payment_summ_itogo').html(0);
    }
}

function swapClass(object, classNow, classForSwap){
    if( object.find('i').hasClass(classNow)){
        object.find('i').removeClass(classNow);
        object.find('i').addClass(classForSwap);
    }else{
        object.find('i').removeClass(classForSwap);
        object.find('i').addClass(classNow);
    }
}

function isNumber(n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
}

function setCookie(name, value, options) {
    options = options || {};

    var expires = options.expires;

    if (typeof expires == "number" && expires) {
        var d = new Date();
        d.setTime(d.getTime() + expires * 1000);
        expires = options.expires = d;
    }
    if (expires && expires.toUTCString) {
        options.expires = expires.toUTCString();
    }

    value = encodeURIComponent(value);

    var updatedCookie = name + "=" + value;

    for (var propName in options) {
        updatedCookie += "; " + propName;
        var propValue = options[propName];
        if (propValue !== true) {
            updatedCookie += "=" + propValue;
        }
    }

    document.cookie = updatedCookie;
}

function deleteCookie(name) {
    setCookie(name, "", {
        expires: -1,
        path: '/',
    })
}
