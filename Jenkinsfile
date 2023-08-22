pipeline {
    agent any
    environment {
        SCANNER_HOME = tool 'sonar_test'
    }
    
    stages {
        stage('Checkout') {
            steps {
                checkout scm
            }
        }
        stage('SonarQube Analysis') {
            steps {
                script {
                    
                    
                    withSonarQubeEnv('SonarQubeScanner') {
                        
                        sh '''$SCANNER_HOME/bin/sonar-scanner \
                        -Dsonar.projectKey=back_end \
                        -Dsonar.sources=.  '''
                    }
                }
            }
        }
    

        stage('build image') {
            steps {
                script {
                    echo "building the docker image..."
                    withCredentials([usernamePassword(credentialsId: 'docker-hub-repo', passwordVariable: 'PASS', usernameVariable: 'USER')]) {
                        sh "docker build -t salaheddineraiss/front_end ."
                        sh "echo $PASS | docker login -u $USER --password-stdin"
                        sh "docker push salaheddineraiss/front_end"
                    }
                }
            }
        }
        stage('deploy image') {
            steps {
                script {
                    echo "building the docker image..."
                    sshagent(['ssh-instance']) {                
                        sh "ssh -o StrictHostKeyChecking=no root@217.160.8.74 'docker-compose up -d' "   
                    }
                }
            }
        }


    }
    
}