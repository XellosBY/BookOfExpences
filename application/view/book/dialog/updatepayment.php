<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 30.03.17
 * Time: 13:03
 */
?>
<div id="dialog-form" title="Редактировать платеж">
    <p class="validateTips">All form fields are required.</p>

    <form action="<?=URL?>book/updateExpence">
        <fieldset>
            <label for="modal_summ">Сумма</label>
            <input type="text" id="modal_summ" name="Payment[summ]" value="<?=isset($ajax_payment->summ)?$ajax_payment->summ:''?>" class="text ui-widget-content ui-corner-all" required />

            <label for="modal_payment_direct_id">Направление платежа</label>
            <select id="modal_payment_direct_id" name="Payment[direct_id]" class="text ui-widget-content ui-corner-all">
                <?foreach ($directs as $key=>$d){?>
                    <option value="<?=$key?>" <?=($key == $ajax_payment->direct_id)?'selected=selected':''?> ><?=$d?></option>
                <?}?>
            </select>
            <label for="modal_payment_category_id">Категория</label>
            <select id="modal_payment_category_id" name="Payment[category_id]" class="text ui-widget-content ui-corner-all">
                <?foreach ($categories as $key=>$category){?>
                    <option value="<?=$key?>" <?=($key == $ajax_payment->category_id)?'selected=selected':''?> ><?=$category?></option>
                <?}?>
            </select>

            <label for="modal_date">Дата</label>
            <input type="date" name="Payment[date]" id="modal_date" value="<?=isset($ajax_payment->date)?$ajax_payment->date:''?>" class="text ui-widget-content ui-corner-all" required >

            <input type="text" id="model_id" class="hidden" name="Payment[id]" value="<?=isset($ajax_payment->id)?$ajax_payment->id:''?>">
            <!-- Allow form submission with keyboard without duplicating the dialog button -->
            <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
        </fieldset>
    </form>
</div>