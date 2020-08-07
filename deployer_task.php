<?php
namespace Deployer;
desc('Symlink Laravel public To public_html');
task('app:symlink_public_html', function () {
run('ln -s /home/emweosgr/source/current/public /home/emweosgr/public_html');
});