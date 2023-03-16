<?php

namespace Deployer;

import('recipe/contao.php');
import(__DIR__ . "/files.php");
import(__DIR__ . "/database.php");
import(__DIR__ . "/rsync.php");

set('keep_releases', 5);

after('deploy:failed', 'deploy:unlock');
