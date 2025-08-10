# Trading Journal - PHP Version

A complete vanilla PHP trading journal application with Bootstrap 5, jQuery, and MySQL. This is a port of the original Next.js version with identical functionality.

## Features

- **Complete Trading Journal**: 17-field trade entry form with validation
- **Performance Analytics**: Real-time statistics (win rate, profit factor, best/worst trades)
- **Data Management**: Full CRUD operations with sortable, filterable table
- **Responsive Design**: Mobile-first Bootstrap 5 with dark mode support
- **Color-Coded UI**: Intuitive organization by data categories
- **Auto-Save**: Draft persistence to prevent data loss
- **RESTful API**: JSON API endpoints for all operations

## Tech Stack

- **Backend**: Vanilla PHP 8+ with MVC architecture
- **Frontend**: Bootstrap 5 + jQuery
- **Database**: MySQL with MySQLi
- **Styling**: Custom CSS with dark mode support
- **No Build Process**: Direct file editing and deployment

## Quick Start

### Requirements

- PHP 8.0 or higher
- MySQL 5.7 or higher
- Apache/Nginx with mod_rewrite enabled

### Installation

1. **Clone/Download** the project to your web server document root
2. **Configure Database** - Edit `.env` file:
   ```env
   MYSQL_HOST=localhost
   MYSQL_USER=your_username
   MYSQL_PASSWORD=your_password
   MYSQL_DATABASE=trading_journal
   ```

3. **Set Permissions** (if needed):
   ```bash
   chmod 755 public/
   chmod 644 public/.htaccess
   ```

4. **Access Application**: Visit `http://localhost/trade-journal-php/public`

### Database Setup

The application will automatically:
- Create the required database table on first API call
- Handle all schema setup and indexes
- Use the existing database schema (compatible with Next.js version)

## Directory Structure

```
trade-journal-php/
├── public/                 # Web root
│   ├── index.php          # Main entry point
│   ├── .htaccess          # URL rewriting
│   ├── api/
│   │   └── trading-journal.php
│   └── assets/
│       ├── css/app.css    # Custom styles
│       └── js/app.js      # Main JavaScript
├── src/
│   ├── Controllers/       # MVC Controllers
│   ├── Models/           # Database models
│   ├── Views/            # HTML templates
│   └── Core/             # Application core
├── config/               # Configuration files
└── includes/             # Autoloader
```

## API Endpoints

All endpoints return JSON responses:

- `GET /api/trading-journal` - Fetch all entries
- `POST /api/trading-journal` - Create new entry
- `PUT /api/trading-journal?id=X` - Update entry
- `DELETE /api/trading-journal?id=X` - Delete entry

## Features Overview

### Trading Form
- Market selection (XAUUSD, EURUSD, GBPUSD)
- Session tracking (London, New York, Asian)
- Direction (Long/Short) with entry/exit prices
- Outcome tracking (Win/Loss/Break Even/Cancelled)
- Risk metrics (P/L%, Risk/Reward ratio)
- Multiple timeframe analysis
- Chart URL storage (HTF/LTF)
- Comments and notes

### Performance Analytics
- Total trades and win rate
- Account gain calculation
- Profit factor analysis
- Average risk/reward ratio
- Best and worst trade tracking
- Trade outcome breakdown

### Data Table
- Sortable columns
- Search functionality
- Edit/Delete operations
- Responsive design
- Color-coded outcomes

### Additional Features
- **Dark Mode**: Toggle with localStorage persistence
- **Auto-Save**: Draft saving every 10 seconds
- **Form Validation**: Client and server-side validation
- **Mobile Responsive**: Works on all device sizes
- **Color System**: Blue (basics), Green (performance), Purple (metrics), Orange (charts), Teal (comments)

## Customization

### Adding Markets
Edit the market options in:
- `src/Views/components/trading-form.php`
- `src/Views/components/edit-form.php` 
- Update the database ENUM in `src/Models/Database.php`

### Styling
Modify `public/assets/css/app.css` for custom styling. The CSS uses CSS variables for easy theming.

### Database Schema
The MySQL table structure matches the original Next.js version for data compatibility.

## Deployment

### Shared Hosting
1. Upload files to public_html or web root
2. Update .env with your database credentials
3. Ensure mod_rewrite is enabled
4. Access the application

### VPS/Dedicated Server
1. Configure Apache/Nginx virtual host pointing to `public/` directory
2. Set up SSL certificate (recommended)
3. Configure database access
4. Enable gzip compression and caching (included in .htaccess)

## Security Features

- Input sanitization and validation
- Prepared statements (SQL injection prevention)  
- XSS protection headers
- CSRF protection ready
- Environment variable configuration

## Browser Compatibility

- Chrome/Edge 88+
- Firefox 85+
- Safari 14+
- Mobile browsers (iOS Safari, Chrome Mobile)

## Migration from Next.js

This PHP version maintains 100% feature parity with the original Next.js application:
- Same database schema (no data migration needed)
- Identical UI and functionality
- Same color-coding system
- Compatible API responses

## Support

For issues or questions, check:
1. PHP error logs
2. Browser developer console
3. Database connection settings
4. File permissions

## License

Open source - feel free to modify and distribute.