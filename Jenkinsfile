pipeline {
  agent {
    docker {
      image 'docker pull docker/compose'
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