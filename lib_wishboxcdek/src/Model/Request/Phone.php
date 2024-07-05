<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Entity\Requests;

use WishboxCdekSDK2\Traits\PhoneTrait;

/**
 * Class Phone
 * Номер телефона (мобильный/городской).
 */
class Phone extends Source
{
    use PhoneTrait;
}
