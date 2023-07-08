pipeline {
    agent any
    stages {
        stage("build") {
            steps {
                echo 'Building application ......'
                // -   cp .env.example .env
                // -   composer install
                // -   php artisan key:generate
                // -   php artisan db:seed
                // -   php artisan migrate
                // -   php artisan passport:install --uuids
                // -   ./vendor/bin/phpcs --ignore=Database/Migrations
                // -   php artisan passport:keys 
            }
        }

        stage("test") {
            steps {
                echo 'Testing application ......'
            }
        }

        stage("deploy") {
            steps {
                echo 'Deploying application ......'
            }
        }
    }
}

node {
    // groove script
}