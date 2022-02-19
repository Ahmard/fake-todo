<?php

namespace Database\Seeders;

use App\Models\Enums\TodoEnum;
use App\Models\Todo;
use Illuminate\Database\Seeder;

class TodoSeeder extends Seeder
{
    protected array $todos = [
        ['First', 1],
        ['Second', 2],
        ['Third', 1],
        ['Fourth', 2]
    ];


    public function run(): void
    {
        foreach ($this->todos as $todo) {
            Todo::create($todo[0], TodoEnum::STATUS_PENDING, $todo[1]);
        }
    }
}
