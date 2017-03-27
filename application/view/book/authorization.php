<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 27.03.17
 * Time: 11:30
 */
?>
<div class="errors">
    <?if(!empty($error)){?>
        <?foreach ($error as $e){?>
            <p class="text-error"><?=$e?></p>
        <?}?>
    <?}?>
</div>
<form method="POST" action="<?php echo URL; ?>book/auth">
    <table>
        <tr>
            <td>
                <label>Логин</label>
                <input name="login" type="text">
            </td>
            <td>
                <label>Пароль</label>
                <input name="password" type="password">
            </td>
        </tr>
        <tr>
            <td>
                <input name="enter" type="submit" value="Войти">
            </td>
            <td>
                <input name="register" type="submit" value="Зарегистрироваться">
            </td>
        </tr>
    </table>
</form>






</form>
