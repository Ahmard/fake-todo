<?php

namespace App\Models;

use App\Models\Enums\TodoEnum;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = ['title', 'userId', 'status'];

    public static function create(string $title, TodoEnum $status, int $userId): Todo
    {
        $todo = new static();
        $todo->title = $title;
        $todo->status = $status->value;
        $todo->userId = $userId;
        $todo->save();

        return $todo;
    }
}
