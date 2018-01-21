pipeline {
  agent any
  stages {
    stage('build') {
      steps {
        sh '''docker-compose down
docker-compose build
ls -al
pwd
docker-compose -v
docker-compose up install
'''
      }
    }
    stage('test') {
      steps {
        sh 'docker-compose run install ./vendor/bin/phpunit'
      }
    }
  }
}