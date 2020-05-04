# info2-hf
The purpose of this project is passing a class, and practicing, nothing else!
All similarities to real life are coincidences.
I do not own any of the pictures used.

Technologies, and programs used:
* __HTML__ and __CSS__ to sty the pages, editor: __VSCode__.
* __PHP__ to write the server side scripteditor: __VSCode__.
* __MySQL__ to store the data, editor: __MySQL Workbench__.
* __XAMPP__ for Apachi, and the MySQL server.
* Parts of __Bootstrap 3__ for styling.

This project mimics a web-app that is able to store users data regarding games. There are players, games, items and teams.
Players can have games, and their played hours are stored. They can also own items, these have value. Players can be in multiple teams.

How to use:
* Check the first few lines of _functions.php_, and set the variables so the _mmyconnect()_ function connects to the MySQL server.
* Every other file is in its correct place, the paths in the php scripts are relative.
* Run the _createdb.sql_ script to set up the database.

Here is a complete list of the features in this application:
* A complete account system with login and registration. Some features are only visible/available when logged in.
* The three links in the header
  * Games: A list of all games available. Also here is the option to create a team.
  * Players: A searchable list of all the players.
  * Teams: A list of all the teams.  
* Player profiles
  * Games of the player as clickable links, displaying played hours.
  * List of teams (as links) the player is part of.
  * The player's items listed. 
  * When logged in: can offer his own items, or buy other's when looking at their profile.
  * When logged in: can edit and delete profile.
  * When logged in: display current balance, option to add more.
* Viewing a single game
  * Displaying the summary, rating and logo of the game.
  * When logged in: Option to add the game to profile.
* Viewing a team
  * List of team members
  * When logged in: Option to join, or if already member, leave team.
  * When the last player leaves the team, it ceases to exist





