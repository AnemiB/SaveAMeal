# SaveAMeal
1. Problem Statement 

Many individuals and families in South Africa face financial challenges when it comes to food expenses, particularly with the rising cost of living in the current economic recession. Finding budget-friendly meals that are nutritious and satisfying can be difficult, and many turn to processed or unhealthy food options simply because they are more affordable. This issue affects not only low-income households but also students, single parents, and working professionals who need to save money but don't have time for meal planning. 

Moreover, many existing meal planning websites and apps do not focus on affordability, and the ones that do are often tailored to different currencies or regions. A South African-specific application that provides meals under R100 - R150 will help address this issue by offering easy, cost-effective meal solutions for individuals and families. 

Significance: By providing affordable, nutritious meal options ranging from single portion size to family portion size, this website aims to reduce the financial strain on households, helping users to buy affordable meals within their budget. The application will also enable users to share their own low-cost meals to buy, fostering a community-driven resource for others in similar situations. 

 http://ec2-13-60-184-172.eu-north-1.compute.amazonaws.com/


2. Target Audience 

The target audience for the budget meal website includes: 

Low-Income Families: Families who need to provide meals for multiple members while keeping costs low. 

Students: University or college students who need to budget their meals and often lack cooking experience. 

Single Parents: Individuals who need quick and easy meal solutions that won’t break the bank. 

Working Professionals: People who have limited time to plan and prepare meals but want to save money on food. 

Health-Conscious Individuals on a Budget: Users who want to maintain a healthy diet but need to stick to a limited budget. 

Benefits: This application will enable users to: 

Discover meal ideas with a clear indication of the cost per meal. 

View nutritional information like calories, making it easier to choose healthier options. 

Share their own affordable meals, allowing others to benefit from a growing library of low-cost meals to buy. 

 


3. Technology Stack 

The website will use the LAMP stack (Linux, Apache, MySQL, PHP), running on XAMPP for local development on a Windows PC. 

Justification for LAMP stack: 

The LAMP stack is well-suited for web applications that require a robust database system (MySQL) and dynamic web pages (PHP). It is widely used, stable, and highly scalable, which makes it perfect for building a meal website with CRUD (Create, Read, Update, Delete) functionality. 

PHP will be used to handle user authentication, display meal data dynamically, and process CRUD operations. 

MySQL is a relational database that will store all information about meals, users, comments, and other site data. 

Apache will serve the web pages and handle user requests, ensuring the site runs smoothly on the development environment. 

XAMPP provides an easy-to-install environment with all components pre-configured, making it simpler to manage and develop the application on a Windows PC. 

Component Overview: 

PHP: Used for server-side scripting to handle user interactions, display meals, and manage user sessions. 

MySQL: Stores user data, meals, comments, and other relevant site content. 

Apache: Hosts the application and processes web requests. 

Linux (XAMPP): Simulates the production server environment for local testing and development. 


 

4. Application Features 

User Authentication (Sign In/Sign Up Pages): 

Users can create an account or log in to their existing account. This ensures that only registered users can post meals and leave comments. 

Passwords will be securely hashed before storage in the database to protect user data. 

Home Page: 

The home page will display all meals in a grid format, including meal images, names, ingredients, and costs. 

Users can filter meals based on criteria like cost, preparation time, or calorie count, making it easy to find meals that fit their specific needs. 

Each meal will have a clickable link to its detailed meal page. 

Meal Page: 

When a user clicks on a meal, they are directed to the meal page that shows: 

The user who posted the meal. 

Name of the meal 

A photo of the meal. 

Ingredients, calories, preparation time, and instructions for cooking. 

Cost of the meal 

At the bottom of the page, users can view and post comments about the meal, offering feedback or additional tips. 

Create Meal Page: 

Registered users can create a new meal post by entering details like: 

Meal name. 

Total calories. 

Preparation time. 

Cooking instructions. 

Total cost. 

Upload a photo of the meal. 

This meal will then be posted on the home page for others to view. 

CRUD Operations: 

Create: Users can create meal posts, allowing them to sell their budget-friendly meals. 

Read: All users can view meal details on the home page and meal page. 

Update: Users can update their profiles 

Delete: Users can delete their own meal posts if needed, keeping the content relevant and up to date. 


 

5. Database Design 

The website will utilize a MySQL database to store user, meal, and comment information. 

Key Tables: 

users: 

Fields: user_id, username, email, password. 

Function: Stores information about registered users, including their login credentials and identification. 

meals: 

Fields: meal_id, user_id (foreign key), meal_name, ingredients, calories, prep_time, instructions, cost, meal_image. 

Function: Stores the details of each meal, including which user posted it. 

comments: 

Fields: comment_id, meal_id (foreign key), user_id (foreign key), comment_body. 

Function: Stores comments from users on different meal posts. 

Relationships: 

Each meal is associated with a user who created it, allowing for a connection between meals and their creators. 

Comments will be linked to both the meal and the user who posted the comment. 

Normalization Considerations: 

To avoid redundancy, the database will be normalized, ensuring that meal details are stored in the appropriate table and referenced using foreign keys. 

 


6. User Interface and Experience 

The website’s design will focus on being simple, intuitive, and user-friendly to accommodate users from different backgrounds, including those with little to no technical skills. 

UI Elements: 

Home Page: A visually appealing grid of meal cards, each showing a meal image, name, ingredients, and cost. Users can click on a meal to view more details. 

Navigation Bar: Easy access to the home page, sign-in page, and create meal page as well as a log-out button. 

Create Meal Page: Simple, clear input fields that make it easy for users to upload meals and enter all relevant details. 

User Experience (UX): 

The design will prioritize ease of use, ensuring that users can quickly find meals within their price range. 

The comment feature will encourage engagement, allowing users to discuss the meals, offer tips, and share feedback. 


 

7. Security Considerations 

Input Validation: All forms will have input validation to prevent malicious data from being entered. For example, when users post meals or leave comments, their inputs will be sanitized to prevent SQL injection or XSS attacks. 


 

Authentication and Authorization: 

Password Hashing: User passwords will be hashed using a secure algorithm before being stored in the database, ensuring that even in the event of a data breach, passwords remain protected. 

User Roles: Only registered users will be able to create and comment on meals. This will prevent anonymous users from posting or spamming the website. 

Session Management: Secure session management will be implemented to prevent session hijacking or unauthorized access to user accounts.
