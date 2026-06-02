<?php

namespace App\Enums;

enum RoleEnum: string
{
    case SUPER_ADMIN        = 'super_admin';
    case ADMIN              = 'admin';
    case SALES_MANAGER      = 'sales_manager';
    case CUSTOMER_SUPPORT   = 'customer_support';
    case FINANCE_MANAGER    = 'finance_manager';
    case CONTENT_MODERATOR  = 'content_moderator';
    case OWNER              = 'owner';
    case SEEKER             = 'seeker';
    case WARDEN             = 'warden';
    case RECEPTION_STAFF    = 'reception_staff';
    case ACCOUNTANT         = 'accountant';
}