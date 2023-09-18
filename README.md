# AI污邊界(original project name: ICSproject)
MIS-project: Building an Integrated Control System for Sewage Treatment(including COD prediction model)

### **Currently hosting on Hostinger's Virtual Private Server**</br> website URL: http://ncumis-ics.com/

## Project Structure: </br>
Backend: php 8.2.0(Laravel 10 Framework with MVC architecture), Laravel Breeze Installation</br>
Frontend: Tailwind CSS + HTML + JavaScript, using Vite as building tool</br>
Database: MySql</br>
Package Manager: npm</br>
Dependency Manager: Composer

## Intialization
https://hackmd.io/@1989ONCE/SJ9EKloJ3

Note:
The PHP extension zip, sockets, and gd should be enabled(php.ini file in your server)</br>
We don't provide our predicting model, however you can define your own model function and create a new model type on your own easily~

## How to start this project in your dev env after initailization...
    In command Line, run these three commands simultaneously: 
    1. php artisan serve -> to start your project in local server
    2. npm run dev -> build with vite
    3. php artisan short-schedule:run -> run the short schedule function
    4. php artisan schedule:run -> run task schedule function
