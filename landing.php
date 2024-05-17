<?php include_once 'views/header.php'; ?>

<transparent>
    <?php include_once "views/landing/landing-windows.php"; ?>
</transparent>
<!-- <div class="transparent-cards" style="display:none; z-index:5; width:100%; height:100vh; inset:0; position:fixed; background:rgba(var(--normalInverted), 0.5)">

</div> -->

<main>
    <?php include_once "views/landing/landing-navbar.php";?>
    <holder id="holder-landing" style="align-items: center"> 
        <?php 
            // include_once "views/landing/landing-navbar.php";
            // include_once "views/landing/landing-toolbar.php"; 
            include_once "views/landing/landing-section.php"; 
        ?>
    </holder>
</main>
<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        getEventsCards();
        getNewsCards();
    });
</script>

<?php include_once 'views/footer.php'; ?>


