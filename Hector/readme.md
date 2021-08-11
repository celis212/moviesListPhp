# Test Backend
This application has login and registration of users, manage an API of movies, it searchs the title of related movies on API,
you could search a specific movie when you downloaded the data from the api all data will be save in a local database
implemented in a raw JSON file 

Test was made with PHP, Bootstrap and using MVC structure.

It consists of:
- User Registration
- User Login
- About
- Movies (Show)

bootstrap.php file on app/views/bootstrap.php was use for require all libraries and confing file
not confuse this file with boootstrap library for css

## Supported Features

- Registration / Login capability
- Search movies on API by title
- Search movies on Database movies by title or date range
- Sort movies by title, date in order Ascendig/Descending 

### Prerequisites

* Apache Server
* PHP 5.6+

# Installation

Installation is very simple and requires to change information in 1 file: `app/config/config.php`

### Config File

Modify the app/config/config.php file according to your needs. You can use example.config.php file inside the same folder as an example based on my local settings.

## Database

The website requires only 2 tables: `users` and `movies` ubication app/database.

## Deployment Instructions

URLROOT needs to be defined to correctly display the front end.

[1] Open app/config/config.php in notepad

[2] Edit line 6 to point to project directory ('http://localhost/project').

[3] Star XAMMP -> Apache

[4] Start web application