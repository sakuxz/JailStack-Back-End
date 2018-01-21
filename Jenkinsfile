pipeline {
  agent {
    docker {
      image 'docker/compose:1.17.0'
    }
    
  }
  stages {
    stage('build') {
      steps {
        sh '''docker-compose down
docker-compose build
ls -al
pwd
docker-compose -v
docker-compose run install
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