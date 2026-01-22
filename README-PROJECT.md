# Country Village Hotel - Booking System

A complete hotel booking system built with Laravel 12 and MySQL for local testing. This system allows guests to search for available rooms, make bookings, and provides a comprehensive admin dashboard for managing rooms, bookings, and availability.

## Features

### Guest Booking System
- **Date-based Room Search**: Select check-in and check-out dates to view available rooms
- **Room Listings**: Browse all available rooms with pricing, capacity, and descriptions
- **Room Details**: View detailed information about each room including images
- **Secure Booking**: Submit booking requests with guest information (name, phone, email)
- **Booking Confirmation**: Receive instant confirmation with booking details
- **Double Booking Prevention**: Automatic date overlap validation ensures no conflicts

### Admin Dashboard
- **Dashboard Overview**: View statistics (total rooms, available rooms, total bookings)
- **Room Management**: Full CRUD operations for rooms
  - Add new rooms with details (name, description, price, capacity, status)
  - Edit existing room information
  - Delete rooms
  - Upload and manage multiple images per room
- **Booking Management**: 
  - View all bookings with filtering
  - Update booking status (confirmed, cancelled, completed)
  - View detailed booking information
- **Real-time Availability**: Automatic room availability tracking

## Technical Stack

- **Framework**: Laravel 12
- **Database**: MySQL (SQLite for local development)
- **Frontend**: Blade templates with Tailwind CSS
- **PHP Version**: 8.3+
- **Dependencies**: See composer.json

## Installation

### Prerequisites
- PHP 8.3 or higher
- Composer
- MySQL (or use SQLite for local testing)
- Git

### Setup Instructions

1. **Clone the repository**
   ```bash
   git clone https://github.com/enifuels-cell/Country-village.git
   cd Country-village
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Configure environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure database**
   - For SQLite (default - no configuration needed)
   - For MySQL: Update `.env` file with your database credentials
     ```
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=hotel_booking
     DB_USERNAME=root
     DB_PASSWORD=your_password
     ```

5. **Run migrations**
   ```bash
   php artisan migrate
   ```

6. **Seed sample data** (optional)
   ```bash
   php artisan db:seed --class=RoomSeeder
   ```

7. **Create storage symlink**
   ```bash
   php artisan storage:link
   ```

8. **Start development server**
   ```bash
   php artisan serve
   ```

9. **Access the application**
   - Guest Booking: http://localhost:8000
   - Admin Dashboard: http://localhost:8000/admin/dashboard

## Usage

### Guest Booking Flow
1. Visit the home page
2. Select check-in and check-out dates
3. Click "Check Availability" to view available rooms
4. Browse available rooms and click "Book Now" on your preferred room
5. Fill in guest details (name, phone, email)
6. Submit the booking
7. View confirmation page with booking details

### Admin Panel
1. Navigate to `/admin/dashboard`
2. **Dashboard**: View statistics and recent bookings
3. **Rooms**: 
   - Click "Add New Room" to create a room
   - Click "View" to see room details and bookings
   - Upload images for rooms
4. **Bookings**: 
   - View all bookings
   - Update booking status
   - View detailed booking information

## Double Booking Prevention

The system implements a robust date overlap detection algorithm:

```php
// Overlap exists if: (new_start < existing_end) AND (new_end > existing_start)
$hasOverlap = Booking::where('room_id', $roomId)
    ->where('status', '!=', 'cancelled')
    ->overlapping($checkInDate, $checkOutDate)
    ->exists();
```

This ensures that:
- No two active bookings can exist for the same room with overlapping dates
- Cancelled bookings don't block availability
- Real-time validation during booking submission

## Database Schema

### Rooms Table
- id, name, description, price, capacity, status, timestamps

### Room Images Table
- id, room_id (FK), image_path, timestamps

### Bookings Table
- id, room_id (FK), guest_name, guest_phone, guest_email, check_in_date, check_out_date, status, timestamps

## Security Features

- CSRF protection on all forms
- SQL injection prevention through Eloquent ORM
- Input validation on all user inputs
- File upload validation for images
- XSS protection through Blade templating

## License

This project is open-source software.
