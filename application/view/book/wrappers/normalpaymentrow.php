<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 23.03.17
 * Time: 13:17
 */
?>
<td id="id_<?=$payment->id?>"></td>
<td><?php if (isset($payment->date)) echo htmlspecialchars($payment->date, ENT_QUOTES, 'UTF-8'); ?></td>
<td><?php if (isset($payment->category)) echo htmlspecialchars($payment->category->name, ENT_QUOTES, 'UTF-8'); ?></td>
<td><?php if (isset($payment->direct)) echo htmlspecialchars($payment->direct->name, ENT_QUOTES, 'UTF-8'); ?></td>
<td id="<?=$payment->direct_id.'_'.$payment->id?>" class="payment_summ"><?php if (isset($payment->summ)) echo htmlspecialchars($payment->summ, ENT_QUOTES, 'UTF-8'); ?></td>
<td>
    <a href="#" onclick="event.preventDefault();delete_payment(<?=$payment->id?>)"><i class="icon-trash"></i></a>
    <a href="#" onclick="event.preventDefault();updateDialog.update_payment_row(<?=$payment->id?>);"><i class="icon-edit"></i></a>
    <a href="#" onclick="event.preventDefault();enter_admin_mode(<?=$payment->id?>,'on')"><i class="icon-pencil"></i></a>
</td>
