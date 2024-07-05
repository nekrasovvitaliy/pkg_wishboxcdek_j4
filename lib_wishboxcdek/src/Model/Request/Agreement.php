<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Entity\Requests;

use WishboxCdekSDK2\Traits\{AgreementTrait, CommonTrait};

/**
 * Договоренности о доставке.
 */
class Agreement extends Source
{
    use CommonTrait;
    use AgreementTrait;
}
