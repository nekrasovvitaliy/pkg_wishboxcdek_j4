<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later
 */
namespace WishboxCdekSDK2\Factory;

use WishboxCdekSDK2\CdekClientV2Interface;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Interface to be implemented by classes depending on a form factory.
 *
 * @since  1.0.0
 */
interface CdekClientV2FactoryInterface
{
	public function getDefaultClient(): CdekClientV2Interface;
}
