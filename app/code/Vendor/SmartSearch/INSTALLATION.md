# SmartSearch Extension Installation Guide

This guide will help you install and set up the SmartSearch extension for Magento 2, which provides advanced search functionality with typeahead suggestions, popular searches, trending products, and more.

## Prerequisites

- Magento 2 (2.4.x recommended)
- PHP 7.4 or higher
- Composer

## Installation Steps

### 1. Get the Extension Code

#### Option A: Via Composer (recommended)

```bash
composer require vendor/module-smart-search
```

#### Option B: Manual Installation

1. Create the following directory structure in your Magento installation:
   ```
   app/code/Vendor/SmartSearch/
   ```

2. Download or clone the extension files into this directory.

### 2. Enable the Extension

Run the following commands from your Magento root directory:

```bash
# Enable the module
bin/magento module:enable Vendor_SmartSearch

# Run the setup upgrade
bin/magento setup:upgrade

# Compile Dependency Injection
bin/magento setup:di:compile

# Deploy static content (for production mode)
bin/magento setup:static-content:deploy
```

### 3. Clear Cache

```bash
bin/magento cache:clean
bin/magento cache:flush
```

## Configuration

1. Navigate to **Stores > Configuration > Vendor Extensions > Smart Search** in the Magento admin panel.

2. Configure the extension settings:
   - General Settings:
     - Enable/disable the extension
     - Set minimum query length
     - Set maximum results
     - Set debounce time
   - Display Settings:
     - Enable/disable product thumbnails
     - Enable/disable product prices
     - Enable/disable product descriptions
     - Enable/disable popular searches
     - Enable/disable category results

3. Save the configuration.

## Troubleshooting

### The search dropdown is not appearing

- Make sure the extension is enabled in the configuration
- Check your browser console for JavaScript errors
- Ensure the theme is compatible (the extension uses Magento's default search field)

### CSS styling issues

If you're experiencing styling issues, you may need to add custom CSS to match your theme. The extension adds its CSS in:

```
Vendor/SmartSearch/view/frontend/web/css/smartsearch.css
```

You can override this in your theme or add additional styling as needed.

## Support

For issues or assistance, please contact support at [support@example.com](mailto:support@example.com) or open an issue in the extension's repository.