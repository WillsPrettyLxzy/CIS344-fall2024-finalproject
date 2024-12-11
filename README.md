# CIS344-fall2024-finalproject
Restaurant Reservation Management System - Platform Overview/REPORT
Platform Purpose
This system is designed to manage restaurant reservations, customer information, and associated details like reservations and cancellations. The platform allows restaurant staff to:

Add and view customers.
Manage reservations.
Cancel reservations.
Modify customer information.
Delete customers (with appropriate checks to handle dependencies like foreign key constraints).
Platform Structure
The platform consists of several PHP files that work together to provide the desired functionality. Below, we will break down each key file and explain its role in the platform:

1. restaurantDatabase.php (Database Handler)
Purpose:
This file contains the RestaurantDatabase class, which handles all database interactions for customers and reservations.

Key Functions:
connect(): Establishes a connection to the MySQL database using the provided credentials.
addReservation(): Adds a new reservation for a customer, saving details like reservation time, number of guests, and any special requests.
getAllReservations(): Retrieves all reservations from the reservations table.
addCustomer(): Adds a new customer to the customers table.
getAllCustomers(): Fetches all customers from the customers table.
getCustomerById(): Retrieves customer details by their unique customerId.
updateCustomer(): Updates a customer's details (name and contact information).
findReservations(): Finds all reservations associated with a specific customer.
cancelReservation(): Deletes a reservation from the reservations table.
deleteCustomer(): Deletes a customer, ensuring all related reservations are handled (this can be either manually or automatically based on foreign key constraints).
Key Considerations:
Foreign Key Constraints: The database has a foreign key on the customerId field in the reservations table, which prevents deleting customers with active reservations unless those reservations are first deleted or the foreign key is configured to cascade deletions automatically.
2. restaurantServer.php (Controller)
Purpose:
This file serves as the controller for the application. It acts as a bridge between the user interface (templates) and the database (via the RestaurantDatabase class).

Key Functions:
addCustomer(): Handles the POST request when adding a new customer. It accepts customer data, calls addCustomer() from the database class, and redirects the user to the customer list page.
addReservation(): Handles the reservation process by validating the customer's existence and ensuring that a customer must be added before a reservation can be made.
viewCustomers(): Retrieves a list of all customers and displays them in the viewCustomers.php page.
viewReservations(): Retrieves all reservations and displays them in viewReservations.php.
modifyReservation(): Allows users to modify the reservation details.
cancelReservation(): Allows users to cancel a reservation.
Key Considerations:
Controller Logic: This file holds the logic for routing user requests. It decides which functions to call based on the action (e.g., adding a customer, viewing customers, adding a reservation).
User Input Handling: It ensures that the correct data is passed to the database handler and handles error messages if inputs are invalid or missing.
3. home.php (Homepage Template)
Purpose:
This file is the homepage of the application. It provides the user interface for navigating to other pages like adding reservations or viewing customers.

Key Functions:
Navigation Links: Provides links for navigating to the pages where users can add a reservation, view reservations, or access other features of the restaurant management system.
Key Considerations:
Simple User Interface: A simple, user-friendly interface that allows restaurant staff to easily navigate through the available features.
4. addCustomer.php (Add Customer Form)
Purpose:
This file contains a form where users can enter customer details such as name and contact information.

Key Functions:
Form: The form accepts customer details and submits them to restaurantServer.php for processing.
Key Considerations:
POST Request: Submitting the form triggers a POST request to restaurantServer.php, where customer data is processed and added to the database.
5. viewCustomers.php (View Customers)
Purpose:
This file displays a list of all customers in the database.

Key Functions:
Displaying Customer Data: It queries the database for all customers and displays them in a table or list format.
Key Considerations:
Data Presentation: This page is used to show customer information, and it is often linked to other actions like deleting or modifying customer details.
6. cancelReservation.php (Cancel Reservation)
Purpose:
This file allows a user to cancel a reservation by providing the reservation ID.

Key Functions:
Handling Cancellation: It receives the reservationId as a parameter and calls the cancelReservation() function from the RestaurantDatabase class to delete the reservation.
Key Considerations:
Confirmation: It provides feedback to the user that the reservation was successfully canceled.
7. deleteCustomer.php (Delete Customer)
Purpose:
This file allows the deletion of a customer from the system.

