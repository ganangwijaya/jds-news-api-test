# News Management API

News management API built with Laravel to complete JDS Techincal Test.

## Task List
### Project Stories Completed List
1. [x] Create APIs using Laravel for a news management application.
2. [x] Use MySql as the database, create the file migrations using Laravel database migration.
3. [x] Only admin can create, update, and delete the news.
4. [x] One news has one image, admin can upload it along with the news creation (in creation form).
5. [ ] Use event & listener to create log in separate table when a news is created, updated, and deleted.
6. [x] Make non admin users can post comments to a news.
7. [ ] Use Redis for queuing the comment creation process.
8. [x] Each API response has to use Laravel API Resource.
9. [x] Make pagination for the news list API.
10. [x] Create a get news detail API with posted comments.
11. [x] Each API request is protected by OAuth 2.0, use Laravel Passport.
### Instructions Completed
1. [x] Apply readable / clean code.
2. [ ] Apply Repository design pattern into the code.
3. [ ] Apply SOLID principles into the code.
4. [ ] Applying DDD design pattern is a big plus (Optional).
5. [x] Create a Postman collection to store all API requests, generate a public link to share, and send by
email
6. [x] Create a new project in GitHub, or GitLab, Or BitBucket
7. [x] Create how to install / deploy the project.

## How To Run
### Requirement
- PHP >= 8.0
- BCMath PHP Extension
- Ctype PHP Extension
- cURL PHP Extension
- DOM PHP Extension
- Fileinfo PHP Extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PCRE PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
### Run This Project Locally
1. Rename `.env.example` file to `.env` and fill `DB_DATABASE`, `DB_USERNAME` and `DB_PASSWORD` with your own database information
2. Run `composer install`
3. Run `php artisan key:generate`
4. Run `php artisan migrate`
5. Run seeder `php artisan db:seed` for user admin
6. Run `php artisan serve`
7. Open this project on `localhost:8000`
### Run Request on Postman
1. Import postman collection in file with foler `/postman`
2. On `Login` request and copy `token` response to parent folder - authorization - change type to `Bearer Token` and paste `token` on `Token` field.
3. Run all request with copied `token` for admin.
4. Admin can add, edit and delete news.
5. If you want logged in as user, run request `Register` and add your account, then login with your new account and repeat step 2.
6. Run other request with user type.
7. Thanks🚀

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

