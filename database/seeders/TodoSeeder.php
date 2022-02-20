<?php

namespace Database\Seeders;

use App\Models\Todo;
use Illuminate\Database\Seeder;

class TodoSeeder extends Seeder
{
    protected array $todos = [
        ['First Item', Todo::STATUS_ACTIVE, 1],
        ['Second Item',Todo::STATUS_PENDING,  2],
        ['Third Item', Todo::STATUS_ACTIVE, 1],
        ['Fourth Item', Todo::STATUS_PENDING, 2]
    ];


    public function run(): void
    {
        foreach ($this->todos as $todo) {
            Todo::create($todo[0], $todo[1], $todo[2]);
        }
    }
}
