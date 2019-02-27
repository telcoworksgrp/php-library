<?php
/**
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

namespace TCorp\Joomla\Template;


/**
 * Base class for Joomla template helper's
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
	 * A copy of the template parameters as an object
	 *
	 * @var \stdClass
	 */
	public $params = null;



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
		$this->baseUrl  = Uri::base() . '/' . $document->template . '/';
		$this->params	= $document->params->asObject();

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
        $document->setHTML5(true);

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
        // Add all vendor CSS stylesheets to document
		$this->addVendorStylesheets();

        // Add all template CSS stylesheets to document
		$this->addTemplateStylesheets();
	}



    /**
     * Add all vendor CSS stylesheets to document
     * -------------------------------------------------------------------------
     * @return void
     */
    public function addVendorStylesheets()
    {
    }



    /**
     * Add all vendor CSS stylesheets to document
     * -------------------------------------------------------------------------
     * @return void
     */
    public function addTemplateStylesheets()
    {
        // Add the template's main CSS stylesheet
        $document->addStylesheet($this->baseUrl . 'css/template.css');
    }



	/**
	 * Add all external scripts to the document
	 * -------------------------------------------------------------------------
	 * @return void
	 */
	public function addScripts()
	{
        // Add all vendor scripts to the document
		$this->addVendorScripts();

        // Add all template scripts to the document
		$this->addTemplateScripts();
	}



    /**
     * Add all vendor scripts to the document
     * -------------------------------------------------------------------------
     * @return void
     */
    public function addVendorScripts()
    {
    }



    /**
     * Add all template scripts to the document
     * -------------------------------------------------------------------------
     * @return void
     */
    public function addTemplateScripts()
    {
        // Add the template's main javascript script
        $document->addScript($this->baseUrl . 'js/template.js',
			array(), array('defer'=>'true'));
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
		$document->addHeadLink($baseUrl . 'favicon.ico',
			'shortcut icon', 'rel', array('type' => 'image/x-icon'));

		$document->addHeadLink($baseUrl . 'apple-touch-icon.png',
			'apple-touch-icon');

		$document->addHeadLink($baseUrl . 'apple-touch-icon-57x57.png',
			'apple-touch-icon', 'rel', array('sizes' => '57x57'));

		$document->addHeadLink($baseUrl . 'apple-touch-icon-72x72.png',
			'apple-touch-icon', 'rel', array('sizes' => '72x72'));

		$document->addHeadLink($baseUrl . 'apple-touch-icon-76x76.png',
			'apple-touch-icon', 'rel', array('sizes' => '76x76'));

		$document->addHeadLink($baseUrl . 'apple-touch-icon-114x114.png',
			'apple-touch-icon', 'rel', array('sizes' => '114x114'));

		$document->addHeadLink($baseUrl . 'apple-touch-icon-120x120.png',
			'apple-touch-icon', 'rel', array('sizes' => '120x120'));

		$document->addHeadLink($baseUrl . 'apple-touch-icon-144x144.png',
			'apple-touch-icon', 'rel', array('sizes' => '144x144'));

		$document->addHeadLink($baseUrl . 'apple-touch-icon-152x152.png',
			'apple-touch-icon', 'rel', array('sizes' => '152x152'));
	}



	/**
	 * Add, remove and update HTML meta tags for the document
	 * -------------------------------------------------------------------------
	 * @return void
	 */
	public function updateMetaTags()
	{
        // Set the meta title to the same value as the document title
        $document->setMetaData('title', $document->getTitle());

        // Remove the generator tag added by Joomla.
		$document->setGenerator('');

        // Set the document's viewport meta tag
        $document->setMetaData('viewport', $this->viewport);
	}




}
