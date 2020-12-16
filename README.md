# dtc477-major-project
WSU Fall 2020 final project: Inventory System

Music Manager
By: Spencer Echon

Link to project:
https://spencerechon.me/repositories/dtc477-major-project/index.php

What do you want to make?

A music library web application that will have the ability to manage a database of songs. 

What features do you want this to have? What features must it have for the first (or next) version?

Main Features:
Store new songs
Delete songs
Edit songs
List all songs
Rate songs
Search songs
Link to music video

Possible Features:
Sort alphabetically
Play music video (using YouTube API)
Playlist creation
User login

What visual design resources do you need to begin?

Bootstrap for UI
Google Fonts

What type of coding will you use to implement this? 

Write a table or bulleted list of the pages or files you expect to create (HTML, CSS, JS, PHP), and identifying what each file does. 

index.php
Home page - Display all songs in the music library
styles.css
Main file for design of webpage
database.php
Contains MySQL connection credentials
functions.php
File where commonly used functions will be stored
add-song.php
Separate page(or popup) that gives the option to add songs in music library, adapted from unit 3 database example
edit-song.php
Separate page(or popup) that gives the option to edit songs in music library, adapted from unit 3 database example


What are your database columns?

Music Library
SongID - int - auto-increment
Name - varchar(100) - Name of song
Artist - varchar(100) - Name of artist
Album - varchar(100) - Name of album
Rating - int - 1 to 5
Music Video - varchar(100) - YouTube link


-git add .
-git commit -am "message"
-git push
