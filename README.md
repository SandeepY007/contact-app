For testing the app please follow the steps below.
Step 1. SetUp the Laravel using( composer install ) command

Step 2. Run (php artisan serve) and (npm run dev)

Step 3. Create you Account.

Step 4. Add Your Contacts

Step 5. Import Your multiple Contact with given csv file format 

Step 6. To Test Cropper upload individual profile image.

Step 7. I have also Added the  Cron job for deleting duplicate record

Step 8. To test cron run command (php artisan app:delete-duplicate-contact)

Note

APP_URL=http://localhost:8000/ please this in the env for images

Run this command for category seeder (php artisan db:seed --class=ContactCategorySeeder)

