<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 20.03.17
 * Time: 17:11
 */
?>

<div class="container" id="accordeon">
    <h3>Добавление платежа</h3>
    <div>
        <form action="<?php echo URL; ?>book/addExpense" method="POST" id="form-add-expence">
            <table>
                <tr id="add_expence_row">
                    <td>
                        <label for="payment_direct_id">Направление платежа</label>
                        <select id="payment_direct_id" name="Payment[direct_id]">
                            <?foreach ($directs as $key=>$d){?>
                                <option value="<?=$key?>"><?=$d?></option>
                            <?}?>
                        </select>
                    </td>
                    <td>
                        <label for="payment_category_id">Категория</label>
                        <select id="payment_category_id" name="Payment[category_id]">
                            <?foreach ($categories as $key=>$category){?>
                                <option value="<?=$key?>"><?=$category?></option>
                            <?}?>
                        </select>
                    </td>
                    <td>
                        <label>Сумма</label>
                        <input type="text" name="Payment[summ]" value="" required />
                    </td>
                    <td>
                        <label>Дата</label>
                        <input type="text" name="Payment[date]" id="date" value="" required />
                    </td>
                    <td>
                        <input type="submit" id="submit_add_expence" class="submit_for_adding button28" name="submit_add_expense" value="Добавить" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <h3>Фильтр платежей</h3>
    <div>
        <table>
            <tr>
                <td>
                    <label>Выбрать заданный промежуток</label>
                    <select id="period" name="period">
                        <?foreach (Helper::get_time_array() as $key=>$d){?>
                            <option value="<?=$key?>"><?=$d?></option>
                        <?}?>
                    </select>
                </td>
                <td>
                    <label>Дата c</label>
                    <input type="text" name="date_start" id="date_start" value="" />
                </td>
                <td>
                    <label>Дата по</label>
                    <input type="text" name="date_end" id="date_end" value="" />
                </td>
                <td>
                    <label>Сумма</label>
                    <input type="text" name="filter_summ" id="filter_summ" value="" />
                </td>
            </tr>
            <tr>
                <td>
                    <label>Направление</label>
                    <select name="filter_direct_id" id="filter_direct_id">
                        <?foreach ($filter_directs as $key=>$d){?>
                            <option <?=$key==0?'selected="selected"':''?> value="<?=$key?>"><?=$d?></option>
                        <?}?>
                    </select>
                </td>
                <td>
                    <label>Сортировка</label>
                    <select name="filter_sort" id="filter_sort">
                        <?foreach ($filter_sort as $key=>$d){?>
                            <option value="<?=$key?>"><?=$d?></option>
                        <?}?>
                    </select>
                </td>
                <td>
                    <label>Параметры сортировки</label>
                    <select name="filter_sort_option" id="filter_sort_option">
                        <option value="0"></option>
                        <option value="1">По возрастанию</option>
                        <option value="2">По убыванию</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Категория</label>
                    <select name="filter_category_id" id="filter_category_id" multiple="multiple">
                        <?foreach ($filter_categories as $key=>$d){?>
                            <option <?=$key==0?'selected=selected':''?> value="<?=$key?>"><?=$d?></option>
                        <?}?>
                    </select>
                </td>
                <td class="text-bottom"><input type="button" id="clear_payments_list_filter" class="submit_for_adding button28" name="clear_payments_list_filter" value="Очистить" /></td>
                <td class="text-bottom"><input type="button" id="hide_payments_list" class="submit_for_adding hidden button28" name="hide_payments_list" value="Скрыть" /></td>
                <td class="text-bottom"><input type="button" id="show_payments_list" class="submit_for_adding button28" name="show_payments_list" value="Показать" /></td>
            </tr>
        </table>
        <div id="all_payments_list"></div>
    </div>
    <h3>Категории</h3>
    <div>
        <form action="<?php echo URL; ?>book/addCategory" method="POST" id="form-add-category">
            <table>
                <tr id="add_category_row">
                    <td>
                        <label>Название категории</label>
                        <input name="Category[name]" value="" required />
                    </td>
                    </td>
                    <td>
                        <input type="submit" id="submit_add_category" class="submit_for_adding button28" name="submit_add_category" value="Добавить" />
                    </td>
                    <td>
                        <input type="button" id="show_category_list" class="submit_for_adding button28" name="show_category_list" value="Показать все" />
                    </td>
                </tr>
            </table>
        </form>
        <div id="all_category_list"></div>
    </div>
</div>
<!--
<h3>Amount of songs (via AJAX)</h3>
<div>
    <button id="javascript-ajax-button">Click here to get the amount of songs via Ajax (will be displayed in #javascript-ajax-result-box)</button>
    <div id="javascript-ajax-result-box"></div>
</div>
-->

<div id="place_for_dialog"></div>





