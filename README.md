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


### Screenshots

Login and signup screen
![image](https://github.com/JamieBurridge/4rums/assets/80159413/13b8f3c0-7e24-40d6-91fa-f33a67ea49a2)

Topics screen
![image](https://github.com/JamieBurridge/4rums/assets/80159413/da41fcae-3923-4e2d-9f44-6d6581b41786)

Posts from a topic
![image](https://github.com/JamieBurridge/4rums/assets/80159413/27efdcad-b5ea-4a79-9e2b-366df876983a)

Replies to post
![image](https://github.com/JamieBurridge/4rums/assets/80159413/5eb36c73-bdde-4696-ae0b-64188240b618)

