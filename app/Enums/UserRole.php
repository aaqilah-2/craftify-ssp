<?php

namespace App\Enums;

enum UserRole: int
{
    case Administrator = 1;
    case Artisan = 2;
    case Customer = 3;
}
