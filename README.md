# **Proyecto  "Invoice App" **
#####  Author : David Ezequiel Grant.

Desarollo : 

Create the description of an invoice detailing each consumption of services of the last 15 days, and the corresponding calculation in each of them. Show the total cost of all consumption items.
The services are:
>   BackOffice service. Monthly cost is 7 USD.
    Storage service. Cost per unit is USD 0.03 per GB. The formula (cost * total units * billing period) is as follows
    Proxy service. Cost per minute is USD 0.03.
    Speech translation service. Cost per letter is USD 0.00003.    BackOffice service. Monthly cost is 7 USD.
    Storage service. Cost per unit is USD 0.03 per GB. The formula (cost * total units * billing period) is as follows
    Proxy service. Cost per minute is USD 0.03.
    Speech translation service. Cost per letter is USD 0.00003.

**Lenguajes y Frameworks utilizados**
*  Php : 8.2
*  Laravel : 11.0.7  
*  vue : 3.4.0

**Starter Kit : Laravel Breeze**


**Base de Datos **
    * PostgreSQL 


**Modelos   **
    - Consumption
    - Invoice
    - Service
    - User

**Endpoints de la aplicacion :**
    
 
  POST      _ignition/execute-solution ..................... ignition.executeSolution › Spatie\LaravelIgnition › ExecuteSolutionController  
  GET|HEAD  _ignition/health-check ................................. ignition.healthCheck › Spatie\LaravelIgnition › HealthCheckController  
  POST      _ignition/update-config .............................. ignition.updateConfig › Spatie\LaravelIgnition › UpdateConfigController  
  GET|HEAD  confirm-password .................................................. password.confirm › Auth\ConfirmablePasswordController@show  
  POST      confirm-password .................................................................... Auth\ConfirmablePasswordController@store  
  GET|HEAD  consumptions/{id} ................................................................. consumptions › ConsumptionController@index  
  POST      email/verification-notification ....................... verification.send › Auth\EmailVerificationNotificationController@store  
  GET|HEAD  forgot-password ................................................... password.request › Auth\PasswordResetLinkController@create  
  POST      forgot-password ...................................................... password.email › Auth\PasswordResetLinkController@store  
  POST      invoices ............................................................................................. InvoiceController@store  
  PATCH     invoices .......................................................................... invoices.update › InvoiceController@update  
  DELETE    invoices ......................................................................... invoices.delete › InvoiceController@destroy  
  GET|HEAD  invoices .................................................................................. invoices › InvoiceController@index  
  GET|HEAD  invoices/create .................................................................... invoicesCreate › InvoiceController@create  
  GET|HEAD  invoices/edit/{id} ..................................................................... invoicesEdit › InvoiceController@edit  
  GET|HEAD  login ..................................................................... login › Auth\AuthenticatedSessionController@create  
  POST      login .............................................................................. Auth\AuthenticatedSessionController@store  
  POST      logout .................................................................. logout › Auth\AuthenticatedSessionController@destroy  
  PUT       password .................................................................... password.update › Auth\PasswordController@update  
  GET|HEAD  profile ................................................................................ profile.edit › ProfileController@edit  
  PATCH     profile ............................................................................ profile.update › ProfileController@update  
  DELETE    profile .......................................................................... profile.destroy › ProfileController@destroy  
  GET|HEAD  register ..................................................................... register › Auth\RegisteredUserController@create  
  POST      register ................................................................................. Auth\RegisteredUserController@store  
  POST      reset-password ............................................................. password.store › Auth\NewPasswordController@store  
  GET|HEAD  reset-password/{token} .................................................... password.reset › Auth\NewPasswordController@create  
  GET|HEAD  sanctum/csrf-cookie ........................................ sanctum.csrf-cookie › Laravel\Sanctum › CsrfCookieController@show  
  POST      services ............................................................................................. ServiceController@store  
  PATCH     services .......................................................................... services.update › ServiceController@update  
  DELETE    services ......................................................................... services.delete › ServiceController@destroy  
  GET|HEAD  services .................................................................................. services › ServiceController@index  
  GET|HEAD  services/create .................................................................... servicesCreate › ServiceController@create  
  GET|HEAD  services/edit/{id} ..................................................................... servicesEdit › ServiceController@edit  
  GET|HEAD  up ...........................................................................................................................  
  GET|HEAD  verify-email .................................................... verification.notice › Auth\EmailVerificationPromptController  
  GET|HEAD  verify-email/{id}/{hash} .................................................... verification.verify › Auth\VerifyEmailController  


**Patrones de diseños utlizados **
* *MVC* 
* *Strategy*  


**Testing **

- PEST Version 2.0

- test/Feature/Auth/AuthenticationTest
- test/Feature/Auth/AuthenticationTest
- test/Feature/Auth/PasswordConfirmationTest
- test/Feature/Auth/PasswordResetTest
- test/Feature/Auth/PasswordUpdateTest
- test/Feature/Auth/RegistrationTest
- test/Feature/ProfileTest

** Seeder utilizados : **

  * Archivos de Seeder 
    - database/seeders/DatabaseSeeder.php
    - database/seeders/ServiceSeeder.php
    - database/seeders/InvoiceSeeder.php
    - database/seeders/ConsumptionSeeder.php

** * Factory Utilizados **
     - UserFactory




**  * Paso a Paso para deploy de la aplicacion **

    1 - Clonar el proyecto del repositorio Git
    2 - Crer el archivo .env y configurar el archivo :

        - APP_ENV= production        
        - DB_CONNECTION= pgsql
        -DB_HOST=
        -DB_PORT=5432
        -DB_DATABASE=invoices
        -DB_USERNAME=
        -DB_PASSWORD=

    3 - Comandos a Ejecutar por terminal 

         -  php artisan route:cache
         -  php artisan event:cache
         -  php artisan view:cache
         -  php artisan config:cache
         -  php artisan optimize
         -  php artisan migrate
         -  php artisan db:seed --class=DatabaseSeeder
         -  php artisan db:seed --class=ServiceSeeder
         -  php artisan db:seed --class=InvoiceSeeder
         -  php artisan db:seed --class=ConsumptionSeeder -- Agregar
         -  npm run build 
         -  npm run dev
         - (En Terminal Paralela) php artisan serve

    4 - Ingresar con usuario y contraseña 

        Usuario : admin@admin.com
        password : admin123



