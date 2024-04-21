<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


# RESTful API with Laravel Eloquent

This project implements a RESTful API using Laravel's Eloquent ORM. It revolves around three main entities: students, teachers, and courses. The API includes robust validation mechanisms and returns responses in JSON format. 

## Features:

- **Validation:** Input data is validated using Laravel's built-in validation features to ensure data integrity and consistency.
- **JSON Responses:** All API responses are in JSON format, making them easily consumable by client applications.
- **Many-to-Many Relationship:** Students and courses have a many-to-many relationship, allowing a student to be enrolled in multiple courses and a course to have multiple students.
- **Pagination:** For endpoints that return lists of data, pagination is implemented to manage large datasets efficiently.
- **One-to-Many Relationship:** A one-to-many relationship exists between teachers and courses, enabling a teacher to have multiple courses while each course belongs to only one teacher.
- **User Authentication:** Laravel Sanctum is used for user authentication, ensuring that API endpoints are accessible only to authenticated users.

## Usage:

To use the API, ensure that you have set up Laravel and configured the necessary database connections. Then, authenticate users using Laravel Sanctum, and start making requests to the various API endpoints to interact with the student, teacher, and course resources.
