# music-studio

How To Install

1. Pull this projects 
2. Rename the .env.example to .env
3. Configure your environment (.env) file
4. Run $ php artisan key:generate
5. Run composer update
6. Run npm install
7. Run npm run dev
8. Change required permission of bootstrap & storage directory (not required in windows)
5. Run $ php artisan migrate
6. Run $ php artisan make:auth
7. Run $ php artisan db:seed
8. Run $ php artisan serve
9. Open the address in the browser suggested by artisan (ex. http://127.0.0.1:8000)



Note : I am assuming you have basic knowledge about Laravel and server setup.



Assumptions
1. Slot will be available on the same day starting at 12:00 AM. User can not book in advance.
2. Timezone is Asia/Kolkata
3. Studio does not have multiple opening and closing time on the same day.
4. All the data are randomly generated using Laravel Faker 

