# Laravel Table Optimize

## Use with caution!

Database tables with lots of insert / delete operations sometimes grows in size. For example, Laravel's `jobs` table could be empty and still take few GB's in size. That's because databases don't actually delete the data, it just marks it for deletion. Running `OPTIMIZE` or `VACUUM` commands on databases takes that space back. This package makes optimization easier.

## Supported database engines

Currently only MySql and MariaDB are supported.

## Installation

```bash
composer require luxutils/laravel-table-optimize
```

## License

This package is released under the MIT license (MIT).