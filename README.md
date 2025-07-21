# Taskly - Kanban Task Management System

Taskly is a modern, user-friendly Kanban task management application built with Laravel, Livewire, and Filament. It helps teams organize projects, track progress, and collaborate effectively in one centralized platform.

![Taskly](https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg)

## Features

- **User Authentication**: Secure login and registration system with profile management
- **Project Management**: Create, update, and organize multiple projects
- **Kanban Board**: Intuitive drag-and-drop interface for task management
- **Task Organization**: Group tasks into customizable boards (Todo, In Progress, Done)
- **Subtasks**: Break down complex tasks into manageable subtasks
- **User Dashboard**: Visual overview of project statistics and timelines
- **Responsive Design**: Works seamlessly across desktop and mobile devices

## Tech Stack

- **Laravel**: PHP framework for robust backend development
- **Livewire**: Full-stack framework for dynamic interfaces without writing JavaScript
- **Jetstream**: Authentication and team management scaffolding
- **Filament Kanban**: Package for implementing Kanban board functionality
- **Tailwind CSS**: Utility-first CSS framework for custom design

## Installation

Follow these steps to get Taskly up and running on your local machine:

### Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js and NPM
- MySQL or another database system

### Installation Steps

1. **Clone the repository**

```bash
git clone https://github.com/indromhars/taskly.git
cd taskly
```

2. **Install PHP dependencies**

```bash
composer install
```

3. **Install NPM dependencies**

```bash
npm install
```

4. **Set up environment variables**

```bash
cp .env.example .env
php artisan key:generate
```

5. **Configure your database**

Edit the `.env` file and set your database connection details:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=taskly
DB_USERNAME=root
DB_PASSWORD=
```

6. **Run migrations**

```bash
php artisan migrate
```

7. **Build assets**

```bash
npm run dev
```

8. **Start the development server**

```bash
php artisan serve
```

Your application should now be running at `http://localhost:8000`

## Usage

1. Register a new account or login with existing credentials
2. Create a new project from the dashboard
3. Add boards to your project (or use the default Todo, In Progress, Done)
4. Create tasks and organize them on your Kanban board
5. Add subtasks to break down complex work items
6. Drag and drop tasks between boards as their status changes

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
