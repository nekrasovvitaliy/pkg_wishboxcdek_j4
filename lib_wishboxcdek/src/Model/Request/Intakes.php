<?php
/**
 * @copyright   2013-2024 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Entity\Requests;

use WishboxCdekSDK2\Traits\IntakesTrait;
use WishboxCdekSDK2\Traits\{CommonTrait, PackageTrait};

/**
 * Class Intakes вызова курьера.
 */
class Intakes extends Source
{
    use CommonTrait, PackageTrait {
        CommonTrait::getComment insteadof PackageTrait;
        CommonTrait::setComment insteadof PackageTrait; }

    use IntakesTrait;
}
