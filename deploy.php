<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'test_deployer');

// Project repository
// set('repository', 'git@github.com-my_asus_vivobokk:dangduylong96/test_deployer.git');
set('repository', 'https://github.com/dangduylong96/test_deployer.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 
// Shared files/dirs between deploys 
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server 
add('writable_dirs', []);


// Hosts

host('172.17.0.2')
    ->set('deploy_path', '/var/www/html')
    ->user('longdeployer');

// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

desc('complite js');
task('complite-public', function () {
	$output = run('cd {{release_path}} && npm install');
	$output = run('cd {{release_path}} && npm run dev');
	writeln('<info>' . $output . '</info>');
});

// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');
after('deploy', 'complite-public');

