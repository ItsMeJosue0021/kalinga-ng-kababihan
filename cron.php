<?php

// cron.php - manually trigger Laravel schedule:run from browser-safe script

chdir(__DIR__);
passthru('php artisan schedule:run');
