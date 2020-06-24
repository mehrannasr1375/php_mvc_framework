<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->site_title ?></title>
    <link rel="stylesheet" href="<?=PROOT?>css/bootstrap.css">
    <link rel="stylesheet" href="<?=PROOT?>css/rtl.css">
    <link rel="stylesheet" href="<?=PROOT?>css/main.css">
    <link rel="stylesheet" href="<?=PROOT?>css/font-awesome.css">
    <?= $this->content('head'); ?>
</head>
<body>



<?php include "main_menu.php"; ?>
    


<div class="container-fluid py-3">
    <?= $this->content('body'); ?>
</div>



<!-- scripts -->
<script src="<?=PROOT?>js/jquery.popper.bootstrap.js"></script>
<script src="<?=PROOT?>js/iran_cities.js"></script>
<script src="<?=PROOT?>js/main.js"></script>
</body>
</html>