Key Functions:
Handling Deletion: It receives the customerId as a parameter and calls the deleteCustomer() function from the RestaurantDatabase class to delete the customer.
Error Handling: It ensures the deletion process does not violate any foreign key constraints by either deleting related reservations first or checking for foreign key errors.
Key Considerations:
Database Integrity: The file checks the foreign key constraints before deleting the customer. If a customer has existing reservations, they must be deleted first (or an error is displayed).
8. viewReservations.php (View Reservations)
Purpose:
This file is used to view all existing reservations for customers.

Key Functions:
Display Reservations: It queries the database for all reservations and displays them.
Key Considerations:
Reservation Management: Users can view and manage all reservations, including modifying or canceling them.
9. config.php (Database Configuration)
Purpose:
This file stores the configuration settings for connecting to the database, including the database name, username, password, and host.

Key Considerations:
Separation of Concerns: Having a separate configuration file helps in maintaining cleaner code and allows easy updates to database credentials.
Platform Architecture
Database Design
The database is built using two main tables:

Customers: Stores customer details (customerId, customerName, contactInfo).
Reservations: Stores reservation details (reservationId, customerId, reservationTime, numberOfGuests, specialRequests).
Foreign Key Constraints
Foreign Key on customerId: The reservations table references the customerId from the customers table. This ensures data integrity, meaning that a reservation cannot exist without a valid customer.
MVC Architecture
The system follows a Model-View-Controller (MVC) architecture, where:

Model: The RestaurantDatabase.php file handles the database logic (data manipulation).
View: The HTML files (home.php, addCustomer.php, viewCustomers.php) are the user interface that displays data to the user.
Controller: The restaurantServer.php file acts as the controller, processing user inputs and interacting with the database.
Error Handling
The system provides error handling in cases like invalid input or foreign key constraint violations. For example, attempting to delete a customer with existing reservations is handled gracefully.

Conclusion
This platform is a robust solution for managing restaurant reservations and customer data. It allows users to add, modify, view, and delete customers and reservations, with appropriate checks for data integrity. The platform follows an MVC architecture, ensuring separation of concerns and maintainability. Additionally, the use of foreign key constraints ensures that related data remains consistent.

Problems Faced During Development
1. Database Setup Issues
Problem:

Initially, there were challenges with the database setup, including issues with creating tables, defining foreign key constraints, and ensuring the correct relationships between customers and reservations.
Solution:

The database schema had to be revised multiple times to ensure that:
Foreign key constraints were correctly implemented to link customers to their reservations.
The relationships between the customers table and reservations table were properly established to prevent errors when deleting or updating records.
Appropriate indexes were created to optimize query performance, especially for lookups based on customerId and reservationId.
Problem with Foreign Key Constraints:

When trying to delete a customer who had reservations, the system threw a foreign key constraint error, preventing the deletion of customers who had active reservations in the reservations table.
Solution:

Resolved by either deleting associated reservations first or implementing cascade deletes in the foreign key constraint, which ensures that related reservations are automatically deleted when a customer is deleted.
2. XAMPP Configuration Issues
Problem:

There were difficulties with configuring XAMPP, which serves as the local server and database management environment for the project.
Issues with PHP and MySQL Configuration:

Some PHP configurations, like max_execution_time and upload_max_filesize, had to be increased in php.ini to avoid timeouts when running lengthy SQL queries or when working with large datasets.
MySQL server kept stopping unexpectedly, possibly due to issues with permissions or port conflicts.
Solution:

Fixed by changing the port for MySQL in the XAMPP settings or using the XAMPP control panel to restart the MySQL server after it stopped unexpectedly.
Adjusted settings in the php.ini file to ensure proper performance during large data insertions or queries.
Ensured that the MySQL service was running correctly by using the XAMPP control panel and reviewing the logs for errors.
Port Conflicts:

Another issue encountered was port conflicts, especially if other software (like Skype or IIS) was running on the default port 80 or 3306.
Solution:

