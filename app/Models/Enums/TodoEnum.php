<?php

namespace App\Models\Enums;

enum TodoEnum: int
{
    case STATUS_PENDING = 0;
    case STATUS_DONE = 1;
}
