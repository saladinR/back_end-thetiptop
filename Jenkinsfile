pipeline {
    agent any
    tools {
        maven 'mven'
        
    }


    

    stages {
        stage('Checkout') {
            steps {
                checkout scm
            }
        }

        stage('Build and Push') {
            steps {
                script {
                    //sh 'docker build -t test .'
                    sh 'echo build and push'
                }
            }
        }
        stage('Run Tests with SonarQube') {
            steps {
                script {
                    // Run your tests and generate the necessary reports
                    
                    // Configure SonarQube analysis
                    def scannerHome = tool 'SonarScanner' // Make sure you have the SonarScanner tool configured in Jenkins
                    
                    withSonarQubeEnv('SonarQube') {
                        sh "${scannerHome}/bin/sonar-scanner \
                            -Dsonar.projectKey=backend \
                            -Dsonar.sources=. \
                            -Dsonar.host.url=http://217.160.8.74:9000 \
                            -Dsonar.token=sqp_0e2f29539e7cfa3ca642fd741351773b7cf4aaf3"
                    }
                }
            }
        }
    }
    
}