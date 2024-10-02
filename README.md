# craftify-ssp
# Craftify Platform



**Craftify** is a digital platform that connects artisans and customers for handcrafted goods. The platform allows users to manage products, appointments, and profiles efficiently. Built with **Laravel** for the backend and **Jetstream** for user authentication, the system offers a sleek user experience with **TailwindCSS** for responsive design. 

## Table of Contents
- [Craftify Platform](#craftify-platform)
  - [Features](#features)
  - [Technologies Used](#technologies-used)
  - [Installation](#installation)
  - [Running the Application](#running-the-application)
  - [Environment Variables](#environment-variables)
  - [Images & Logos in README](#images--logos-in-readme)
  

  - [License](#license)
  
---

## Features
- **User Roles**: Customers, Artisans, and Admins, each with different functionalities.
- **Product Management**: Add, edit, and delete products (including images).
- **Artisan Profiles**: Custom profile pages with bio, skills, and social links.
- **Admin Dashboard**: Manage users, products, and view system statistics.
- **Responsive Design**: Built with TailwindCSS to ensure mobile-first design.

---


### CRM  system is built using 

<div>
<p><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300" alt="Laravel Logo"></a><br>


</p> 
</div>




- **Backend**: Laravel 11 (PHP 8.2)
- **Frontend**: Jetstream, Livewire, and Blade templates
- **CSS Framework**: TailwindCSS
- **Database**: MySQL
- **API Authentication**: Laravel Sanctum
- **Image Handling**: Laravel Storage for product and profile images
- **Token Management**: API token creation and revocation via Laravel
- **Version Control**: Git (GitHub)

---
## Installation

pre-requisites that are needed to run the project

-   [Composer](https://getcomposer.org/download/)
-   [Node.js](https://nodejs.org/en/download/)
-   [NPM](https://www.npmjs.com/get-npm)
-   [PHP](https://www.php.net/downloads.php)
-   Sqlite (or you can use )[MySQL](https://dev.mysql.com/downloads/installer/)

[ XAMPP ](https://www.apachefriends.org/download.html) or [WAMP server](https://www.wampserver.com/en/download-wampserver-64bits/) can be used for PHP and MySQL.


1.  Clone the repo

    ```sh
    git clone https://github.com/aaqilah-2/craftify-ssp.git
    ```
2.  Move in to the CRM folder

    ```sh
    cd crm
    ```  
3.  Composer Install

    ```sh
    composer install
    ``` 
4.  NPM Install

    ```sh
    npm install
    ```
5. Create a new .env file and copy the .env.example file and past it to the .env file

6. Create a database and add the database credentials to the .env file

If you are using sqlite use laravel docs and follow the instructions https://laravel.com/docs/10.x/database#sqlite-configuration

8.  Run the migrations

    ```sh
    php artisan migrate
    ```
9.  Run the seeders

    ```sh
    php artisan db:seed
    ```
10. Run the project

    ```sh
    npm run dev
    ```

    open a new terminal and run without closing the above code 

    ```sh
    php artisan serve
    ```



## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE.md) file for details.

---


