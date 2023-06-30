<?php

namespace Deployer;

desc('Syncs the remote files with the local files');
task('files:download', static function () {
  // Download remote files
  download("{{release_or_current_path}}/files/", 'files/');
});

desc('Syncs the local files with the remote files');
task('files:upload', static function () {
  // Upload local files
  upload("files/", "{{release_or_current_path}}/files");
});