To resolve the port conflicts, changed the ports used by Apache and MySQL in the httpd.conf and my.ini configuration files, respectively, within the XAMPP installation.
3. Code Debugging and Error Handling
Problem:

Errors such as "undefined variable" or "missing parameter" occurred frequently when certain inputs (e.g., customerId or reservationId) were not provided or handled incorrectly in the PHP scripts.
Solution:

Introduced more robust error handling, using isset() or empty() checks to verify that parameters like customerId or reservationId were passed correctly in the URLs before processing them.
Added die() or exit() statements to stop execution if critical data was missing or if an error occurred.
Utilized try-catch blocks (in some cases) to handle potential exceptions, such as when database connections failed or queries didn’t execute properly.
4. Incorrect Data Insertion or Updates
Problem:

When adding new customers or reservations, the data didn’t always insert as expected, often due to missing or incorrect data fields (like customerId when adding reservations).
Solution:

Ensured that all required fields were correctly validated before inserting them into the database.
Added more comprehensive checks for empty fields before form submissions. Used bind_param() to ensure that the data types matched between the PHP code and MySQL.
Rewrote certain SQL statements to use INSERT IGNORE or ON DUPLICATE KEY UPDATE to prevent duplicate entries or errors from occurring when the same customer tried to add a reservation multiple times.
5. File and Directory Structure
Problem:

Initially, the file structure was unclear and messy, leading to issues with including the right files and correctly accessing the database.
Files were not well organized, and certain required files were being missed during inclusion, leading to errors such as "undefined function" or "class not found."
Solution:

Organized the files into distinct directories based on their function. For example:
templates/ directory for all the frontend (HTML and PHP view templates).
includes/ directory for backend logic and database interactions.
assets/ for any CSS, JS, or image files.
Used relative paths in require_once() statements to correctly include external files, ensuring that the project could function correctly regardless of the environment.
6. SQL Query Errors
Problem:

Queries like UPDATE and DELETE caused issues where the intended action wasn’t completed. This often happened due to incorrect parameter binding or SQL syntax issues.
Solution:

Ensured that SQL queries were written with proper syntax and that all variables were correctly sanitized before being passed to the database.
For example, when deleting a customer or a reservation, checked if the relevant customer or reservation ID existed before performing the delete operation to avoid unwanted data loss.
7. Handling of User Authentication and Authorization
Problem:

While the platform did not originally require user authentication, as the platform grew, there was a need to consider user roles (admin vs. staff) to restrict access to certain features.
Solution:

Introduced a simple session-based authentication system to control which users can perform certain actions (like deleting customers or modifying reservations).
Implemented role-based access control (RBAC) to ensure only authorized users could make critical changes.
8. UI/UX Issues
Problem:

The user interface was initially simple and didn’t have any proper form validation or feedback mechanisms. Users often submitted incomplete forms, which led to errors.
Solution:

Introduced form validation both on the client side (using JavaScript) and server side (using PHP). This helped ensure that all required fields were completed before the form was submitted.
Added feedback mechanisms to notify users if their actions were successful (e.g., "Customer Added Successfully") or if there were issues (e.g., "Customer already exists").
Conclusion
Challenges Overcome:
Database Setup: Solved the foreign key constraint issues by adjusting the database schema and ensuring data integrity with cascading delete operations.
XAMPP Configuration: Overcame server configuration challenges, such as port conflicts and database service issues, by adjusting settings in XAMPP’s control panel and configuration files.
Code Debugging: Addressed common issues like undefined variables and missing parameters by introducing more error checks and validating user inputs before processing them.
File Organization: Improved file structure, making it easier to navigate and maintain the project.
Future Improvements:
Security Enhancements: Introduce stronger security measures, like input sanitization, password protection (for user accounts), and protection against SQL injection.
Scalability: Plan for scaling the platform to handle larger numbers of reservations and customers by optimizing database queries and implementing caching where necessary.
UI/UX: Improve the frontend design by making it more user-friendly, possibly by integrating a frontend framework like Bootstrap or Vue.js for a more modern design.
Despite these challenges, the platform is now functional and ready for use in a local environment with minimal issues.