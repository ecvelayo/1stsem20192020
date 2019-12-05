# NOEL

NOEL is an E-learning training system for Northern Lights Technology Development Corporation by providing convenience for their employees when taking a training.

## Installation

> **NOTE:** The system uses [Nexmo](https://www.nexmo.com/) for SMS notifications. Please create an account to get your own API key for the `.env` file in the system which will be discussed below.

1. Download and install the following softwares:

-   [Node.js](https://nodejs.org/en/)
-   [Composer](https://getcomposer.org/download/)
-   [Git Bash](https://git-scm.com/downloads)
-   [XAMPP](https://www.apachefriends.org/index.html)

2. Open **Git Bash** and change the directory as to where are you will be putting the system. Then, clone the repository to the current directory. An optional parameter at end of the command is the folder name _(example: noel-project)_, by default the folder name is nltd-noel.

```bash
cd ../your/desired/directory
git clone https://gitlab.com/danjamo/nltd-noel.git noel-project
```

3. Select the folder where you placed the system and install all the necessary dependencies.

```bash
cd noel-project
composer install
npm install
npm run prod
```

4. Once everything is installed, create an empty database with a name: **noel**. Click the start button beside Apache and MySQL when you open the XAMPP application. Once both turns green, open a browser and access `localhost/phpmyadmin` on the address bar and click new to create a database.
5. Setup the application
    > Laravel's [installation documentation](https://laravel.com/docs/5.8/installation#configuration) explains why the first two commands are important. Read more details about the Laravel documentation [here](https://laravel.com/docs/5.8).

```bash
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan passport:install
php artisan storage:link
```

-   `cp .env.example .env` creates a `.env` file copying the contents of `.env.example`. The `.env` file stores sensitive information such as API keys, database username and password etc. and must be manually set up. To enable SMS notifications, create an account on [Nexmo](https://www.nexmo.com/). Then copy the API key and secret to the `.env` file on the `NEXMO_API_KEY` and `NEXMO_SECRET` variables.
-   `php artisan key:generate` generates an application key
-   `php artisan migrate --seed` initializes the database based from the name given on the `.env` file and seeds an admin user.
-   `php artisan passport:install` setups oath for the system.

## Development

Go to the folder where you placed the project and run the command on different command prompts:

```bash
php artisan serve
```

```bash
npm run dev
```

You can also watch for changes every time a change in the code is made. Instead of running `npm run dev`, run this command:

```bash
npm run watch
```

Open a browser and go to `localhost:8000` to view the application

## Troubleshooting

**The page loads forever after clicking the '_enroll training_' button when enrolling to a training**

> The system uses [Nexmo](https://www.nexmo.com/) for SMS notifications. The problem persists because the `NEXMO_API` and `NEXMO_SECRET` variables in the `.env` file are empty or maybe the balance in your account is insufficient.

**Solution 1:** Provide the API key and secret by creating an account in [Nexmo](https://www.nexmo.com/) and putting it on the `.env` file.

**Solution 2:** For development purposes, you can alternatively comment out the function that fires the SMS notification on these [highlighted lines](https://gitlab.com/danjamo/nltd-noel/blob/master/app%2FHttp%2FControllers%2FTrainingController.php#L419-423).

> **NOTE:** Although this may seem very helpful, this method is not recommended for production!

---

If you are still having issues feel free to email me at [danjamo13@gmail.com](mailto:danjamo13@gmail.com). Rest assured your problems will be addressed immediately.
