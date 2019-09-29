<?php
namespace Deployer;

require 'recipe/symfony.php';

// Project name
set('application', 'starwars');

// Project repository
set('repository', 'git@github.com:Arthurhall/starwars.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', false);

set('ssh_multiplexing', false);

set('deploy_path', '~/{{application}}');
set('http_user', 'arthurha');

// Shared files/dirs between deploys
set('shared_files', ['.env.local']);
set('shared_dirs', ['var/log']); // 'public/uploads'

// Writable dirs by web server
set('writable_dirs', ['var/log', 'var/cache']);
set('clear_paths', []);
set('assets', []);
set('bin_dir', 'bin');
set('var_dir', 'var');
set('bin/console', '{{release_path}}/bin/console');
set('env', ['APP_ENV' => 'prod']);

// Hosts
host('arthurha@starwars.arthurhall.fr')
    ->port(5022)
    ->identityFile('~/.ssh/planethoster_arthurha_no_pp_id_rsa')
    ->forwardAgent(true)
    ->addSshOption('StrictHostKeyChecking', 'no')
    ->set('deploy_path', '~/{{application}}');

// Tasks
task('build', function () {
    run('echo {{release_path}}');
});
task('upload', function () {
    run('ls -lsa {{release_path}}/');
    run('cd {{release_path}} && mkdir -p public/build');
    run('ls -lsa {{release_path}}/');
    upload("/f/projects/starwars/public/build", '{{release_path}}/public/');
    run('ls -lsa {{release_path}}/');
});
task('build-api-cache', function () {
    run('wget -O/dev/null -q https://starwars.arthurhall.fr');
    run('wget -O/dev/null -q https://starwars.arthurhall.fr/fr/films');
    run('wget -O/dev/null -q https://starwars.arthurhall.fr/fr/planets');
    run('wget -O/dev/null -q https://starwars.arthurhall.fr/fr/characters');
});
task('release', [
    'deploy:prepare',
    'deploy:release',
    'deploy:update_code',
    'deploy:vendors',
    'upload',
    'deploy:shared',
    'deploy:symlink',
]);

task('deploy', [
    'release',
    'cleanup',
    'build-api-cache',
    'success'
]);

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');
