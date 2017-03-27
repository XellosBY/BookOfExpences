<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>MINI</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- JS -->
    <!-- please note: The JavaScript files are loaded in the footer to speed up page construction -->
    <!-- See more here: http://stackoverflow.com/q/2105327/1114320 -->

    <!-- CSS -->
    <link href="<?php echo URL; ?>css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo URL; ?>css/jquery-ui.css" rel="stylesheet">
    <link href="<?php echo URL; ?>css/jquery-ui.theme.css" rel="stylesheet">
    <link href="<?php echo URL; ?>css/bootstrap-editable.css" rel="stylesheet">
    <link href="<?php echo URL; ?>css/style.css" rel="stylesheet">

</head>
<body>
    <!-- logo -->
    <div class="logo">
        BOOK
    </div>
    <?if(isset($_COOKIE['id']) && isset($_COOKIE['hash'])){?>
        <!-- navigation -->
        <div class="navigation">
            <a href="<?php echo URL; ?>book/index#top">Начало</a>
            <a href="<?php echo URL; ?>book/index#payments">Платежи</a>
            <a href="<?php echo URL; ?>book/index#category">Категории</a>
        </div>
        <div class="user_block">
            <span>Имя пользователя: </span><span class="right"><?= isset($user->name)?$user->name:''?> /</span>
            <a href="<?php echo URL; ?>book/auth" id="exit_button">Выйти</a>
        </div>
    <?}?>
