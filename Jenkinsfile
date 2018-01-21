pipeline {
  agent {
    docker {
      image 'tmaier/docker-compose'
    }
    
  }
  stages {
    stage('build') {
      steps {
        sh '''docker-compose build
docker-compose run install
'''
      }
    }
  }
}