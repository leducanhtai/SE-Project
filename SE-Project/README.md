# SE-Project

## Overview
SE-Project is a web application that provides user authentication features, including login and logout functionalities. This project utilizes Laravel's built-in features for handling user sessions and database interactions.

## Features
- User registration and authentication
- Middleware for route protection
- API routes for user login and logout
- Factory and seeder for generating sample user data
- Comprehensive testing for authentication features

## Installation
1. Clone the repository:
   ```
   git clone https://github.com/yourusername/SE-Project.git
   ```
2. Navigate to the project directory:
   ```
   cd SE-Project
   ```
3. Install the dependencies:
   ```
   composer install
   ```
4. Set up your environment file:
   ```
   cp .env.example .env
   ```
5. Generate the application key:
   ```
   php artisan key:generate
   ```
6. Run the migrations to create the database tables:
   ```
   php artisan migrate
   ```
7. Seed the database with sample data:
   ```
   php artisan db:seed
   ```

## Usage
To start the application, run:
```
php artisan serve
```
You can access the application at `http://localhost:8000`.

## API Endpoints
- **Login**: `POST /api/login`
- **Logout**: `POST /api/logout`

## Testing
To run the tests, use:
```
php artisan test
```

## Contributing
Contributions are welcome! Please open an issue or submit a pull request for any improvements or bug fixes.

## License
This project is licensed under the MIT License.