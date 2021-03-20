pipeline {
  agent any
  stages {
    stage('Checkout') {
      steps {
        git(url: 'https://github.com/mattgorle/laravel-glide-in-a-box')
      }
    }

    stage('Test') {
      parallel {
        stage('PHP 7.3') {
          agent {
            docker {
              image 'mattgorle/php73-testbed:latest'
              args '-u root'
            }
          }

          stages {
            stage('PHPLint') {
              steps {
                sh 'find src -name "*.php" -print0 | xargs -0 -n1 php -l'
              }
            }

            stage('Create Directories') {
              steps {
                sh 'mkdir -p build/logs'
              }
            }

            stage('Composer') {
              steps {
                sh 'curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer'
                sh 'cd $WORKSPACE && composer install --no-progress'
              }
            }

            stage('PHPUnit') {
              steps {
                sh 'php $WORKSPACE/vendor/bin/phpunit --coverage-html $WORKSPACE/build/coverage --coverage-clover $WORKSPACE/build/clover.xml --log-junit $WORKSPACE/build/junit.xml'
              }
            }

            stage('Publish Coverage') {
              steps {
                publishHTML (target: [
                  allowMissing: false,
                  alwaysLinkToLastBuild: false,
                  keepAll: true,
                  reportDir: 'build/coverage',
                  reportFiles: 'index.html',
                  reportName: "Coverage Report"
                ])

                junit 'build/junit.xml'
              }
            }

            stage("Publish Clover") {
              steps {
                step([$class: 'CloverPublisher', cloverReportDir: 'build', cloverReportFileName: 'clover.xml'])
              }
            }

//             stage('Checkstyle Report') {
//               steps {
//                 sh 'mkdir -p build/logs'
//                 sh 'vendor/bin/phpcs --report=checkstyle --report-file=build/logs/checkstyle.xml --runtime-set ignore_warnings_on_exit true --runtime-set ignore_errors_on_exit true --standard=PSR2 --extensions=php,inc --ignore=autoload.php --ignore=vendor/ src'
//                 checkstyle pattern: 'build/logs/checkstyle.xml'
//               }
//             }
//
//             stage('Mess Detection Report') {
//               steps {
//                 sh 'vendor/bin/phpmd src xml phpmd.xml --reportfile build/logs/pmd.xml --ignore-violations-on-exit --exclude vendor/ --exclude autoload.php'
//                 pmd canRunOnFailed: true, pattern: 'build/logs/pmd.xml'
//               }
//             }

//             stage('CPD Report') {
//               steps {
//                 sh 'vendor/bin/phpcpd --log-pmd build/logs/pmd-cpd.xml --exclude vendor src'
//                 dry canRunOnFailed: true, pattern: 'build/logs/pmd-cpd.xml'
//               }
//             }

            stage('Lines of Code') {
              steps {
                sh 'vendor/bin/phploc --count-tests --exclude vendor/ --log-csv build/logs/phploc.csv --log-xml build/logs/phploc.xml src'
              }
            }

            stage('Software metrics') {
              steps {
                sh 'mkdir -p build/pdepend'
                sh 'vendor/bin/pdepend --jdepend-xml=build/logs/jdepend.xml --jdepend-chart=build/pdepend/dependencies.svg --overview-pyramid=build/pdepend/overview-pyramid.svg --ignore=vendor src'
              }
            }

            stage('Fix Permissions') {
              steps {
                sh 'chmod -R a+w $PWD && chmod -R a+w $WORKSPACE'
              }
            }
          }
        }

        stage('PHP 7.4') {
          agent {
            docker {
              image 'mattgorle/php74-testbed:latest'
              args '-u root'
            }

          }
          stages {
            stage('PHPLint') {
              steps {
                sh 'find src -name "*.php" -print0 | xargs -0 -n1 php -l'
              }
            }

            stage('Create Directories') {
              steps {
                sh 'mkdir -p build/logs'
              }
            }

            stage('Composer') {
              steps {
                sh 'curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer'
                sh 'cd $WORKSPACE && composer install --no-progress'
              }
            }

            stage('PHPUnit') {
              steps {
                sh 'php $WORKSPACE/vendor/bin/phpunit --log-junit $WORKSPACE/build/junit.xml'
              }
            }

            stage('Fix Permissions') {
              steps {
                sh 'chmod -R a+w $PWD && chmod -R a+w $WORKSPACE'
              }
            }
          }
        }

        stage('PHP 8.0') {
          agent {
            docker {
              image 'mattgorle/php80-testbed:latest'
              args '-u root'
            }

          }
          stages {
            stage('PHPLint') {
              steps {
                sh 'find src -name "*.php" -print0 | xargs -0 -n1 php -l'
              }
            }

            stage('Create Directories') {
              steps {
                sh 'mkdir -p build/logs'
              }
            }

            stage('Composer') {
              steps {
                sh 'curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer'
                sh 'cd $WORKSPACE && composer install --no-progress'
              }
            }

            stage('PHPUnit') {
              steps {
                sh 'php $WORKSPACE/vendor/bin/phpunit  --log-junit $WORKSPACE/build/junit.xml'
              }
            }

            stage('Fix Permissions') {
              steps {
                sh 'chmod -R a+w $PWD && chmod -R a+w $WORKSPACE'
              }
            }
          }
        }

      }
    }

    stage('Release') {
      steps {
        echo 'Ready to release etc.'
      }
    }

  }

  post {
    always {
      echo 'Fixing permissions of all generated files...'
      sh 'sudo chown -R jenkins:jenkins $WORKSPACE'
    }
  }
}
