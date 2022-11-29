<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DatabasePullCommand extends Command
{
    protected $signature = 'db:pull';

    protected $description = 'Pull database from live server to local for troubleshooting';

    public function handle(): int
    {
        $dbName = env('PROD_DB_DATABASE');
        $dbUser = env('PROD_DB_USERNAME');
        $dbPass = env('PROD_DB_PASSWORD');

        // Download prod remote database
        $this->info('Downloading prod remote database');
        exec('ssh www "mysqldump --tz-utc=false --no-tablespaces -u'.$dbUser.' -hlocalhost -p'.$dbPass.' '.$dbName.'" > "./database/'.$dbName.'.sql"');

        // Drop & re-create local database
        $this->info('Dropping then re-creating local database');
        exec('mysql -u root -e "DROP DATABASE '.env('DB_DATABASE').'"');
        exec('mysql -u root -e "CREATE DATABASE '.env('DB_DATABASE').'"');

        // Import database
        $this->info('Importing local database from downloaded database');
        exec('mysql -u root '.env('DB_DATABASE').' < ./database/'.$dbName.'.sql');

        // Delete local SQL dump file
        $this->info('Cleaning-up local SQL dump file');
        exec('rm ./database/'.$dbName.'.sql');

        return Command::SUCCESS;
    }
}
