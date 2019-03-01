<?php
/**
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

namespace TCorp\Joomla\Template;

use \TCorp\Joomla\Document\DocumentHelper;
use \Joomla\CMS\Factory;
use \Joomla\CMS\Uri\Uri;


/**
 * Base class for Joomla template helpers
 */
class TemplateHelper
{

    /**
	 * Holds an instance of Joomla's document instance
	 *
	 * @var HtmlDocument
	 */
	protected $document = null;



	/**
	 * A base URL for template assets (css,js,images,etc)
	 *
	 * @var string
	 */
	public $basUrl = '';



    /**
     * Default value for the viewport meta tag
     *
     * @var string
     */
    protected $viewport =
        'width=device-width, initial-scale=1, maximum-scale=1';



	/**
	 * Construtor for initialising new instances of this class
	 * -------------------------------------------------------------------------
	 *
	 * @return void
	 */
	public function __construct()
	{
		// Initialise some class properties
		$this->document = Factory::getDocument();
		$this->baseUrl  = Uri::base() . 'templates/' .
			$this->document->template . '/';

		// Initialise the template (add assets, etcs)
		$this->initialise();
	}



    /**
	 * Initialise the template (add assets, set some values, etc)
	 * -------------------------------------------------------------------------
	 * @return void
	 */
	public function initialise()
	{
		// Set the document to HTML5
        $this->document->setHTML5(true);

		// Add all CSS stylesheets to document
		$this->addStylesheets();

		// Add all scripts to the document
		$this->addScripts();

		// Add all favicons to the document
		$this->addFavicons();

		// Update HTML meta tags for the document
		$this->updateMetaTags();
	}



	/**
	 * Add all external CSS stylesheets to document
	 * -------------------------------------------------------------------------
	 * @return void
	 */
	public function addStylesheets()
	{
		// Add stylesheets specific to this template
        DocumentHelper::addStylesheet($this->baseUrl . 'css/template.css');
	}


	/**
	 * Add all external scripts to the document
	 * -------------------------------------------------------------------------
	 * @return void
	 */
	public function addScripts()
	{
		// Add scripts specific to this template
        DocumentHelper::addScript($this->baseUrl . 'js/template.js', '', true);
	}


	/**
	 * Add all favicons to the document
	 * -------------------------------------------------------------------------
	 * @return void
	 */
	public function addFavicons()
	{
        // Initialise some local variables
		$baseUrl  = $this->baseUrl . 'images/favicons/';

        // Add favicons to the HTML document
		$this->document->addHeadLink($baseUrl . 'apple-touch-icon.png',
			'apple-touch-icon', 'rel', array('sizes' => '180x180'));

		$this->document->addHeadLink($baseUrl . 'favicon-32x32.png',
			'icon', 'rel', array('sizes' => '32x32'));

		$this->document->addHeadLink($baseUrl . 'favicon-16x16.png',
			'icon', 'rel', array('sizes' => '16x16'));

		$this->document->addHeadLink($baseUrl . 'site.webmanifest', 'manifest');

		$this->document->addHeadLink($baseUrl . 'safari-pinned-tab.svg',
			'mask-icon', 'rel', array('color' => '#5bbad5'))

		$this->document->addHeadLink($baseUrl . 'favicon.ico', 'shortcut icon');

		$this->document->setMetaData('msapplication-TileColor', '#2b5797');
		$this->document->setMetaData('theme-color', '#ffffff');

		$this->document->setMetaData('msapplication-config',
			'/templates/telcentral/images/favicons/browserconfig.xml');

	}



	/**
	 * Add, remove and update HTML meta tags for the document
	 * -------------------------------------------------------------------------
	 * @return void
	 */
	public function updateMetaTags()
	{
        // Set the meta title to the same value as the document title
        $this->document->setMetaData('title', $this->document->getTitle());

        // Remove the generator tag added by Joomla.
		$this->document->setGenerator('');

        // Set the document's viewport meta tag
        $this->document->setMetaData('viewport', $this->viewport);
	}



}
