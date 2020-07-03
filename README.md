
# CRM Evaluation Project

This project is a demo of a basic CRM system involving companies and employees.
  

Deployed version: <a  href="http://crmeval.herokuapp.com/">App</a>

  

## Getting Started
  

### Prerequisites
The easiest way to run the application is by setting up <a  href="https://laravel.com/docs/7.x/homestead">Laravel Homestead</a> vagrant box.

If you decide not to use Homestead, you can run a project locally as a regular laravel app.  

For your comfort, the project has already been deployed and the link is included above.

This project requires a database. I used MariaDB, you are free to use any relational database. 
The list of environment variables is presented at the end of the page. 
#### Setup
As this project is a standard laravel app, you should have laravel installed on your pc. Setup your database and enter the properties into the .env. You can skip the mail configuration for now and for simplicity set file storage as local instead of s3. Run the migrations. Run the user seeder. Note that it is too early to run the employee seeder, as it uses random company id, but the companies are not there yet. Now you can start the app and test it. 

**Note:** For your comfort, this app was deployed on heroku, so you can skip the deployment if you wish. The link is in the first section of this page.
  

## Project Details

### Frontend
The project was  scaffolded using the laravel/ui package with default auth scaffolding. There is a template to perform every CRUD operation on Employees and Companies. These are standard blade templates. The templates heavily use bootstrap classes and layout.

### Database
There are two main entities stored in the database: Employees and Companies. They are related by a one-to-many relationship where Company hasMany(employees). It is worth mentioning that the default Users table exists, but as the registration routes are disabled, only seeded admin user is stored there. All tables are created by Migrations. 

Company fields:
 - name			
 - email
 - website
 - logo (filename)

Employee fields:
 - first_name			
 - last_name
 - email
 - phone_number
 - company_id (fk)
#### Factories and seeders
The company factory was not used, but the employee factory was used and modified. When creating an employee using the factory, he is assigned a random company from the existing ones. The seeder creates 150 employees. Be careful not to create employees before the companies.
#### Controllers

Besides the default controllers, CompanyController and EmployeeController are introduced. They are busy with basic CRUD operations. Both controllers apply "auth" middleware to their routes in constructor to prevent unauthorized access to the functionality.

#### Routes
The routes are defined in a single web.php file. 

#### Mail
The email messages are sent via Sendgrid API. With that purpose the companyCreated template was created. The emails are sent when a company gets created. The logic is written in the Company model class as an event handler. In the deployed version the email is sent on my personal email, which can easily be changed. The address is stored as an environment variable called `MAIL_REPORT_TO_ADDRESS`. 

**Note:** Sendgrid was used because the author did not want to enter his credit card in any more services. He already had the account on sendgrid.

#### Localization
The app is available on two languages: English and Russian. The localization was implemented in a default way for laravel. Route responsible for the switching writes the selected language in session. The Localization middleware class is responsible for changing the app locale, which it takes from session.

#### Image Storage
There are currently two storage types configured for this app: local storage and amazon s3. You can select what fits you in the `FILESYSTEM_DRIVER` environment variable. In case of heroku deployed version of the app, s3 is used. Note that if you use an s3 bucket, you should provide a security policy for it, so that you can access files that are stored in it. The list of environment variables that should be configured is given later on this page. In case of local storage, the files are available publicly via symlink. 

#### Testing
For demo purposes and considering the lack of time, only the Auth test cases were created. These tests check if any route is available without authentication. This seems as not required at all, however an unexperienced developer can easily break auth logic, without anyone knowing. Tests are run with `php artisan test` command. Note that the test db name differs from the dev db and data stored in test db is deleted after the test is done. 

#### Environment Variables
There is a list of variables that have to be configured in order for the application to function properly

    APP_NAME="Evaluation CRM"
    APP_URL=http://localhost
 
    #Database connection props
    DB_CONNECTION=mysql /*or the one you wish*/
    DB_HOST= /*hostname*/
    DB_PORT= /*port*/
    DB_DATABASE /*db name*/
    DB_DATABASE_TESTING= /*testing db name*/
    DB_USERNAME= /*username*/
    DB_PASSWORD= /*password*/
    
    
    #Mail props
    MAIL_MAILER=smtp
    MAIL_HOST=smtp.sendgrid.net /*or any other*/
    MAIL_PORT=587 /*or other*/
    MAIL_USERNAME=/*"apikey" for sendgrid, or other*/
    MAIL_PASSWORD=/*the api key for sendgrid or other*/
    MAIL_ENCRYPTION=tls /*for sendgrid and for others probably*/
    MAIL_FROM_ADDRESS=noreply@trvl.com /*FROM address of the mail*/
    MAIL_FROM_NAME="${APP_NAME}" /* name of the sender*/
    MAIL_REPORT_TO_ADDRESS=*/address to send the message*/
    
    SENDGRID_API_KEY= /*API Key generated for you by sendgrid*/
    
    #Storage settings
    FILESYSTEM_DRIVER= /*local or s3*/
    
    AWS_ACCESS_KEY_ID= /*Access key ID generated by AWS*/
    AWS_SECRET_ACCESS_KEY= /*Access key*/
    AWS_DEFAULT_REGION=/*Bucket Region*/
    AWS_BUCKET=/*Bucket Name*/
    
Other variables can be left by default.
## Built With

 
*  [Laravel](https://laravel.com/) - The web framework used

*  [Vue](https://vuejs.org/) - Frontend JS framework
* [Bootstrap](https://getbootstrap.com/) - Frontend toolkit
  

## Authors

*  **Asad Zeynalov**

## Acknowledgments

  
Thanks to thousands of stackoverflow users, whose answers were so useful when writing this app.

