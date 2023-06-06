# 4rums

4rums is a forum in which users can discuss a variety of topics.

This project was made to practice PHP, SQL and Docker.

### Getting started

#### Run the project:

````
make run 
````

or 

````
docker-compose up -d --build
````

#### Stop the project 

````
make stop 
````

or 

````
docker-compose down
````

The project runs on:
 - localhost:80--> Website
 - localhost:8001 --> PhpMyAdmin

The database comes pre-loaded with a few users, topics, posts and replies.

### Project structure
- /pages --> All the pages
- /components --> HTML components
- /helpers --> Helper PHP functions
- /models --> Database models
