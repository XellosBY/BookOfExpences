<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 22.03.17
 * Time: 16:41
 */
?>
<h3>Список всех категорий</h3>
<table class="table table-bordered">
    <thead style="background-color: #ddd; font-weight: bold;">
        <tr>
            <th>№</th>
            <th>Название</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    <?php $i=0;?>
    <?php if(!empty($categories)){?>
        <?php foreach ($categories as $category) { ?>
            <?php $i++;?>
            <tr>
                <td><?=$i?></td>
                <td>
                    <a href="#" id="categoryname_<?=$category->id?>">
                        <?php if (isset($category->name)) echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?>
                    </a>
                </td>
                <td>
                    <a href="#" onclick="event.preventDefault();delete_category(<?=$category->id?>)"><i class="icon-trash"></i></a>
                </td>
            </tr>
            <script>
                $(function() {
                    var id = <?=$category->id?>;
                    $('#categoryname_' + id).editable({
                        type: 'text',
                        pk: id,
                        name: 'name',
                        mode: 'inline',
                        url: location.search + '/book/updateRowByAjax/' + id + '/category',
                    });
                });
            </script>
        <?php } ?>
    <?}?>
    </tbody>
</table>


