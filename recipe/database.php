<?php

namespace Deployer;

desc('Syncs the remote database with the local database');
task('database:download', static function () {
  $backupFilename = sprintf('backup__%s.sql', date('YmdHis'));

  // Create remote backup
  cd('{{release_or_current_path}}');
  run("{{bin/console}} contao:backup:create '$backupFilename'");

  // Download remote backup
  runLocally('mkdir -p var/backups');
  download("{{release_or_current_path}}/var/backups/$backupFilename", 'var/backups/');

  // Restore remote backup
  runLocally("php bin/console contao:backup:restore '$backupFilename'");

  // Migrate
  runLocally("php bin/console contao:migrate --no-interaction --no-backup --with-deletes");
});

desc('Syncs the local database with the remote database');
task('database:upload', static function () {
  $backupFilename = sprintf('backup__%s.sql', date('YmdHis'));

  // Create local backup
  runLocally("php bin/console contao:backup:create '$backupFilename'");

  // Upload local backup
  upload("var/backups/$backupFilename", "{{release_or_current_path}}/var/backups/");

  // Restore local backup
  cd('{{release_or_current_path}}');
  run("{{bin/console}} contao:backup:restore '$backupFilename'");

  // Migrate
  run('{{bin/console}} contao:migrate {{console_options}} --no-interaction --no-backup --with-deletes');
});
