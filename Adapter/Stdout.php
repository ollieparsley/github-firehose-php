<?php

require('./Adapter.php');

/**
 * @copyright  Copyright (c) 2012 Hootware Ltd.
 * @license    http://hootware.com/licenses/internal
 * @author     Ollie Parsley <ollie@hootware.com>
 */

class Adapter_Stdout extends Adapter
{
	/**
	 * Set up the adapter
	 *
	 * @return void
	 */
	public function setup()
	{
		echo "Setting up\n";
	}

	/**
	 * Finished with the adapter
	 *
	 * @return  void
	 */
	public function finished()
	{
		echo "Finished\n";
	}

	/**
	 * Push the data somewhere
	 * 
	 * @param array $data The data in fomatted: http://developer.github.com/v3/events/
	 *
	 * @return void
	 */
	public function push($data)
	{
		//echo "Data: " . json_encode($data) . "\n";
		echo "Successful\n";
	}

}