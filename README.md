# Detikcom Payment Service
Detikcom payment service is a REST API service and CLI app that function to manage a transaction module inside payment service.

## Requirements

- PHP Version >= 8.2.3
- MySQL version >= 8.0.20

## How to use

1. Clone this repository to your local machine
    ```bash
   git clone https://github.com/rafiseptian90/detikcom_payment_service.git
   ```

2. Go to project location on your local machine
    ```bash
   cd path/to/detikcom_payment_service
   ```

3. Configure DB Connection
   After you was enter the project, please configure DB connection inside ***config/Connection.php***.
   ```php
   const DB_HOST = "127.0.0.1";

   const DB_PORT = 3030;

   const DB_USERNAME = "root";

   const DB_PASSWORD = "root";

   const DB_NAME = "detikcom_payment";
   ```
   Please overwrite the value above with your own connection setting.

4. Create a database
   Create a database manually inside you local machine and give the name should same with **DB_NAME** variable. So at this case, I will create a database called ***detikcom_payment***
   ![Create database](https://i.imgur.com/TCXUDEQ.png)

5. Run migration command
   If the database was created successfully, now you can back into the project and type
   ```php
   php database/migration.php
   ```
   It will run an exec command inside **database/migration.php** file to  create a transactions table inside that new database and add one dummy record.



6. Run the application
   Write this command at your terminal to make the application run
   ```php
   php -S localhost:7000
   ```
Now this project is ready to use.

## How to test

1. Please import postman collection inside **misc** folder to your local postman tools
2. After the collection was successfully imported, you can change variable that hold the application endpoint in the variable setting inside this collection. Please make sure this endpoint is same with the application running port on your local machine. In this case I will set the port to **7000** because I was run the application in **step 6** at port **7000** too.
   ![Postman Setup](https://i.imgur.com/WIVUkv7.png)

Now all setup has been finished, please make a contact with me if there is a problem with the application.

**Best Regards,
Rafi Septian Hadi**