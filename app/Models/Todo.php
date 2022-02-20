<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = ['title', 'userId', 'status'];

    public const STATUS_PENDING = 0;
    public const STATUS_ACTIVE = 1;

    public static function create(string $title, int $status, int $userId): Todo
    {
        $todo = new static();
        $todo->title = $title;
        $todo->status = $status;
        $todo->userId = $userId;
        $todo->save();

        return $todo;
    }
}
