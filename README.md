# Work Order Management System

Web-based work order management system developed with PHP and MySQL.

## Features

- User authentication and session management
- Customer management
- Account executive management
- Work order registration and management
- Quotation management
- Work order editing and deletion
- Reports and data filtering
- PDF generation for work orders
- MySQL database integration

## Tech Stack

![PHP](https://img.shields.io/badge/PHP-777BB4?style=flat&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=flat&logo=mysql&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=flat&logo=javascript&logoColor=black)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=flat&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=flat&logo=css3&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-7952B3?style=flat&logo=bootstrap&logoColor=white)

## Project Structure

```text
BD/
├── CRUD operations
├── Authentication and validation
└── Database configuration

Fronted/
├── Customer management
├── Executive management
├── Quotations
├── Work orders
├── Reports
└── PDF generation

img/
jquery/
plugins/
popper/
codigo.js
index.html
index.php
```

## Local Setup

1. Install PHP, MySQL and a local development environment such as XAMPP.
2. Create a MySQL database named `bd_ordentrabajo`.
3. Configure the local database connection in `BD/config.php`.
4. Start Apache and MySQL.
5. Open the application through the local server.

> `BD/config.php` contains local database configuration and is excluded from version control. Use `BD/config.example.php` as a reference.

## Purpose

Academic software project developed to manage customers, quotations and work orders through a web-based application.
