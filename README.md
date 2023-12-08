# HL-BACK

This project is based on Laravel Framework and uses a number of auxiliary packages.

## Installation

Before you begin, make sure PHP 8.1 and Composer are installed. Then follow the steps below to install:

1. Clone the repository:
2. Navigate to the project directory:

```shell
cd path_to_project_directory
```
3. Install dependencies:
```shell
composer install
```
4. Start Sail:
```shell
sail up -d
```
5. Run migrations:
```shell
sail artisan migrate
```
6. Seed the database with initial data:
```shell
sail artisan db:seed
```
7. Run tests:
```shell
sail artisan test
```

### API Routes
API routes correspond to Houses Controller:
```php
GET|HEAD api/houses - use to get a list of houses
```

### Testing
Use the following command to run the PHPUnit test suite:

```shell
sail artisan test
```
