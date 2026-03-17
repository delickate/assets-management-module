# Assets Management System (Laravel Package)

A Laravel package to manage assets efficiently within your application. This package provides modules for asset tracking, categorization, allocation, and reporting.

---

## Features

- Asset creation, update, and deletion
- Categorize assets by type, department, or location
- Assign assets to users or departments
- Track asset lifecycle and maintenance
- Generate detailed asset reports
- Easy integration with existing Laravel applications

---

## Requirements

- Laravel 8.x or above
- PHP 7.4 or above
- Composer installed

---

## Installation

You can install the package using Composer:

```bash
composer require delickate/assets-management-module
php artisan vendor:publish --tag=assets-management-module --force
```

Copy following html and paste into any blade page. mostly being used in left navigation

```bash
<ul>
 <li><a href="<?php echo url('assetsmanagement/asset_types/listing'); ?>">Asset types</a></li>
 <li><a href="<?php echo url('assetsmanagement/asset_assignments/listing'); ?>">Asset assignments</a></li>
 <li><a href="<?php echo url('assetsmanagement/asset_disposals/listing'); ?>">Asset disposals</a></li>
 <li><a href="<?php echo url('assetsmanagement/asset_maintenance/listing'); ?>">Asset maintenance</a></li>
 <li><a href="<?php echo url('assetsmanagement/asset_returns/listing'); ?>">Asset returns</a></li>
 <li><a href="<?php echo url('assetsmanagement/assets/listing'); ?>">Assets</a></li>
 <li><a href="<?php echo url('assetsmanagement/employees/listing'); ?>">Employees</a></li>
 <li><a href="<?php echo url('assetsmanagement/vendors/listing'); ?>">Vendors</a></li>
</ul>
```
---

# 🤝 Contributing

Contributions are welcome.

1. Fork the repository
2. Create your feature branch
3. Commit your changes
4. Open a Pull Request

---

# 📄 License

This package is open-sourced software licensed under the **MIT license**.

---

# 🏢 Maintained By

Developed and maintained by **Delickate**.