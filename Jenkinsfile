pipeline {
  agent {
    docker {
      args '-v /var/run/docker.sock:/var/run/docker.sock'
      image 'tmaier/docker-compose'
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