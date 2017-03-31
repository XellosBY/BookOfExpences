<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 23.03.17
 * Time: 13:01
 */
?>
<td id="id_<?=$payment->id?>"></td>
<td>
    <a href="#" class="editable" id="date_<?=$payment->id?>" data-format="dd.mm.yyyy">
        <?php if (isset($payment->date)) echo htmlspecialchars($payment->date, ENT_QUOTES, 'UTF-8'); ?>
    </a>
</td>
<td>
    <a href="#" id="category_<?=$payment->id?>">
        <?php if (isset($payment->category)) echo htmlspecialchars($payment->category->name, ENT_QUOTES, 'UTF-8'); ?>
    </a>
</td>
<td>
    <a href="#" id="direct_<?=$payment->id?>">
        <?php if (isset($payment->direct)) echo htmlspecialchars($payment->direct->name, ENT_QUOTES, 'UTF-8'); ?>
    </a>
</td>
<td id="<?=$payment->direct_id.'_'.$payment->id?>">
    <a href="#" id="summ_<?=$payment->id?>" class="payment_summ">
        <?php if (isset($payment->summ)) echo htmlspecialchars($payment->summ, ENT_QUOTES, 'UTF-8'); ?>
    </a>
</td>
<td>
    <a href="#" onclick="event.preventDefault();delete_payment(<?=$payment->id?>)"><i class="icon-trash"></i></a>
    <a href="#" onclick="event.preventDefault();updateDialog.update_payment_row(<?=$payment->id?>);"><i class="icon-edit"></i></a>
    <a href="#" onclick="event.preventDefault();enter_admin_mode(<?=$payment->id?>,'off');countPaymentSummItogo();"><i class="icon-ok-circle"></i></a>
</td>

<script>
    $(function() {
        var id = <?=$payment->id?>;
        var url = location.search + '/book/updateRowByAjax/' +id+'/payment';

        $('#date_'+id).editable({
            type: 'date',
            pk: id,
            name: 'date',
            url: url,
            format: 'dd.mm.yyyy',
            viewFormat: 'dd.mm.yyyy',
            mode: 'inline',
        });

        $('#summ_'+id).editable({
            type:  'text',
            pk:    id,
            name:  'summ',
            url:  url,
            mode: 'inline',
            validate: function (value) {
                if(value.charAt(0) == '-'){
                    return 'Число должно быть положительным';
                }else if(!isNumber(value)){
                    return 'Значение должно быть числом';
                }
            },
        });
        $('#direct_'+id).editable({
            type:  'select',
            pk:    id,
            name:  'direct_id',
            value: <?=$payment->direct_id?>,
            source: <?=json_encode($directs)?>,
            url:   url,
            mode: 'inline',
            success: function (data) {
                if(data == 1){
                    $('#paymentrow_'+id).css('background-color','#B1FFA0');
                    countPaymentSummItogo();
                }else{
                    $('#paymentrow_'+id).css('background-color','#b67875');
                    countPaymentSummItogo();
                }
            }
        });
        $('#category_'+id).editable({
            type:  'select',
            pk:    id,
            name:  'category_id',
            value: <?=$payment->category_id?>,
            source: <?=json_encode($categories)?>,
            url:   url,
            mode: 'inline'
        });
    });
</script>
