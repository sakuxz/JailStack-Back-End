pipeline {
  agent {
    docker {
      image 'docker/compose:1.18.0'
      args '-v /var/run/docker.sock:/var/run/docker.sock'
    }
    
  }
  stages {
    stage('build') {
      steps {
        sh '''docker -v
docker-compose -v

docker-compose down
docker-compose build
ls -al
pwd
docker-compose -v
docker-compose run -v `pwd`:/var/www/html install
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