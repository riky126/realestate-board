<?php
namespace App\Common\Enums;

enum UserType: string {
    case Administrator = 'Administrator';
    case Customer = 'Customer';
}