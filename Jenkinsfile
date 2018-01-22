pipeline {
  agent any
  stages {
    stage('build') {
      agent {
        dockerfile {
          filename 'docker/php7.2-cli/Dockerfile'
        }
        
      }
      steps {
        sh '''#composer install
cp docker/php7.2-cli/.env.development.example .env
#php artisan key:generate
#php artisan vendor:publish --provider="Tymon\\JWTAuth\\Providers\\LaravelServiceProvider"
#php artisan jwt:secret -f
touch ttttttttttttttttttttttttttttt
ls -al'''
        stash(name: 'tutu', includes: '.env')
      }
    }
    stage('test') {
      agent {
        dockerfile {
          filename 'docker/php7.2-cli/Dockerfile'
        }
        
      }
      steps {
        unstash 'tutu'
        sh '''ls -al
./vendor/bin/phpunit'''
      }
    }
  }
}