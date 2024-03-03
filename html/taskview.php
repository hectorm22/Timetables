<?php 
    $_SESSION["selected_calendar_date"] = $_GET["date"];
?>

<style>
    th, td {
        padding: 2px 10px 2px 10px;
    }

    .task-btn {
        cursor: pointer;
        background-size: cover;
        padding: 15px 15px 15px 15px;
    }

    .task-btn:hover {
        background-color: lightgray;
    }

    .task-info { background-image: url("https://icons.iconarchive.com/icons/emey87/trainee/48/Orb-info-icon.png"); }
    .task-edit { background-image: url("https://icons.iconarchive.com/icons/emey87/trainee/48/Applications-icon.png"); }
    .task-delete { background-image: url("https://icons.iconarchive.com/icons/emey87/trainee/48/Badge-cancel-icon.png"); }
    .task-finish { background-image: url("https://icons.iconarchive.com/icons/emey87/trainee/48/Badge-tick-icon.png"); }
</style>

<div class="row">
    <div class="col bg-light">
        <div class="row justify-content-center"><h4>Critical Tasks</h4></div>
        <div class="row justify-content-center">
            <table border="1">
                <thead>
                    <th>Task Name</th>
                </thead>
                <tbody id="critical-tasks-list">
                </tbody>
            </table>
        </div>
    </div>
    <div class="col bg-light">
        <div class="row justify-content-center"><h4>Ongoing Tasks</h4></div>
        <div class="row justify-content-center">
        <table border="1">
                <thead>
                    <th>Task Name</th>
                </thead>
                <tbody id="ongoing-tasks-list">
                </tbody>
            </table>
        </div>
    </div>
</div>
<div id="desc" class="row justify-content-center">
</div>
<div class="row justify-content-center mt-2">
    <form class="mr-1" action="index.php?page=calendar" method="post">
        <input type="submit" class="btn btn-secondary" value="Calendar View">
    </form>
</div>
<script>
    function initializeTasks()
    {
        $.ajax({
            type: "get",
            url: `../index.php?controller=taskManagement&action=readFromDate&date=<?= $_SESSION["selected_calendar_date"] ?>&username=<?= $_SESSION["loginName"] ?>`,
            success: function(response)
            {
                console.log(response);

                let ongoingList = document.getElementById("ongoing-tasks-list");
                let criticalList = document.getElementById("critical-tasks-list");

                for (task of response)
                {
                    let daysLeft = (Math.abs(Date.parse(task.ending_time) - Date.now()) / 1000) / 86400;
                    let entryHTML = `
                        <tr>
                            <td>${task.task_name}</td>
                            <td class="task-btn task-info" onclick="displayTask('${task.task_id}')"></td>
                            <td class="task-btn task-edit" onclick="editTask(${task.task_id})"></td>
                            <td class="task-btn task-delete" onclick="deleteTask(${task.task_id})"></td>
                            <td class="task-btn task-finish" onclick="finishTask(${task.task_id})"></td>
                        </tr>`;

                    if (task.status == 1 && daysLeft <= 2)
                        criticalList.innerHTML += entryHTML;
                    else if (task.status == 1 && daysLeft > 2)
                        ongoingList.innerHTML += entryHTML;
                }
            },
            error: function(xhr, status, error) {
                console.error("Error in AJAX request:", error);
                console.error(xhr.responseText);
            }
        });
    }

    function displayTask(taskID)
    {
        $.ajax({
            type: "GET",
            url: `../index.php?controller=taskManagement&action=readFromID&id=${taskID}`,
            success: function(response) {
                $("#desc").html(
                    `<span class="mr-2">
                        <img src="https://icons.iconarchive.com/icons/emey87/trainee/48/Orb-info-icon.png" width="24" height="24">
                    </span>
                    <span>${response.task_type == 0 ? "(Reminder)" : "(Due)"}: ${response.task_description}</span>
                    `);
            },
            error: function(xhr, status, error) {
                console.error("Error in AJAX request:", xhr.responseText);
            }
        });
    }

    function editTask(taskID)
    {
        document.location.href = `index.php?page=taskForm&id=${taskID}&date=<?= $_SESSION["selected_calendar_date"] ?>`;
    }

    function deleteTask(taskID)
    {
        $.ajax({
            type: "POST",
            url: `../index.php?controller=taskManagement&action=delete`,
            data: JSON.stringify({task_id: taskID}),
            dataType: "json",
            success: function(response) {
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error("Error in AJAX request:", xhr.responseText);
            }
        });
    }

    function finishTask(taskID)
    {
        $.ajax({
            type: "POST",
            url: `../index.php?controller=taskManagement&action=updateFinish`,
            data: JSON.stringify({task_id: taskID}),
            dataType: "json",
            success: function(response) {
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error("Error in AJAX request:", xhr.responseText);
            }
        });
    }

    $(document).ready(initializeTasks);
</script>