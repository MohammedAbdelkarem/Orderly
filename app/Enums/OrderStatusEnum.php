<?php

namespace App\Enums;

use Kongulov\Traits\InteractWithEnum;

enum OrderStatusEnum: string
{
    use InteractWithEnum;

    case PENDING        = 'pending';
    case PREAPERING     = 'prepering';
    case TO_CUSTOMER    = 'to_customer';
    case DELIVERED      = 'delivered';
    case CANCELLED      = 'cancelled';
    case REJECTED       = 'rejected';
}
