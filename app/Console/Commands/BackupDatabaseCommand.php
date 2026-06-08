<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class BackupDatabaseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new MySQL database backup using pure PHP/Laravel connection';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $today = date("d-m-Y-H-i-s");
        $dir = public_path("database-backup/".$today);

        if(is_dir($dir))
        {
            array_map("unlink", glob("$dir/*.*"));
            rmdir($dir);
        }
        mkdir($dir, 0777, true);

        $file_path = $dir."/{$today}-dump.sql";

        $tables = [];
        $result = DB::select('SHOW TABLES');
        foreach ($result as $row) {
            $rowArr = (array)$row;
            $tables[] = reset($rowArr);
        }

        $sql = "-- Database Backup\n";
        $sql .= "-- Date: " . date('Y-m-d H:i:s') . "\n\n";
        $sql .= "SET foreign_key_checks=0;\n\n";

        foreach ($tables as $table) {
            // Get structure
            $createTable = DB::select("SHOW CREATE TABLE `{$table}`");
            $sql .= "\n\n" . $createTable[0]->{'Create Table'} . ";\n\n";

            // Get data
            $rows = DB::table($table)->get();
            if ($rows->count() > 0) {
                foreach ($rows as $row) {
                    $rowArray = (array)$row;
                    $keys = array_map(function($key) { return "`$key`"; }, array_keys($rowArray));
                    $values = array_map(function($val) {
                        if (is_null($val)) return "NULL";
                        return DB::getPdo()->quote($val);
                    }, array_values($rowArray));

                    $sql .= "INSERT INTO `{$table}` (" . implode(', ', $keys) . ") VALUES (" . implode(', ', $values) . ");\n";
                }
            }
        }
        $sql .= "\nSET foreign_key_checks=1;\n";

        file_put_contents($file_path, $sql);
    }
}
