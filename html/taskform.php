<?php 
    $isEditing = isset($_GET["id"]);
?>

<h3>Task Form</h3>

<form id="task-form" hidden></form>

<div class="form-group bg-light">
    <label for="task-name-input">Task Name</label>
    <input id="task-name-input" class="form-control" form="task-form" type="text" name="task_name">
</div>
<div class="form-group bg-light">
    <label for="task-desc-input">Task Description</label>
    <textarea class="form-control" id="task-desc-input" rows="3" form="task-form" name="task_description"></textarea>
    </div>
    <label>Task Type</label>
    <div class="form-check">
    <input class="form-check-input" form="task-form" type="radio" name="task_type" id="reminding-input" value="0" checked>
    <label class="form-check-label" for="reminding-input">Reminding - Suitable for niche activities and remains in place after it's specified end date & time.</label>
    </div>
    <div class="form-check">
    <input class="form-check-input" form="task-form" type="radio" name="task_type" id="expiring-input" value="1">
    <label class="form-check-label" for="expiring-input">Expiring - Suitable for due dates and is erased after the specified end date and time.</label>
    </div>
    <br>
    <div class="form-row bg-light">
    <div class="col">
        <label for="start-datetime-input">Task Start Date & Time</label>
        <input class="form-control" type="datetime-local" form="task-form" name="starting_time" id="start-datetime-input">
    </div>
    <div class="col">
        <label for="end-datetime-input">Task End Date & Time</label>
        <input class="form-control" type="datetime-local" form="task-form" name="ending_time" id="end-datetime-input">
    </div>
    </div>
    <br>
    <?php
        if ($isEditing)
        {
            echo '<button id="form-update-btn" class="btn btn-warning">Update</button>';
            echo '<input form="task-form" type="text" name="task_id" value="'. $_GET["id"] .'" hidden>';
            echo '<input form="task-form" type="text" name="username" value="'. $_SESSION["loginName"] .'" hidden>';
            echo '<button class="btn btn-secondary ml-2" onclick="document.location.href=\'index.php?page=taskView&date='. $_SESSION['selected_calendar_date'] .'\'">Cancel</button>';
        }
        else
        {
            echo '<button id="form-submit-btn" class="btn btn-primary">Create</button>';
            echo '<button class="btn btn-secondary ml-2" onclick="document.location.href=\'index.php?page=calendar\'">Cancel</button>';
        }
            
    ?>
</div>
<script>
    let isEditing = <?= $isEditing == true ? "true" : "false" ?>;
    let taskManagementAction = isEditing ? "update" : "create";

    function submit()
    {
        event.preventDefault();

        let formData = Object.fromEntries(new FormData(document.getElementById("task-form")).entries());

        for (const key in formData) {
            if (formData[key].length == 0) {
                alert(`Missing field: ${key} `)
                return;
            }
        }

        let unixStartTime = Date.parse(formData.starting_time);
        let unixEndTime = Date.parse(formData.ending_time);
        
        if (unixEndTime <= unixStartTime) {
            alert("End date and time cannot be lower than or equal to the start date and time.")
            return;
        }

        let JSONBody = JSON.stringify(formData);
        
        console.log(formData);
        
        $.ajax({
            type: "POST",
            url: `../index.php?controller=taskManagement&action=${taskManagementAction}`,
            data: JSONBody,
            dataType: "json",
            success: function(data) {
                document.location.href = "index.php?page=calendar";
            },
            error: function(xhr, status, error) {
                console.error("Error in AJAX request:", error);
            }
        });
    }

    if (isEditing)
    {
        // user is editing form; populate all fields
        $.ajax({
            type: "GET",
            url: "../index.php?controller=taskManagement&action=readFromID&id=<?= $_GET["id"] ?>",
            success: function(response) {
                console.log("Response: ", response);

                $("#task-name-input").val(response.task_name);
                $("#task-desc-input").val(response.task_description);
                $("#start-datetime-input").val(response.starting_time);
                $("#end-datetime-input").val(response.ending_time);

                if (response.task_type == 1)
                {
                    $("#reminding-input").removeAttr("checked");
                    $("#expiring-input").attr("checked", "true");
                }
            },
            error: function(xhr, status, error) {
                console.error("Error in AJAX request:", xhr.responseText);
            }
        });
    }
    
    $("#form-update-btn").click(submit);
    $("#form-submit-btn").click(submit);
</script>