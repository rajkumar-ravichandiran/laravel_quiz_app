## Laravel Quiz App - User Roles & CRUD

This repository contains a Laravel application that implements a quiz functionality with user roles and CRUD operations. The application allows users to register, login, participate in quizzes, and manage quiz data. It also includes user roles to control access and permissions within the system.

## Features

- User registration with email verification
- User roles and permissions
- Admin approval workflow
- CRUD operations for quizzes
- Basic APIs to get Quiz questions

## Email Verification and Approval

- Users who register will receive an email verification link to confirm their email address.
- After verifying their email, users will need to wait for admin approval.
- Admins will receive email notifications for new user registrations and can approve users through the admin dashboard.
- Approved users will receive an email notification confirming their account activation.


### Installation and Setup

1. Clone the repository to your local machine:
   ```bash
   git clone https://github.com/rajkumar-ravichandiran/laravel_quiz_app.git
   ```

2. Navigate to the project directory:
   ```bash
   cd laravel-quiz-app
   ```

3. Install the dependencies using Composer:
   ```bash
   composer install
   ```

4. Copy the `.env.example` file and rename it to `.env`. Update the database credentials in the `.env` file to match your environment.

5. Generate an application key:
   ```bash
   php artisan key:generate
   ```

6. Run the database migrations to create the necessary tables:
   ```bash
   php artisan migrate
   ```

7. (Optional) Seed the database with demo content and users:
   ```bash
   php artisan db:seed
   ```

### Usage

1. Start the local development server:
   ```bash
   php artisan serve
   ```

2. Access the application in your web browser at `http://localhost:8000`.

3. Register as a new user or use the demo user credentials if you seeded the database.

4. Explore the application features, such as creating quizzes, participating in quizzes, and managing quiz data.


### Contributing

Contributions to this project are welcome. If you have any suggestions, improvements, or bug fixes, feel free to open a pull request.

### Acknowledgments

This project was inspired by the need for a simple quiz application with user roles and CRUD functionality. Special thanks to the Laravel community and the contributors of various Laravel packages used in this project.

Happy quizzing!