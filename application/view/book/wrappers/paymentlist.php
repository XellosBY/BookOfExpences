<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 22.03.17
 * Time: 17:09
 */
?>
<h2>Список всех платежей</h2>
            <table class="table table-bordered table_t1">
                <thead style="background-color: #ddd; font-weight: bold;">
                <tr>
                    <th>№</th>
                    <th>Дата</th>
                    <th>Категория</th>
                    <th>Направление</th>
                    <th>Сумма</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php $i=0;?>
<?php if(!empty($payments)){?>
    <?php foreach ($payments as $payment) { ?>
        <?php $i++;?>
        <tr <?php echo ($payment->direct_id == Direct::PRIHOD)?'style="background-color:#B1FFA0"':'style="background-color:#b67875"'?> id="paymentrow_<?=$payment->id?>">
            <td><?=$i?></td>
            <td><?php if (isset($payment->date)) echo htmlspecialchars($payment->date, ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php if (isset($payment->category)) echo htmlspecialchars($payment->category->name, ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php if (isset($payment->direct)) echo htmlspecialchars($payment->direct->name, ENT_QUOTES, 'UTF-8'); ?></td>
            <td id="<?=$payment->direct_id.'_'.$i?>" class="payment_summ"><?php if (isset($payment->summ)) echo htmlspecialchars($payment->summ, ENT_QUOTES, 'UTF-8'); ?></td>
            <td>
                <a href="#" onclick="event.preventDefault();delete_payment(<?=$payment->id?>)"><i class="icon-trash"></i></a>
                <a href="#" onclick="event.preventDefault();updateDialog.update_payment_row(<?=$payment->id?>);"><i class="icon-edit"></i></a>
                <a href="#" onclick="event.preventDefault();enter_admin_mode(<?=$payment->id?>,'on')"><i class="icon-pencil"></i></a>
            </td>
        </tr>
    <?php } ?>
    <tr bgcolor="#d3e3fd">
        <td colspan="3"></td>
        <td id="_itogo">ИТОГО:</td>
        <td colspan="2" id="payment_summ_itogo"></td>
    </tr>
<?}?>
</tbody>
</table>
<br />
<div>
    <p><b><span>Справочно: </span></b></p>
    <p>
        <span>Всего доход: </span><span id="dohod"></span>
    </p>
    <p>
        <span>Всего расход: </span><span id="rashod"></span>
    </p>
</div>