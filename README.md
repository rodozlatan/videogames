# Project Name
Videogames Single Page Application

## Description
Application to store and search videogames. Frontend created with bootstrap 5 and vanilla JS, backend created with Codeigniter 4 and with MySQL v5.

## Installation
1) Download the project folder and place it inside your server's web folder.
2) Inside the config folder there's a sql file with the database code, this schema should be created for the application to function correctly.
3) To modify the results per page for the pagination functionality, go to the file config.php located in the config folder inside the application.
 
 ```
 videogames\application\config\config.php
 ```
 Go to line 525 to find the following code:
 ```
 $config['rowperpage'] = 5;
 ```
 Finally change the number 5 to any integer greater than 0.

## Overall functionality
The project is made with a MVC structure, having one main view which is home.php, in that file all the front end of the single page application can be found.

 ```videogames\application\views\home.php```
 
Two controllers were used for this application, the main controller which loads the main view of the project, called Home.php, this controller routes the application to the view and renders it, it has only one default method for this purpose.
```videogames\application\controllers\Home.php```
	 
The other controller is the one that handles Ajax calls, since all database operations were handled by fetch calls. This one has basically two methods, one gets all the videogames and prepares them for the view, and the other method sets a videogame to store it into the database. In both information is received and prepared from the view to call the database models and return the data back to the view.
```videogames\application\controllers\Ajax.php```
 
Finally one model was used for the Videogame object, this is in the file Videogames_model.php, in here models are created from the database using information sent by the controller, the main methods are one to get videogames (read them from the database), another to set a videogame (store it into the database) and a couple more for the pagination to work.

```videogames\application\models\Videogames_model.php```
		
## Shortcomings of the project
1) Adding all CRUD operations would make it a lot more useful.
2) Run and write some tests to ensure functionality in different scenarios.
3) Using a component oriented front-end framework would make the application more reliable, scalable and with better state and lifecyle managemente of these components, for the sake of time and simplicity decided to use plain JS
4) Some JS functionalities used for this project (fetch, etc) are only compatible with modern browsers, therefore, if legacy functionality is needed, then another alternative would be a better solution.

## Scalability
1) Codeigniter is a framework for mid to small sized applications, if the application requires scaling I would definitely consider using something more  robust and reliable
2) A load balancer would be a better infrastructure for a web application that needs scaling, and having a separate mysql server or cluster is even better.
3) Views and stored procedures tend to be faster than queries, I would consider migrate data retrieving routines to the database when possible.
4) Caching and CDN for static assets would also make the application faster
5) Keep frameworks and web server updated it's also important when it comes down to performance

Thanks for your valuable time and consideration =)
