<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy
 * @license     GNU General Public License version 2 or later;
 */
namespace Joomla\Component\Wishboxceilcalc\Site\Service;

use Joomla\CMS\Application\SiteApplication;
use Joomla\CMS\Categories\CategoryFactoryInterface;
use Joomla\CMS\Component\Router\RouterBase;
use Joomla\CMS\Menu\AbstractMenu;
use Joomla\Database\DatabaseDriver;
use Joomla\Database\DatabaseInterface;
use Joomla\Utilities\ArrayHelper;
use function defined;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Routing class from com_tags
 *
 * @since  1.0.0
 */
class Router extends RouterBase
{
	/**
	 * The db
	 *
	 * @var DatabaseDriver
	 *
	 * @since  1.0.0
	 */
	private DatabaseDriver $db;

	/**
	 * Tags Component router constructor
	 *
	 * @param   SiteApplication                $app              The application object
	 * @param   AbstractMenu                   $menu             The menu object to work with
	 * @param   CategoryFactoryInterface|null  $categoryFactory  The category object
	 * @param   DatabaseInterface              $db               The database object
	 *
	 * @since  1.0.0
	 *
	 * @noinspection PhpUnusedParameterInspection
	 */
	public function __construct(
		SiteApplication $app,
		AbstractMenu $menu,
		?CategoryFactoryInterface $categoryFactory,
		DatabaseInterface $db
	)
	{
		$this->db = $db;

		parent::__construct($app, $menu);
	}

	/**
	 * Build the route for the com_tags component
	 *
	 * @param   array  $query  An array of URL arguments
	 *
	 * @return  array  The URL arguments to use to assemble the subsequent URL.
	 *
	 * @since   1.0.0
	 */
	public function build(&$query)
	{
		$segments = [];

		// Get a menu item based on Itemid or currently active

		// We need a menu item.  Either the one specified in the query, or the current active one if none specified
		if (empty($query['Itemid']))
		{
			$menuItem = $this->menu->getActive();
		}
		else
		{
			$menuItem = $this->menu->getItem($query['Itemid']);
		}

		$mView = empty($menuItem->query['view']) ? null : $menuItem->query['view'];
		$mId = empty($menuItem->query['id']) ? null : $menuItem->query['id'];

		if (is_array($mId))
		{
			$mId = ArrayHelper::toInteger($mId);
		}

		if (isset($query['view']))
		{
			if ((                !empty($query['Itemid'])
				&& $query['view'] == $mView)
				|| $query['layout'] === 'default'
			)
			{
				unset($query['view']);
			}
		}

		if (isset($query['layout']))
		{
			if ((!empty($query['Itemid']) && isset($menuItem->query['layout'])
				&& $query['layout'] == $menuItem->query['layout'])
				|| $query['layout'] === 'default'
			)
			{
				unset($query['layout']);
			}
		}

		$total = count($segments);

		return $segments;
	}

	/**
	 * Parse the segments of a URL.
	 *
	 * @param   array  $segments  The segments of the URL to parse.
	 *
	 * @return  array  The URL attributes to be used by the application.
	 *
	 * @since   1.0.0
	 *
	 * @noinspection PhpMissingReturnTypeInspection
	 */
	public function parse(&$segments)
	{
		$total = count($segments);
		$vars = [];

		// Get the active menu item.
		$item = $this->menu->getActive();

		// Count route segments
		$count = count($segments);

		/*
		// Standard routing for tags.
		if (!isset($item)) {
			$vars['view'] = $segments[0];
			$vars['id']   = $this->fixSegment($segments[$count - 1]);
			unset($segments[0]);
			unset($segments[$count - 1]);

			return $vars;
		}

		$vars['id'] = $this->fixSegment($segments[0]);
		$vars['view'] = 'tag';
		unset($segments[0]);
		*/
		return $vars;
	}
}
