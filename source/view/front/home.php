<?php include 'master.php' ?>
<?php startblock('title') ?>
    <title>DashBoard</title>
<?php endblock() ?>
<?php startblock('main') ?>
    <div class="sidebar" data-color="green" data-image="public/assets/img/sidebar-5.jpg">
        <?php include('sidebar.php'); ?>
    </div>
    <div class="main-panel">
        <?php include('header.php'); ?>
        <?php startblock('content') ?>
        <?php endblock()?>
        <?php include('footer.php'); ?>
    </div>
<?php endblock() ?>
<?php startblock('script') ?>

<?php endblock() ?>