pipeline {
  agent any
  stages {
    stage('build') {
      steps {
        sh '''docker-compose up -d php7.2-cli mysql
docker-compose exec php7.2-cli composer install
docker-compose exec php7.2-cli cp .env.example .env
docker-compose exec php7.2-cli php artisan key:generate
docker-compose exec php7.2-cli php artisan vendor:publish --provider="Tymon\\JWTAuth\\Providers\\LaravelServiceProvider"
docker-compose exec php7.2-cli php artisan jwt:secret
docker-compose exec php7.2-cli php artisan migrate
'''
      }
    }
  }
}