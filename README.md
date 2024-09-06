## Installation

- Create .env file from .env.example file
- Set QUEUE_CONNECTION=database
- Run command => composer install
- Run command => php artisan key:generate
- Run command => php artisan migrate
- Run command => php artisan db:seed
- Run command => php artisan queue:work

## Configuration
- All requests to any of those functions should contain header key “Sec-Token” with value of current date in format “yyyyMMdd” to verify, example: 20240906

## Api Endpoint

Create new data order
- (GET) /order?amount=100000&reff=2000837452&expired=2021-07-28T09%3A12%3A48%2B07%3A0 0&name=Nama+Pelanggan&hp=081854323334

Payment Order
- (GET) /payment?reff=2000837452

Get Status
- (GET) /status?reff=2000837452