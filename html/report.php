<style> 
    #piechart { 
        display: block; 
        width: 250px; 
        height: 150px; 
        border-radius: 50%; 
        box-shadow: 0px 10px;
        /* background: conic-gradient( 
            red 12deg, 
            orange 0deg 25deg, 
            yellow 0deg 240deg, 
            lightblue 0deg 270deg,
            #eaeaea 0deg 0deg
        ); */
    }
</style> 
<h2 class="text-center">Task Report</h2>
<div class="col">
    <!-- replace 'month' and 'username' with the session variable values 'month' and 'username'. -->
    <div class="row justify-content-center"><h5>Overall report for user <span><?= $_SESSION["loginName"] ?></span></h5></div>
    <div class="row justify-content-center">
        <div id="piechart" class="text-center"></div> 
    </div>
    <br>
    <div class="row align-items-center justify-content-center">
        <span id="total-tasks" style="font-weight:bold">0</span>
    </div>
    <div class="row align-items-center justify-content-center">
        <span class="mr-2" style="background-color: red; width: 15px; height: 15px;"></span>Completed Tasks:&nbsp;<span id="completed-percent">0%</span>
    </div>
    <div class="row align-items-center justify-content-center">
        <span class="mr-2" style="background-color: orange; width: 15px; height: 15px;"></span>Reminding Tasks In-progress:&nbsp;<span id="in-progress0-percent">0%</span>
    </div>
    <div class="row align-items-center justify-content-center">
        <span class="mr-2" style="background-color: lightgreen; width: 15px; height: 15px;"></span>Expiring Tasks In-progress:&nbsp;<span id="in-progress1-percent">0%</span>
    </div>
    <br>
    <div class="row justify-content-center">
        <form class="ml-1" action="index.php?page=calendar" method="post">
            <input type="submit" class="btn btn-secondary" value="Close Report">
        </form>
    </div>
</div>
<script>
    $(document).ready(function()
    {
        $.ajax({
            type: "GET",
            url: "../index.php?controller=taskManagement&action=readSummary",
            success: function(data) {
                console.log(data);

                $("#report-month").text(sessionStorage.getItem("currentSelectedMonthName"));

                let total = data[0].total;
                
                if (total == 0)
                    $("#piechart").html("Create some tasks to display your reports.");
                else
                {
                    // percentages
                    let done = data[1].done / total;
                    let inProgress = data[2].progress / total;
                    let inProgressReminding = data[3].progType0 / data[2].progress;
                    let inProgressExpiring = 1 - inProgressReminding;
                    
                    if (inProgress == 0)
                    {
                        inProgressReminding = 0;
                        inProgressExpiring = 0;
                    }
                        
                    // angles
                    let a = done * 360;
                    let b = a + (inProgressReminding * 360) / 2;
                    let c = (b + (360 - b)) / 2;

                    $("#piechart").css("background", `conic-gradient(red ${a}deg, orange 0deg ${b}deg, lightgreen 0deg ${c}deg)`);
                    $("#completed-percent").text((done * 100).toFixed(1) + "%");
                    $("#in-progress0-percent").text((inProgressReminding * 100).toFixed(1) + "%");
                    $("#in-progress1-percent").text((inProgressExpiring * 100).toFixed(1) + "%");
                    $("#total-tasks").text("Total tasks: " + total);
                }
            },
            error: function(xhr, status, error) {
                console.error("Error in AJAX request:", error);
                alert("Error in AJAX request:\n" + error);
            }
        });
    });
</script>