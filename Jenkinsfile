pipeline {
 agent any
 stages {
        stage("Build") {
            agent {
                docker {
                    image 'edbizarro/gitlab-ci-pipeline-php:7.4-alpine'
                    args '-u root -v /var/run/docker.sock:/var/run/docker.sock'
                }
            }
            steps {
                sh 'php --version'
                sh 'composer install'
                sh 'composer --version'
                sh 'cp .env.example .env'
                sh 'php artisan key:generate'
            }
        }
        stage("Unit test") {
            steps {
                sh 'php artisan test'
            }
        }
  }
}
