# ICSproject
MIS-project: Building an Integrated Control System for Sewage Treatment(including COD prediction model)

Project Structure: </br>
Backend: php 8.2.0(Laravel 10 Framework with MVC architecture), Laravel Breeze Installation</br>
Frontend: Tailwind CSS + HTML + JavaScript, using Vite as building tool</br>
Database: MySql</br>
Package Manager: npm</br>
Dependency Manager: Composer

## Intialization
https://hackmd.io/@ONCE1989/SJ9EKloJ3

Note:
The PHP extension zip, sockets, and gd should be enabled(php.ini file in your server)

## How to start this project in your dev env after initailization...
    In command Line, run these three commands simultaneously: 
    1. php artisan serve -> to start your project in local server
    2. npm run dev -> build with vite
    3. php artisan short-schedule:run -> run the short schedule function
