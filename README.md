## How to run

After clone project,you can run these commands:

```angular2html
Run mysql
```

```angular2html
php artisan migrate --seed
```

```angular2html
php artisan serve
```

### How delete carts (12 hours)
```angular2html
php artisan schedule:work
php artisan queue:work  // default is database
```
