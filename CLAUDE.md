# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a **Trading Journal application** built in vanilla PHP with MVC architecture. It's a complete rewrite of a Next.js application maintaining 100% feature parity. The application tracks trading entries with 17-field forms, performance analytics, and data management capabilities.

## Architecture

**MVC Structure:**
- **Models**: `src/Models/` - Database operations (Database.php singleton, TradingJournal.php for CRUD)
- **Views**: `src/Views/` - PHP templates with components system
- **Controllers**: `src/Controllers/` - Request handling (HomeController, ApiController)
- **Core**: `src/Core/` - Application bootstrap (App.php singleton, Router.php)

**Key Components:**
- **App.php**: Singleton application manager, handles environment/config loading
- **Router.php**: URL routing with RESTful API endpoints
- **Database.php**: MySQLi singleton with auto table creation
- **TradingJournal.php**: Main data model with CRUD operations

## Development Commands

**No build process required** - this is vanilla PHP with direct file editing.

**Local Development:**
```bash
# Start Apache/XAMPP/LAMPP server
# Access: http://localhost/trade-journal/public/
```

**Database Setup:**
- Automatic table creation on first API call
- Uses MySQLi with prepared statements
- Configuration in `.env` and `config/database.php`

## API Endpoints

RESTful JSON API at `/api/trading-journal`:
- `GET /api/trading-journal` - Fetch all entries
- `POST /api/trading-journal` - Create new entry  
- `PUT /api/trading-journal?id=X` - Update entry
- `DELETE /api/trading-journal?id=X` - Delete entry

## Database Schema

**Table: trading_journal_entries**
- Primary key: `id` (VARCHAR, generated: timestamp + random)
- Markets: ENUM('XAUUSD', 'EU', 'GU')
- Sessions: ENUM('LO', 'NY', 'AS') 
- Outcomes: ENUM('W', 'L', 'BE', 'C')
- Directions: ENUM('LONG', 'SHORT')
- JSON field for timeframes: `tf`
- Decimal fields: `entry_price`, `exit_price`, `pl_percent`, `rr`
- Text fields: `chart_htf`, `chart_ltf`, `comments`

## Configuration

**Environment Variables (.env):**
- Database connection (MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE)
- App settings (APP_ENV, APP_DEBUG, APP_URL)

**Config Files:**
- `config/app.php` - Application settings
- `config/database.php` - Database configuration

## File Structure

```
public/              # Web root
├── index.php        # Main entry point
├── .htaccess        # URL rewriting + security
├── api/trading-journal.php # API endpoint
└── assets/          # CSS/JS/images

src/
├── Core/            # Application framework
├── Controllers/     # Request handlers  
├── Models/          # Data layer
└── Views/           # Templates + components

config/              # Configuration files
includes/autoloader.php # Class autoloading
.env                 # Environment variables
```

## Key Features

- **Auto-save drafts**: Client-side persistence
- **Performance analytics**: Calculated from trade data
- **Color-coded UI**: Blue (basics), Green (performance), Purple (metrics), Orange (charts), Teal (comments)
- **Responsive design**: Bootstrap 5 with dark mode
- **Security**: Prepared statements, XSS headers, input sanitization

## Adding New Markets/Sessions

1. Update ENUM values in `src/Models/Database.php:initializeTable()`
2. Update form options in view components:
   - `src/Views/components/trading-form.php`
   - `src/Views/components/edit-form.php`

## Error Handling

- PHP errors logged via `error_log()`
- Database errors caught and logged
- Client-side validation + server-side sanitization
- JSON error responses from API endpoints

## Security Features

- Prepared statements prevent SQL injection
- Input sanitization and validation
- Security headers in `.htaccess`
- Environment variable configuration
- No direct file access (all routing through index.php)