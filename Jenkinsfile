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
ls -al
pwd
echo ${HOME}
echo ${PWD} 
pwd'''
        stash 'install'
        cache(caches: [[$class: 'ArbitraryFileCache', includes: 'vender/*',  path: '${PWD}']], maxCacheSize: 600) {
          sh '''composer install
cp docker/php7.2-cli/.env.development.example .env
php artisan key:generate
php artisan vendor:publish --provider="Tymon\\JWTAuth\\Providers\\LaravelServiceProvider"
php artisan jwt:secret -f
ls -al
pwd'''
        }
        
      }
    }
    stage('test') {
      agent {
        dockerfile {
          filename 'docker/php7.2-cli/Dockerfile'
        }
        
      }
      steps {
        unstash 'install'
        sh '''ls -al
file ./vendor/bin/phpunit
file ./vendor/phpunit/phpunit/phpunit
php ./vendor/bin/phpunit'''
      }
    }
  }
}