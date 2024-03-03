<style>
    thead th {
        width: 130px;
    }
    tbody tr {
        height: 100px;
    }

    tbody tr td {
        vertical-align: top;
    }

    .valid-month-day:hover {
        cursor: pointer;
        background-color: lightgray;
    }
</style>
<!-- Calendar -->
<div>
    <h2 class="text-center px-4" id="year-name"></h2>
    <div class="row justify-content-center">
        <button class="btn h-25" onclick="changeMonth(-1)">&lt; prev</button>
        <h2 class="text-center mx-5" id="month-name"></h2>
        <button class="btn h-25" onclick="changeMonth(1)">next &gt;</button>
    </div>
    <table class="mt-2" border="1" align="center">
        <thead>
            <tr class="text-center">
                <th>Sunday</th>
                <th>Monday</th>
                <th>Tuesday</th>
                <th>Wednesday</th>
                <th>Thusday</th>
                <th>Friday</th>
                <th>Saturday</th>
            </tr>
        </thead>
        <tbody id="calendar-matrix">
            <tr>
                <td><div class="day-header text-right font-weight-bold pr-2"></div><div class="day-body"></div></td>
                <td><div class="day-header text-right font-weight-bold pr-2"></div><div class="day-body"></div></td>
                <td><div class="day-header text-right font-weight-bold pr-2"></div><div class="day-body"></div></td>
                <td><div class="day-header text-right font-weight-bold pr-2"></div><div class="day-body"></div></td>
                <td><div class="day-header text-right font-weight-bold pr-2"></div><div class="day-body"></div></td>
                <td><div class="day-header text-right font-weight-bold pr-2"></div><div class="day-body"></div></td>
                <td><div class="day-header text-right font-weight-bold pr-2"></div><div class="day-body"></div></td>
            </tr>
            <tr>
                <td><div class="day-header text-right font-weight-bold pr-2"></div><div class="day-body"></div></td>
                <td><div class="day-header text-right font-weight-bold pr-2"></div><div class="day-body"></div></td>
                <td><div class="day-header text-right font-weight-bold pr-2"></div><div class="day-body"></div></td>
                <td><div class="day-header text-right font-weight-bold pr-2"></div><div class="day-body"></div></td>
                <td><div class="day-header text-right font-weight-bold pr-2"></div><div class="day-body"></div></td>
                <td><div class="day-header text-right font-weight-bold pr-2"></div><div class="day-body"></div></td>
                <td><div class="day-header text-right font-weight-bold pr-2"></div><div class="day-body"></div></td>
            </tr>
            <tr>
                <td><div class="day-header text-right font-weight-bold pr-2"></div><div class="day-body"></div></td>
                <td><div class="day-header text-right font-weight-bold pr-2"></div><div class="day-body"></div></td>
                <td><div class="day-header text-right font-weight-bold pr-2"></div><div class="day-body"></div></td>
                <td><div class="day-header text-right font-weight-bold pr-2"></div><div class="day-body"></div></td>
                <td><div class="day-header text-right font-weight-bold pr-2"></div><div class="day-body"></div></td>
                <td><div class="day-header text-right font-weight-bold pr-2"></div><div class="day-body"></div></td>
                <td><div class="day-header text-right font-weight-bold pr-2"></div><div class="day-body"></div></td>
            </tr>
            <tr>
                <td><div class="day-header text-right font-weight-bold pr-2"></div><div class="day-body"></div></td>
                <td><div class="day-header text-right font-weight-bold pr-2"></div><div class="day-body"></div></td>
                <td><div class="day-header text-right font-weight-bold pr-2"></div><div class="day-body"></div></td>
                <td><div class="day-header text-right font-weight-bold pr-2"></div><div class="day-body"></div></td>
                <td><div class="day-header text-right font-weight-bold pr-2"></div><div class="day-body"></div></td>
                <td><div class="day-header text-right font-weight-bold pr-2"></div><div class="day-body"></div></td>
                <td><div class="day-header text-right font-weight-bold pr-2"></div><div class="day-body"></div></td>
            </tr>
            <tr>
                <td><div class="day-header text-right font-weight-bold pr-2"></div><div class="day-body"></div></td>
                <td><div class="day-header text-right font-weight-bold pr-2"></div><div class="day-body"></div></td>
                <td><div class="day-header text-right font-weight-bold pr-2"></div><div class="day-body"></div></td>
                <td><div class="day-header text-right font-weight-bold pr-2"></div><div class="day-body"></div></td>
                <td><div class="day-header text-right font-weight-bold pr-2"></div><div class="day-body"></div></td>
                <td><div class="day-header text-right font-weight-bold pr-2"></div><div class="day-body"></div></td>
                <td><div class="day-header text-right font-weight-bold pr-2"></div><div class="day-body"></div></td>
            </tr>
            <tr>
                <td><div class="day-header text-right font-weight-bold pr-2"></div><div class="day-body"></div></td>
                <td><div class="day-header text-right font-weight-bold pr-2"></div><div class="day-body"></div></td>
                <td><div class="day-header text-right font-weight-bold pr-2"></div><div class="day-body"></div></td>
                <td><div class="day-header text-right font-weight-bold pr-2"></div><div class="day-body"></div></td>
                <td><div class="day-header text-right font-weight-bold pr-2"></div><div class="day-body"></div></td>
                <td><div class="day-header text-right font-weight-bold pr-2"></div><div class="day-body"></div></td>
                <td><div class="day-header text-right font-weight-bold pr-2"></div><div class="day-body"></div></td>
            </tr>
        </tbody>
    </table>
    <div class="row justify-content-center mt-2">
        <form class="mr-1" action="index.php?page=report" method="post">
            <input type="submit" class="btn btn-secondary" value="View Report">
        </form>
        <form class="ml-1" action="index.php?page=taskForm" method="post">
            <input type="submit" class="btn btn-secondary" value="Create New Task">
        </form>
    </div>
