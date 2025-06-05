pipeline {
    agent any
    stages {
        stage('Unit Tests') {
            steps {
                sh 'composer install'
                sh 'php vendor/bin/phpunit --coverage-openclover ./clover.xml'
                recordCoverage(
                    skipPublishingChecks: true,
                    ignoreParsingErrors: true,
                    tools: [
                        [parser: 'CLOVER', pattern: 'build/logs/clover.xml']
                    ]
                )
                clover(
                    cloverReportDir: './',
                    cloverReportFileName: 'clover.xml',
                    healthyTarget: [methodCoverage: 70, conditionalCoverage: 80, statementCoverage: 80],
                    unhealthyTarget: [methodCoverage: 50, conditionalCoverage: 50, statementCoverage: 50],
                    failingTarget: [methodCoverage: 0, conditionalCoverage: 0, statementCoverage: 0]
                )
            }
        }
    }
}
