<?php

namespace Deployer;

desc('Syncs the remote files with the local files');
task('files:download', static function () {
  // Download remote files
  download("{{release_or_current_path}}/files/", 'files/');
});
