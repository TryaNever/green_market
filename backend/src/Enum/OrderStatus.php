<?php

namespace App\Enum;

enum OrderStatus: string
{
    case Preparation = 'preparation';
    case Livraison = 'livraison';
    case Livre = 'livre';
}