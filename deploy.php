<?php
namespace Deployer;

require 'recipe/symfony.php';

// Project name
set('application', 'starwars');

// Project repository
set('repository', 'https://github.com/Arthurhall/starwars.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

// Shared files/dirs between deploys
add('shared_files', ['.env.local']);
add('shared_dirs', ['var/log']); // 'public/uploads'

// Writable dirs by web server
add('writable_dirs', []);

// Hosts
host('starwars.arthurhall.fr')
    ->set('deploy_path', '~/{{application}}');

// Tasks
task('build', function () {
    run('cd {{release_path}} && build');
});
task('app:webpack', 'yarn install && yarn encore prod');

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

before('deploy:publishing', 'app:webpack');

// Migrate database before symlink new release.
before('deploy:symlink', 'database:migrate');
