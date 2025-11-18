# FleetFlow – Fleet, Rentals & Driver Management System

A complete Laravel-based fleet management platform for transport operators in Africa.

## Description

Transport operators in Africa often struggle because they do not have a single digital system to manage vehicles, drivers, and finances. This project provides an integrated platform that centralizes fleet tracking, driver performance monitoring, and financial management. By digitizing processes such as maintenance scheduling, income and expense tracking, and "work-and-pay" contract management, the system eliminates inefficiencies caused by manual or fragmented workflows. It helps vehicle owners clearly monitor driver activity, predict payment completion for work-and-pay agreements, and determine whether their operations are financially sustainable.

## Technologies Used

- Laravel 12
- PHP 8.2
- MySQL
- Tailwind CSS

## Database Design

### Tables and Relationships

**1. Users** - Stores all system users, including admins, drivers, mechanics, and customers
- Primary Key: id
- Relationships: 
  - Linked to drivers (via user_id)
  - Linked to mechanics (via user_id)
  - Linked to customers indirectly through roles

**2. Vehicles** - Holds information about all vehicles in the fleet.
- Primary Key: id
- Relationships:
  - Linked to drivers (vehicles.id → drivers.vehicle_id)
  - Linked to rentals (vehicles.id → rentals.vehicle_id)
  - Linked to maintenances (vehicles.id → maintenances.vehicle_id)
  - Linked to expenses (vehicles.id → expenses.vehicle_id)
  - Linked to work_and_pay_contracts (vehicles.id → work_and_pay_contracts.vehicle_id)

**3. Drivers** - Represents drivers in the system.
- Primary Key: id
- Relationships:
  - Belongs to a user (drivers.user_id)
  - Assigned to a vehicle (drivers.vehicle_id)
  - Linked to payments (drivers.id → payments.driver_id)
  - Linked to work_and_pay_contracts (drivers.id → work_and_pay_contracts.driver_id)

**4. Customers** - Contains customer details for vehicle rentals.
- Primary Key: id
- Relationships:
  - Linked to rentals (customers.id → rentals.customer_id)

**5. Rentals** - Stores all vehicle rental transactions.
- Primary Key: id
- Relationships:
  - Belongs to a customer
  - Assigned a vehicle
  - Linked to payments (rentals.id → payments.rental_id)

**6. Payments** - Tracks financial payments from drivers under both rentals and work-and-pay contracts.
- Primary Key: id
- Relationships:
  - Linked to a driver
  - Optionally linked to a rental
- Supports two payment types:
  - rental
  - contract

**7. Work and Pay Contracts** - Manages work-and-pay agreements where drivers pay toward vehicle ownership.
- Primary Key: id
- Relationships:
  - Belongs to a driver
  - Linked to a vehicle

**8. Maintenances** - Stores vehicle maintenance records.
- Primary Key: id
- Relationships:
  - Linked to vehicles
  - Linked to mechanics
  - Linked to expenses (each maintenance can generate partner expenses)

**9. Mechanics** - Stores mechanic details.
- Primary Key: id
- Relationships:
  - Linked to users
  - Linked to maintenances via mechanic_id

**10. Expenses** - Tracks all expenses related to vehicles or maintenance activities.
- Primary Key: id
- Relationships:
  - Linked to vehicles
  - Linked to maintenances

### ERD Diagram

![fleetflow-erd](/public/assets/fleetflow-erd.png "Fleetflow ERD")

## Features

FleetFlow is a complete Fleet Management System built with Laravel, allowing transport companies to manage:

- **Vehicle Management** - Add/edit/delete vehicles with status tracking (available, maintenance, rented, sales, contract)
- **Driver Management** - Profile management, contact info, vehicle assignment with scheme types (sales_only, work_and_pay, mixed)
- **Work & Pay Contracts** - Create contracts with weekly payments, track progress with balance and progress bars
- **Rentals** - Customer and vehicle rental management with duration, cost, and status tracking
- **Payments System** - Three payment types: rental (customer), contract (driver), sales (driver)
- **Maintenance** - Mechanics management, cost tracking, and vehicle condition monitoring
- **Expenses** - Track repairs, fuel, and operating costs
- **Reports Dashboard** - Comprehensive analytics including rental revenue, Work & Pay revenue, sales revenue, expenses summary, net profit, and recent payments

## Setup Instructions

```bash
git clone https://github.com/2025-Fall-ITE-5330-RNA/project-phases-team-1.git
cd project-phases-team-1
npm install
npm run dev
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
