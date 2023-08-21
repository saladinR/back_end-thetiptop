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

        stage('build image') {
            steps {
                script {
                    echo "building the docker image..."
                    withCredentials([usernamePassword(credentialsId: 'docker-hub-repo', passwordVariable: 'PASS', usernameVariable: 'USER')]) {
                        sh "docker build -t salaheddineraiss/back_end ."
                        sh "echo $PASS | docker login -u $USER --password-stdin"
                        sh "docker push salaheddineraiss/back_end"
                    }
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