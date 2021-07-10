# Project Name
Videogames Single Page Application

## Description
Application to store and search videogames. Frontend created with bootstrap 5 and vanilla JS, backend created with Codeigniter 4 and with MySQL v5.

## Installation
1) Download the project folder and place it inside your server's web folder.
2) Inside the config folder there's a sql file with the database code, this schema should be created for the application to function correctly.

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
