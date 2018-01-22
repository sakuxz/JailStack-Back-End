pipeline {
  agent any
  stages {
    stage('install') {
      agent {
        dockerfile {
          filename 'docker/php7.2-cli/Dockerfile'
        }
        
      }
      steps {
        sh '''composer install
cp docker/php7.2-cli/.env.development.example .env
php artisan key:generate
php artisan vendor:publish --provider="Tymon\\JWTAuth\\Providers\\LaravelServiceProvider"
php artisan jwt:secret -f
ls -al'''
        stash 'install'
      }
    }
    stage('test') {
      agent {
        dockerfile {
          filename 'docker/php7.2-cli/Dockerfile'
        }
        
      }
      steps {
        sh '''ls -al
file ./vendor/bin/phpunit
file ./vendor/phpunit/phpunit/phpunit
php ./vendor/bin/phpunit'''
      }
    }
  }
}