</div>
<script>
    let monthStrings = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    let calendarBoxes = []; // holds calendar box objects for currently selected month.

    // a calendar box represented as a class.
    function Box(referenceBox, date)
    {
        this.referenceBox = referenceBox;
        this.date = date;

        // is invoked when this calendar box is selected.
        this.onSelect = () => {
            let formattedDate = `${this.date.getFullYear()}-${("0" + (this.date.getMonth() + 1)).slice(-2)}-${("0" + this.date.getDate()).slice(-2)}`;
            document.location.href = `index.php?page=taskView&date=${formattedDate}`;
        }
    }

    // direction: -1 = prev, 1 = next
    function changeMonth(direction)
    {
        let targetMonthNum = (((parseInt(sessionStorage.getItem("currentSelectedMonth")) + direction) % 12) + 12) % 12;
        sessionStorage.setItem("currentSelectedMonth", targetMonthNum);
        sessionStorage.setItem("currentSelectedMonthName", monthStrings[targetMonthNum]);
        initializeCalendar(targetMonthNum);
    }

    function initializeCalendar(monthNumber)
    {
        let date = new Date();
        let now = date;

        if (monthNumber != null)
        {
            date.setMonth(monthNumber);
            now = new Date();
        }
        
        // get first and last dates of the current month.
        let firstDateOfMonth = new Date(date.getFullYear(), date.getMonth(), 1);
        let lastDateOfMonth = new Date(date.getFullYear(), date.getMonth() + 1, 0);

        // clean calendar ---------------------

        let dayHeaders = document.querySelectorAll(".day-header");
        for (el of dayHeaders)
            el.innerHTML = ""

        let dayBodies = document.querySelectorAll(".day-body");
        for (el of dayBodies)
            el.innerHTML = ""

        let previousValidDays = document.querySelectorAll(".valid-month-day");
        for (el of previousValidDays)
        {
            el.removeAttribute("class");
            el.removeAttribute("style");
            el.removeAttribute("month-task-num");
        }

        while (calendarBoxes.length > 0)
        {
            let removedBox = calendarBoxes.shift();
            removedBox.referenceBox.removeEventListener("click", removedBox.onSelect);
        }

        // ------------------------------------

        let calendarMatrix = document.querySelector("#calendar-matrix").children;
        let dayAccumulator = 1;

        for (let week = 0; week < calendarMatrix.length && dayAccumulator <= lastDateOfMonth.getDate(); week++)
        {
            let weekDays = calendarMatrix[week].children;
            let startingWeekDay = (week == 0) ? firstDateOfMonth.getDay() : 0;
        
            for (let day = startingWeekDay; day < weekDays.length && dayAccumulator <= lastDateOfMonth.getDate(); day++)
            {
                // set the day header text to the month day
                weekDays[day].children[0].innerHTML = dayAccumulator;
                weekDays[day].setAttribute("class", "valid-month-day");

                let newBox = new Box(weekDays[day], new Date(`${date.getFullYear()}-${date.getMonth()+1}-${dayAccumulator}`));
                newBox.referenceBox.addEventListener("click", newBox.onSelect);
                newBox.referenceBox.setAttribute("month-task-num", 0);
                calendarBoxes.push(newBox);

                dayAccumulator++;
            }
        }

        $("#month-name").text(monthStrings[date.getMonth()]);
        $("#year-name").text(date.getFullYear());
        sessionStorage.setItem("currentSelectedMonth", date.getMonth());
        sessionStorage.setItem("currentSelectedMonthName", monthStrings[date.getMonth()]);

        let month = ("0" + (date.getMonth() + 1)).slice(-2);

        $.ajax({
            type: "GET",
            url: `../index.php?controller=taskManagement&action=readFromMonth&month=${month}`,
            dataType: "json",
            success: function(response) {
                for (task of response)
                {
                    let taskEndDate = new Date(task.ending_time);
                    for (box of calendarBoxes)
                    {
                        // find the calendar box that has this task.
                        if (box.date.getMonth() == taskEndDate.getMonth() && box.date.getDate() == taskEndDate.getDate())
                        {
                            if (task.status == 1)
                            {
                                // display task count per calendar box
                                box.referenceBox.setAttribute("month-task-num", parseInt(box.referenceBox.getAttribute("month-task-num")) + 1);
                                box.referenceBox.children[1].innerHTML = `tasks: ${box.referenceBox.getAttribute("month-task-num")}`;
                            }

                            // if task is in-progress
                            if (task.status == 1)
                            {
                                // set calendar box color based on days left until task end date.
                                let daysLeft = ((taskEndDate - now) / 1000) / 86400;

                                if (daysLeft > 4)
                                    box.referenceBox.style.backgroundColor = "lightgreen";

                                else if (daysLeft >= 1.5 && daysLeft <= 4)
                                    box.referenceBox.style.backgroundColor = "lightyellow";
                                
                                else if (daysLeft > 0 && daysLeft < 1.5)
                                    box.referenceBox.style.backgroundColor = "pink";

                                else if (daysLeft <= 0)
                                    box.referenceBox.style.backgroundColor = "red";
                            }
                        }
                    }   
                }
            },
            error: function(xhr, status, error) {
                console.error("Error in AJAX request:", error);
                alert("Error in AJAX request:\n" + error);
            }});
    }

    let savedMonth = sessionStorage.getItem("currentSelectedMonth");
    $(document).ready(() => initializeCalendar(savedMonth));

</script>