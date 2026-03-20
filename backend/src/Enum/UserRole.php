<?php

namespace App\Enum;

enum UserRole: string
{
    case Client = 'client';
    case Admin = 'admin';
    case Producer = 'producer';
}