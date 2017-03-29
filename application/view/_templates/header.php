<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>BOOK</title>
    <link rel="shortcut icon" class="logotip" href="/public/img/icons.png" type="image/png">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- JS -->
    <!-- please note: The JavaScript files are loaded in the footer to speed up page construction -->
    <!-- See more here: http://stackoverflow.com/q/2105327/1114320 -->

    <!-- CSS -->
    <link href="<?php echo URL; ?>css/jquery-ui.css" rel="stylesheet">
    <link href="<?php echo URL; ?>css/jquery-ui.theme.css" rel="stylesheet">
    <link href="<?php echo URL; ?>css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo URL; ?>css/bootstrap-editable.css" rel="stylesheet">
    <link href="<?php echo URL; ?>css/style.css" rel="stylesheet">

</head>
<body>
    <!-- logo -->
    <div id="top" class="logo center">
        BOOK
    </div>
    <?if(isset($_COOKIE['id']) && isset($_COOKIE['hash'])){?>
        <!-- navigation -->
        <div class="navigation">
            <a href="<?php echo URL; ?>book/index" class="button27">Начало</a>
            <a href="<?php echo URL; ?>book/index" class="button27">Платежи</a>
            <a href="<?php echo URL; ?>book/index" onclick="" class="button27">Фильтр платежей</a>
            <a href="<?php echo URL; ?>book/index" class="button27">Категории</a>
        </div>
        <div class="user_block">
            <a href="<?php echo URL; ?>book/auth" class="button11" id="exit_button"><?= isset($user->name)?$user->name:''?></a>
        </div>
    <?}?>
