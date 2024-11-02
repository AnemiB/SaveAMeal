## <p align="center" style="text-decoration: none !important;padding:0;margin:0;">Anemi Breytenbach <br> 231178 <br> DV 200 Term 4</p>

<p align="center">
<img src="saveameal/images/logowhite.png" alt="Logo" width="160" height="140">
</p>

## Table of Contents

* [About the Project](#about-the-project)
  * [Mockup](#mockup)
  * [Project description](#project-description)
  * [Built With](#built-with)
* [Getting Started](#getting-started)
  * [Prerequisites](#prerequisites)
  * [How to install](#how-to-install)
* [Features and Functionality](#features-and-functionality)
* [Concept Process](#concept-process)
   * [Ideation](#ideation)
   * [Wireframes](#wireframes)
* [Development Process](#development-process)
    * [Implementation](#implementation)
    * [Highlights](#highlights)
    * [Challenges](#challenges)
* [Future Implementation](#future-implementation)
* [Final Outcome](#final-outcome)
    * [Video Demonstration](#demonstration-video)
* [Conclusion](#conclusion)
* [Author](#author)
* [License](#license)
* [Contact](#contact)
* [Acknowledgements](#acknowledgements)

## About the project:
![Screenshot (12182)](https://github.com/user-attachments/assets/40ef7da5-a123-4abd-b6f3-649818357118)

Live Website
Visit the SaveAMeal website at: 
http://ec2-13-60-184-172.eu-north-1.compute.amazonaws.com/ and http://saveameal.co.za


### Mockup:
![MacBook_Dresser_Mockup_3_optimized_10](https://github.com/user-attachments/assets/69bee4e5-0e4c-462f-9f09-288306bf6622)


### Project description:
The SaveAMeal project is a budget-friendly platform designed to provide affordable and nutritious meal solutions for individuals and families facing financial constraints. It offers a community space for sharing cost-effective recipes, specifically targeting a South African audience.

### Problem statement
Economic challenges in South Africa leave many households struggling to afford nutritious meals. SaveAMeal provides meal options priced under R100 - R150, making it easier for low-income individuals and families to access healthy, affordable food. This resource aims to alleviate some of the financial and time pressures associated with meal preparation.

### Target Audience
SaveAMeal is designed for:

- Low-Income Families
- Students
- Single Parents
- Working Professionals
- Health-Conscious Individuals on a Budget

### Significance
SaveAMeal addresses the need for accessible, nutritious meal options in low-cost ranges. By promoting community sharing of budget-friendly recipes, it contributes to better food security and health outcomes for South African households.

### Built with:
- [PHP](https://www.php.net/)
- [MySQL](https://www.mysql.com/)
- [XAMPP](https://www.apachefriends.org/index.html)
- [JavaScript](https://developer.mozilla.org/en-US/docs/Web/JavaScript)

## Getting Started:
Follow the steps below to get a copy of the project running on your local machine.

### Prerequisites

- Download and install [XAMPP](https://www.apachefriends.org/index.html), which includes Apache, PHP, and MySQL.
- Make sure your system is running the latest version of PHP and MySQL.

### How to Install:
* Download the files
* Place the `saveameal` folder inside your XAMPP `htdocs` folder
* Create a database called `saveameal` and import the SQL file provided
* Start XAMPP Control Panel
* Start Apache and MySQL
* Enjoy the web application by navigating to `http://localhost/saveameal`

## Features and Functionality:
The web application consists of five main pages:

- **Sign Up and Log In Pages**: Handle user registration and authentication.
- **Main Feed**: Displays all available meals, including ingredients. Editing and deleting options are restricted to the user who created the meal.
- **Meal Page**: Displays the meal information, including ingredients, prep time, calories, and user comments as well as the creator of the meal, and a buy meal button.
- **Create Meal Page**: Allows users to post new meals with relevant information like calories, preparation time, and cost.
- **Profile Page**: Users can update their personal information, including username, email, and password.

# Additional features include:
- **Commenting**: Users can leave feedback on each meal to build a community atmosphere.
- **Liking**: Users can like any comment made.

Each page includes a navigational link to log out and return to the Log In screen.

## Concept Process:

### Ideation:
The initial concept was to develop a platform tailored to users who need low cost meals while emphasizing nutrition. 

### Security Considerations:
- **Input Validation**: Ensures protection against SQL injection and XSS attacks.
- **Authentication and Authorization**: Restricts meal creation and commenting to registered users.
- **Session Management**: Secure session handling to prevent unauthorized access.

### Wireframes:
Log In, Sign Up, Main Feed, Post Meal, Meal Details

![Group 32](https://github.com/user-attachments/assets/6780b456-0121-44d0-86cc-326802b58bb4)

### User Interface and Experience:
The UI is designed for simplicity and ease of navigation. Meal cards are displayed in a clean grid format, with intuitive forms for creating and editing meals, and a straightforward layout that enables users to navigate with ease.

## Development Process

### Implementation Process

- Implemented CRUD functionalities using PHP and MySQL.
- Styled the application using plain CSS and HTML.
- Integrated JavaScript for additional frontend functionality.

### Highlights:
Successfully implemented database relationships for meals and comments, enabling users to create, read, update, and delete entries. The platform's responsive layout and efficient database management were other high points.

### Challenges:
Challenges included managing relational database structures and debugging frontend issues related to user interactions. These obstacles were overcome through systematic troubleshooting and code refinement.

## Future Implementation:
- **Advanced Filtering**: Options to filter meals based on dietary restrictions or specific ingredients.
- **User Rating System**: A feature to rate meals, fostering user engagement.
- **Recipe Suggestions**: Personalized meal recommendations based on user preferences.

## Final Outcome

### Demonstration Video
https://drive.google.com/file/d/1rvC4l12_sevLojgkqTrCnqQIp6AJeyN8/view?usp=sharing

## Roadmap
ER Diagram
![history drawio (1)](https://github.com/user-attachments/assets/5b0e7393-fa9b-4f1d-92e4-d694542e4a3d)

## Conclusion
SaveAMeal has provided a rewarding learning experience, solidifying skills in PHP, MySQL, and database management. The project also highlighted the importance of user-centered design. Future expansions could include enhanced user interactions and additional features to meet community needs.

## Author

- **Anemi Breytenbach** - [AnemiB](https://github.com/AnemiB)

## License

Distributed under the MIT License.

## Contact

- **Anemi Breytenbach** - [231178@virtualwindow.co.za] 
- **Project Link** - [ https://github.com/AnemiB/SaveAMeal](https://github.com/AnemiB/SaveAMeal)

## Acknowledgements

- [XAMPP](https://www.apachefriends.org/index.html)
- [PHP](https://www.php.net/)
- [MySQL](https://www.mysql.com/)
- [JavaScript](https://developer.mozilla.org/en-US/docs/Web/JavaScript)

