pipeline {
  agent {
    dockerfile {
      filename 'docker/php7.2-cli/Dockerfile'
    }
    
  }
  stages {
    stage('build') {
      agent any
      steps {
        sh '''composer install
cp docker/php7.2-cli/.env.development.example .env
php artisan key:generate
php artisan vendor:publish --provider="Tymon\\JWTAuth\\Providers\\LaravelServiceProvider"
php artisan jwt:secret -f
ls -al'''
      }
    }
    stage('test') {
      agent {
        docker {
          image 'php'
        }
        
      }
      steps {
        sh '''ls -al
./vendor/bin/phpunit'''
      }
    }
  }
}