# **Timetables**
A web-based schedule builder for creating, modifying, updating and deleting your everyday activities.

## Synopsis
Keeping track of your everyday activites becomes hefty especially having to memorize current and upcoming activities. Organization becomes an attractive
choice for managing many activities.

Timetables was created to help with managing activites on all levels. Although it offers the most basic functionality for schedule management, it is sufficient
enough for anyone to use within their means.

## Getting Started
To get started, log into your Odin account and navigate to the `public_html` directory. If such directory does not exist, make one using this command: `mkdir public_html`. Navigate
into the directory.<br>

Once inside the `public_html` folder, download the latest release using this command:<br>

`git clone "https://github.com/hectorm22/Timetables.git" Timetables`. This will create a directory containing the release. Do not navigate into the `Timetables` directory yet.<br>

The application needs read and write permissions for error logging and database querying purposes. To change its permissions, execute these commands in order:<br>
1. `chmod o+rw ..\public_html`<br>
2. `chmod -R o+rw Timetables`<br>

Then, navigate into the `Timetables` directory.

The application has now been setup and ready to be used. In a web browser, visit your CSUB Odin account URL:<br>

`cs.csub.edu/~<username>/Timetables`<br>

Replace `<username>` with your Odin username and hit enter. Create a new user and use those credentials to log into the service.<br><br>

## Managing Timetables
Timetables utilizes a simple form of the Model-View-Controller (MVC) architecture. An sqlite3-based database us used for data management.<br>
On install, Timetables will come with a pre-primed database file called `lab05.db`, as well as an `errors.txt` file that the application writes to should there be 
any server-side errors. In addition, there is a `setup.sql` file used for resetting the database back to its factory state, and a binary copy of the sqlite3 program
for easy database access.

### error logging
Timetables logs any server-side errors to the `errors.txt` file. If permissions were correctly granted at the [setup process](README.md#getting-started), Timetables should maintain
write access to this file for error logging. This file must not be touched unless all of its logs need to be erased.

### sqlite3 and database
To manually access the database run the sqlite3 program by executing `./sqlite`, then running `.open lab05.db`. To work with sqlite3, read its documentation [here](https://www.sqlite.org/cli.html).<br>
If you need to manually reset the database, execute `./sqlite3`, run `.read setup.sql`, then finally run `.quit`.<br><br>

## Frequently Asked Questions (FAQ)
### Q: Why does this application feel janky, sub-par, minimalistic, bland, barrel-scraping and seems doomed to failure?
**A: Because it was considered a "mini project" that was written within a limited time frame. Expect some unorthodox behavior.**<br><br>

### Q: Timetables is thowing around errors, but I cannot see them in the log file!
**A: You need to setup the proper permissions to allow read and write access to the `errors.txt` file. Refer to [this](README.md#getting-started) section.**<br><br>

## Contributors
Fang Lin and Hector Martinez
