# Framework
A simple framework starting place put together from Level-2 and good practices

Project Goals
----------
1. To provide a quick base framework to build a site off of
2. To use an easily configurable Module system

Principles to Follow
-----------------
Many of these are from @TomBZombie

1. Ensure that the MVC Models are not Domain Models
2. Use interfaces over inheritance
3. Keep things loosely coupled

Set Up for Use
-------------
1. Create a class called Config\\DatabaseSettings with public properties: localUsername, localPassword, onlineUsername, onlinePassword

Notes
----------------
This project uses Sass for stylesheets.

Troubleshooting
-------------------
## CSS not loading when online
If the page is issuing a 400 error then it is probably because a file in the framework list cannot be found
