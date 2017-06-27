<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class QuestionCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            // ['name' => '', 'module' = '', 'description' => ''],
            ['name' => 'I found a bug', 'module' => 'helpdesk-categories', 'description' => 'Error category']
        ];

        $table = DB::table('categories');
        $table->delete();
        $table->insert($data);
    }
}
