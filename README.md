# Skill Hub - Course Management System

## Project Overview

Skill Hub is a web-based management application designed to handle the administration of a course studio. It facilitates the management of students (Participants), training programs (Courses), and the enrollment process (Registration).

This project was developed as a competency demonstration for the Programmer Certification Scheme (Skema Sertifikasi Okupasi Pemrogram).

## Certification Requirements Met

This application satisfies the "Daftar Instruksi Terstruktur" (FR.IA.04A) requirements:

### 1. Participant Management (Manajemen Data Peserta)

- [x] **Create**: Register new participants.
- [x] **Read**: View list of all participants.
- [x] **Read Detail**: View specific profile & enrollment history.
- [x] **Update**: Edit participant details.
- [x] **Delete**: Remove participant from the system.

### 2. Course Management (Manajemen Data Kelas)

- [x] **Create**: Add new courses with schedules.
- [x] **Read**: View course catalog & enrollment counts.
- [x] **Read Detail**: View course specifics & student list.
- [x] **Update**: Edit course information.
- [x] **Delete**: Remove courses.

### 3. Registration Management (Manajemen Pendaftaran)

- [x] **Enroll**: Register a student to a class (Many-to-Many).
- [x] **View Class Roster**: Show all students in a specific class.
- [x] **View Student Schedule**: Show all classes for a specific student.
- [x] **Drop/Discharge**: Cancel a registration.

## Technical Stack

- **Framework**: Laravel 12 (PHP 8.4+)
- **Database**: MySQL / MariaDB
- **Frontend**: Blade Templates + Tailwind CSS (CDN)
- **Design Pattern**: MVC (Model-View-Controller)
- **Relationships**: Many-to-Many (participants <-> courses via course_participants)

## Installation & Setup Guide

Follow these steps to run the project locally for assessment:

### 1. Clone the Repository
```bash
git clone <your-repo-url>
cd skill-hub
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Database Setup

Create a database named `skill_hub` (or update `.env` to match your setup).

Run migrations and seeders (Generates 50 dummy students & 10 courses):
```bash
php artisan migrate:fresh --seed
```

### 5. Run the Application
```bash
php artisan serve
```

Access the app at: http://127.0.0.1:8000/participants

## Unit Testing (Pengujian Unit)

This project includes automated feature tests to verify the functionality of the Participant module (Requirement J.620100.033.02).

To run the tests:
```bash
php artisan test
```

Look for the "PASS" result in the terminal.

## 📂 Project Structure & Documentation

- **Controllers**: Located in `app/Http/Controllers`. Contains PHPDoc comments explaining business logic (Requirement J.620100.023.02).
- **Models**: Located in `app/Models`. Defines custom Primary Keys and Relationships.
- **Views**: Located in `resources/views`. Uses Blade Components (x-navbar) for modular design.
