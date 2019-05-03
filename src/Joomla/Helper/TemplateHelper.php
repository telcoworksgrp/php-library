<?php
/**
 * =============================================================================
 *
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @copyright   Copyright (C) 2019 Telecom Corporation. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 *
 * =============================================================================
 */

namespace TCorp\Joomla\Helper;


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
	}



	/**
	 * Add all external scripts to the document
	 * -------------------------------------------------------------------------
	 * @return void
	 */
	public function addScripts()
	{
	}



	/**
	 * Add all favicons to the document
	 * -------------------------------------------------------------------------
	 * @return void
	 */
	public function addFavicons()
	{
	}



	/**
	 * Add, remove and update HTML meta tags for the document
	 * -------------------------------------------------------------------------
	 * @return void
	 */
	public function updateMetaTags()
	{
	}

}
