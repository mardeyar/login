# Login / Signup Page: Mark Deyarmond
This project demonstrates a real life login and registration page complete with database integration, password hashing, unique username & email enforcement and efficient error handling.
## Prerequisites
Before getting started, be sure to:<BR>
1. Install [XAMMP](https://www.apachefriends.org/) to run MySQL and Apache.
2. Create the database with
```sql
CREATE DATABASE userdb;
```
This project uses the name **userdb** but you can use whatever name you like. Note that you will need to modify the code to suit your db naming conventions so for simplicity sake, use the **userdb** naming convention<br><br>
3. Create the table and insert the columns

```sql
CREATE TABLE accounts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) UNIQUE,
    email VARCHAR(255) UNIQUE,
    password_hash VARCHAR(255)
);
```
4. Ensure a proper connection configuration: typically these projects use something like this

```sql
$host = "localhost";
$dbname = "dbname";
$username = "root";
$password = "";
```
Suggested to follow this convention but your use case may differ. Adjust accordingly if needed.
## Getting Started
1. Clone the repository.
2. Configure the database connection in PHP files if needed.
3. Follow the setup instructions to create the database and tables.
4. Run the project using XAMPP.
## Demonstration
On the first visit, the user will be presented with the landing page prompting either a login or register response.<br><br>
![ScreenShot](https://github.com/mardeyar/login/blob/main/screenshots/1.png)<br><br>
## Registration
![ScreenShot](https://github.com/mardeyar/login/blob/main/screenshots/2.png)<br><br>
For successful registration, a few conditions will need to be met:<br>
1. All fields must be filled out
2. Username & email must be unique: no duplicates
3. Password must contain at least 1 character, 1 letter and be at least 8 characters long
4. Passwords must match<br>

Missing any one of these conditions will results in some of the following errors<br><br>
#### Fields not filled out
![ScreenShot](https://github.com/mardeyar/login/blob/main/screenshots/3.png)<br><br>
#### Duplicate email or username
![ScreenShot](https://github.com/mardeyar/login/blob/main/screenshots/4.png)<br><br>
#### Passwords don't match or don't meet security criteria
![ScreenShot](https://github.com/mardeyar/login/blob/main/screenshots/5.png)
![ScreenShot](https://github.com/mardeyar/login/blob/main/screenshots/6.png)<br><br>
Once you've met the required criteria, your account will be created and you will be prompted to log in<br><br>
![ScreenShot](https://github.com/mardeyar/login/blob/main/screenshots/7.png)
![ScreenShot](https://github.com/mardeyar/login/blob/main/screenshots/8.png)
## Login
For a successful login, you only need to enter valid credentials. Attempting to enter an invalid username or password combination will results in an error<br><br>
![ScreenShot](https://github.com/mardeyar/login/blob/main/screenshots/9.png)<br><br>
Once logged in, you will see a running table of current active users within the database. Displayed in this table is a list of UserID, Username and Email associated with current active users. Click logout to terminate the session and go back to the landing page<br><br>
![ScreenShot](https://github.com/mardeyar/login/blob/main/screenshots/10.png)<br><br>
**Note:** when attempting to visit index.php outside of a valid session, user will be automatically redirected to the landing page to prevent unauthorized access.
## License
This project is licensed under the MIT License. See the [MIT License](https://opensource.org/licenses/MIT) for details.
