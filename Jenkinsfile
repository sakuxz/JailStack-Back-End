pipeline {
  agent {
    docker {
      image 'docker/compose:1.18.0'
    }
    
  }
  stages {
    stage('build') {
      steps {
        sh '''docker-compose down
docker-compose build
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