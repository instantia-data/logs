<?php

namespace Logs\Seeds;

use Illuminate\Database\Seeder;
use Logs\Model\Entities\LogOperation;

class LogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        foreach ([
            'register', 'created', 'updated', 'deleted'
        ] as $name){
            LogOperation::updateOrCreate(
                    [
                        LogOperation::FIELD_NAME => $name
                    ]);
        }
    }
}
