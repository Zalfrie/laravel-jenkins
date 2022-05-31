pipeline {
 agent any
 stages {
        stage("Build") {
            steps {
                cmd 'php --version'
                cmd 'composer install'
                cmd 'composer --version'
                cmd 'cp .env.testing .env'
                cmd 'php artisan key:generate'
            }
        }
        stage("Unit test") {
            steps {
                sh 'php artisan test'
            }
        }
  }
}
