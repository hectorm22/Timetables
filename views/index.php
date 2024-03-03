<?php 
    include_once("header.php"); 
?>

<div class="container">
<?php
    $page = isset($_GET["page"]) ? $_GET["page"] : "calendar";

    // authorized navigation
    switch ($page)
    {
        case 'calendar':
            include_once("../html/calendar.php");
            break;    
        case 'taskForm':
            include_once("../html/taskform.php");
            break;    
        case 'taskView':
            include_once("../html/taskview.php");
            break;
        case 'report':
            include_once("../html/report.php");
            break;
    }
?>
</div>

<?php include_once("footer.php"); ?>
