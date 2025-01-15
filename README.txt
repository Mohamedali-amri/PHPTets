Heyy !!

I hope you are doing well.
Below is a detailed explanation of the project I developed to meet your requirements.

1. Database
I created the reservations table in the database using the following SQL command:

sql
Copier le code
CREATE TABLE reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    participation_id INT NOT NULL,
    employee_name VARCHAR(255),
    employee_mail VARCHAR(255),
    event_id INT,
    event_name VARCHAR(255),
    participation_fee DECIMAL(10, 2),
    event_date DATETIME,
    version VARCHAR(10)
);

2. Project Structure
The project is organized as follows:

CSS folder: Contains the style.css file with custom styles.
JS folder: Contains the script.js file with all the JavaScript functions used in the project.

3. Main Features
The main file of the project is index.php, which uses Bootstrap 5 for the frontend layout. 
This file also calls filter_display.php, which includes:

Form for uploading JSON file: The upload_json.php file manages the upload and insertion of JSON data into the database. 
If a file has already been uploaded, a script checks if new data needs to be added.
Dynamic search form: This form allows real-time searching as letters are typed. 
A Reset button is available to quickly clear the fields, using AJAX and the ajax_filter.php file.

4. Calculating the Participation Fees Total
An additional feature calculates the total of the Participation Fee values. 
A JavaScript function retrieves the Participation Fee values from the table 
 and sums them up in real-time. The result is displayed to show the total fees.

Conclusion
Thank you for taking the time to review my work. 
Please feel free to contact me if you have any questions or need further clarification. 
I am happy to discuss the project in more detail.


