
## intsallition
requirements: 
- Composer version 2.5.8,
- node v16.13.2,
- npm v8.1.2
- php 8.1.1
- XAMPP Version: 8.1.1



## How to start the project 
1: start Apache and MySql from your Xampp
2: go to localhost/phpmyadmin and create db name how you like and then import the database dump that is located in db folder
3. now go to .env file and change DB_DATABASE='' to the name that you named your database and use the .env.example 

4. Run composer install and  npm install and check that your inside WS2024_qualification-task folder
5. then you need to run npm run dev and php artisan serve
6. default head to: http://127.0.0.1:8000

