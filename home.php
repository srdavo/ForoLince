<?php include_once 'views/header.php'; ?>

<transparent>
    <?php include_once "views/windows.php"; ?>
</transparent>

<main>
    <?php include_once "views/navbar.php"; ?>
    <holder>
        <?php 
            include_once "views/toolbar.php"; 
            include_once "views/sections.php"; 
        ?>
    </holder>
</main>
<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        if(localStorage.getItem("currentSection")){toggleSection(localStorage.getItem("currentSection"))}
        getEventsTable();
    });
</script>
<?php include_once 'views/footer.php'; ?>


