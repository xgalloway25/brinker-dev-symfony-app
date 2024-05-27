# Installation #
Ensure that the db server is configured correctly in .env. I'm using MySQL localhost. 
Install dependencies with `composer install`
Create a db migration with Doctrine by running `symfony console make:migration`
Review the migration and then execute running `symfony console doctrine:migrations:migrate`

# Description #
The idea behind this project is to register and login as a guest, view profile information, and edit or delete the profile as desired. Future functionality to view transaction history, redemption history, and earn points towards rewards will be incorporated. What's functional now if the security authentication at registration and login (a guest profile is created and recorded in the db on successful registration), and the CRUD endpoints for viewing profile information (listing and getting) provided in the db, editing the profile, and deleting the profile.

# Available Endpoints #
- `/register` - register a new guest
- `/login` - authenticate a user
- `/logout` - logout of a profile
- `/guest/` - view available profiles mathing the users guest id
- `/guest/{id}` - view the guest's profile and delete
- `/guest/{id}/edit` - edit the guest's profile

# Testing #
There are unit and functional tests for the Guest controller availabile. Run `php bin/phpunit tests/functional` and `php bin/phpunit tests/unit` to run isolated functional or unit tests









