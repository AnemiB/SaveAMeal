## <p align="center" style="text-decoration: none !important;padding:0;margin:0;">Anemi Breytenbach <br> 231178 <br> DV 200 Term 4</p>

<p align="center">
<img src="saveameal/images/logowhite.png" alt="Logo" width="100" height="100">
</p>

## Table of Contents

## <p align="center" style="text-decoration: none !important;padding:0;margin:0;">Anemi Breytenbach <br> 231178 <br> DV 200 Term 4</p>

<p align="center">
<img src="saveameal/images/logowhite.png" alt="Logo" width="100" height="100">
</p>

## Table of Contents

* [About the Project](#about-the-project)
  * [Live Website](#live-website)
  * [Mockup](#mockup)
  * [Project Description](#project-description)
  * [Problem Statement](#problem-statement)
  * [Target Audience](#target-audience)
  * [Significance](#significance)
  * [Built With](#built-with)
* [Getting Started](#getting-started)
  * [Prerequisites](#prerequisites)
  * [How to Install](#how-to-install)
* [Features and Functionality](#features-and-functionality)
* [Concept Process](#concept-process)
  * [Ideation](#ideation)
  * [Security Considerations](#security-considerations)
  * [Wireframes](#wireframes)
  * [User Interface and Experience](#user-interface-and-experience)
* [Development Process](#development-process)
  * [Implementation Process](#implementation-process)
  * [Highlights](#highlights)
  * [Challenges](#challenges)
* [Future Implementation](#future-implementation)
* [Final Outcome](#final-outcome)
  * [Demonstration Video](#demonstration-video)
* [Roadmap](#roadmap)
* [Conclusion](#conclusion)
* [Author](#author)
* [License](#license)
* [Contact](#contact)
* [Acknowledgements](#acknowledgements)


## About the project:
![Screenshot (12849)](https://github.com/user-attachments/assets/8b267148-dffb-42ca-b083-7fae57eeccea)

### Live Website
Visit the SaveAMeal website at: 
http://saveameal.co.za as well as
http://ec2-13-60-184-172.eu-north-1.compute.amazonaws.com/ 

### Mockup:
![iMac_Mockup_1](https://github.com/user-attachments/assets/f4439bd7-b710-43ef-a3d1-c6260e1b208d)

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

### Additional features include:
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

![Group 32](https://github.com/user-attachments/assets/8c392d66-93a9-4005-84ee-7392f3463c46)


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
https://drive.google.com/file/d/1LHhG1VKR-J69uwRLZ-xJdzQ-W5nwB0nI/view?usp=sharing

## Roadmap
ER Diagram
![saveameal drawio](https://github.com/user-attachments/assets/3f200578-1e2d-434e-9ded-270a7475191e)

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

