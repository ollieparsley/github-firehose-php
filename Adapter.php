<?php

/**
 * @copyright  Copyright (c) 2012 Hootware Ltd.
 * @license    http://hootware.com/licenses/internal
 * @author     Ollie Parsley <ollie@hootware.com>
 */

abstract class Adapter
{
	/**
	 * Set up the adapter
	 *
	 * @return void
	 */
	public function setup()
	{
		//Override this to set up a connection etc
	}

	/**
	 * Finished with the adapter
	 *
	 * @return  void
	 */
	public function finished()
	{
		//Override this close a connection etc
	}

	/**
	 * Push the data somewhere
	 * 
	 * @param array $data The data in fomatted: http://developer.github.com/v3/events/
	 *
	 * @return void
	 */
	abstract public function push($data);

}