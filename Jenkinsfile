pipeline {
  agent {
    docker {
      image 'tmaier/docker-compose'
    }
    
  }
  stages {
    stage('build') {
      steps {
        sh '''docker-compose run install
'''
      }
    }
  }
}