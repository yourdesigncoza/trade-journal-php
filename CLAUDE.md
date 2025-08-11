# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a **Trading Journal application** built in vanilla PHP with MVC architecture. It's a complete rewrite of a Next.js application maintaining 100% feature parity. The application tracks trading entries with 17-field forms, performance analytics, and data management capabilities.

## Architecture

**MVC Structure:**
- **Models**: `src/Models/` - Database operations (Database.php singleton, TradingJournal.php for CRUD)
- **Views**: `src/Views/` - PHP templates with reusable components system
- **Controllers**: `src/Controllers/` - Request handling (HomeController, ApiController)
- **Core**: `src/Core/` - Application bootstrap (App.php singleton, Router.php)

**Key Architecture Components:**
- **App.php**: Singleton application manager that loads `.env` variables and config files automatically
- **Router.php**: Complex URL routing system handling both web pages and API endpoints with subdirectory support
- **Database.php**: MySQLi singleton with automatic table creation and schema management
- **TradingJournal.php**: Main data model with comprehensive CRUD operations and data validation
- **Client-side**: jQuery-based SPA with auto-save, local storage, and Bootstrap 5 UI

**Request Flow:**
1. All requests go through `public/index.php` or `public/api/trading-journal.php`
2. `.htaccess` handles URL rewriting for clean URLs and API routing
3. Router dispatches to appropriate Controllers based on HTTP method and URI
4. Controllers interact with Models for data operations
5. Views render HTML responses with component inclusion system

## Development Commands

**No build process required** - this is vanilla PHP with direct file editing.

**Local Development:**
```bash
# Start Apache/XAMPP/LAMPP server
sudo /opt/lampp/lampp start  # For LAMPP users
# Access: http://localhost/trade-journal/public/
# Or for subdirectory installations: http://localhost/subdirectory/trade-journal/public/
```

**Testing & Debugging:**
- No formal test framework - testing is done through browser and API endpoints
- Debug mode controlled via `.env` file (APP_DEBUG=true)
- PHP errors logged to system error log
- Client-side debugging via browser developer tools

**Database Setup:**
- Automatic table creation on first API call via Database::initializeTable()
- Uses MySQLi with prepared statements throughout  
- Schema updates handled automatically in Database.php
- Configuration in `.env` (credentials) and `config/database.php` (settings)

## API Endpoints

RESTful JSON API at `/api/trading-journal`:
- `GET /api/trading-journal` - Fetch all entries
- `POST /api/trading-journal` - Create new entry  
- `PUT /api/trading-journal?id=X` - Update entry
- `DELETE /api/trading-journal?id=X` - Delete entry

## Client-Side Architecture

**JavaScript Application (`public/assets/js/app.js`):**
- jQuery-based SPA with modular function organization
- Auto-detection of base path for subdirectory installations
- Local storage for theme persistence and auto-save drafts
- AJAX-driven data operations with comprehensive error handling
- Real-time performance analytics calculations
- Sortable/filterable table with client-side search
- Form validation and user feedback systems

**Key Client Features:**
- **Auto-save**: Drafts saved every 10 seconds to localStorage
- **Dark mode**: Theme toggle with localStorage persistence
- **Dynamic UI**: Performance stats calculated and updated in real-time
- **Responsive design**: Bootstrap 5 with mobile-first approach
- **Base path detection**: Automatic subdirectory installation support

## Database Schema

**Table: trading_journal_entries**
- Primary key: `id` (VARCHAR, generated: timestamp + random)
- Markets: ENUM('XAUUSD', 'EU', 'GU', 'UJ', 'US30', 'NAS100') - expandable via Database.php
- Sessions: ENUM('LO', 'NY', 'AS') 
- Outcomes: ENUM('W', 'L', 'BE', 'C')
- Directions: ENUM('LONG', 'SHORT')
- JSON field for timeframes: `tf` (stores array of selected timeframes)
- Decimal fields: `entry_price`, `exit_price`, `pl_percent`, `rr`
- Text fields: `chart_htf`, `chart_ltf`, `comments`
- Datetime fields: `date`, `time`, `created_at`, `updated_at`

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

phoenix/             # Phoenix Bootstrap theme reference (read-only)
config/              # Configuration files  
includes/autoloader.php # Class autoloading
.env                 # Environment variables
```

## View Components System

**Component Architecture:**
- Reusable PHP components in `src/Views/components/`
- Included via PHP `include` statements in main views
- Each component is self-contained with its own HTML, styling context, and JavaScript templates

**Key Components:**
- `trading-form.php`: Main trade entry form with 17 fields
- `edit-form.php`: Modal form for editing existing trades
- `trades-table.php`: Sortable/filterable data table with trade-row.php
- `performance-stats.php`: Real-time analytics with Phoenix list group design
- `trade-strategy-checklist.php`: Pre-trade planning checklist component
- `trade-row-functions.php`: JavaScript functions for table row operations

**Component Layout System:**
- `home.php`: Main layout orchestrator with responsive grid system
- Uses Bootstrap 5 grid with centered columns (col-10 offset-md-1)
- Two-row layout: form + checklist (top), table + stats (bottom)

## Key Features

- **Auto-save drafts**: Client-side localStorage persistence every 10 seconds
- **Performance analytics**: Real-time calculations from trade data with dynamic badges
- **Color-coded UI**: Blue (basics), Green (performance), Purple (metrics), Orange (charts), Teal (comments)
- **Responsive design**: Bootstrap 5 with Phoenix theme components and dark mode
- **Security**: Prepared statements, XSS headers, input sanitization, environment variables
- **Phoenix Theme**: Uses Phoenix Bootstrap components and design patterns from `/phoenix/` reference folder

## Adding New Markets/Sessions

1. Update ENUM values in `src/Models/Database.php:initializeTable()`
2. Update form options in view components:
   - `src/Views/components/trading-form.php`
   - `src/Views/components/edit-form.php`

## Deployment & Environment

**Subdirectory Support:**
- Application auto-detects installation path via JavaScript base path detection
- Router handles both root directory and subdirectory installations
- `.htaccess` configured for flexible URL rewriting

**Production Considerations:**
- Uncomment HTTPS redirect in `.htaccess` for SSL
- Update `.env` with production database credentials
- Ensure Apache mod_rewrite, mod_headers, mod_deflate, and mod_expires are enabled
- File permissions: 755 for directories, 644 for files

## Error Handling

**Multi-layer Error Handling:**
- PHP errors logged via `error_log()` with context
- Database connection errors caught in Database singleton
- MySQLi query errors logged with prepared statement context
- Client-side AJAX error handling with user feedback
- Router provides 404 JSON responses for missing endpoints
- Form validation on both client and server sides

## Security Features

- MySQLi prepared statements prevent SQL injection throughout
- Input sanitization and validation at multiple layers
- Comprehensive security headers in `.htaccess` (XSS, CSRF, content type)
- Environment variable configuration prevents credential exposure
- All requests routed through index.php (no direct file access)
- Gzip compression and static file caching configured