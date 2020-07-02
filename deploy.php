<?php
namespace Deployer;

require 'recipe/common.php';
require 'recipe/npm.php';

// Project name
set('application', 'ApplicationName');

// Project repository
set('repository', 'git@github.com:user/repo.git');

// [Optional] Allocate tty for git clone. Default value is false.
//set('git_tty', true);

// Shared files/dirs between deploys
set('shared_files', [
    'Config/DatabaseSettings.php',
]);
set('shared_dirs', [
    "storage"
]);

// Writable dirs by web server
set('writable_dirs', []);
set('allow_anonymous_stats', false);

set('git_recursive', false);

set('configFile', '~/.ssh/config');
/*
 * Make sure to create a ~/.ssh/config file
 * https://mediatemple.net/community/products/grid/204644730/using-an-ssh-config-file
 */

// Hosts

inventory('Config/hosts.yml');


task('deploy:make_tmp', function () {
    run('cd {{release_path}} && mkdir tmp');
});

task('deploy:minify', function () {
    run('cd {{release_path}} && php -f minify.php');
});

// Tasks

desc('Deploy your project');
task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:writable',
    'deploy:vendors',
    'deploy:make_tmp',
    'deploy:minify',
    'deploy:clear_paths',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
    'success'
]);
after('deploy:update_code', 'npm:install');

// [Optional] If deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');
