<?php

require('./Adapter.php');

/**
 * @copyright  Copyright (c) 2012 Hootware Ltd.
 * @license    http://hootware.com/licenses/internal
 * @author     Ollie Parsley <ollie@hootware.com>
 */

class Adapter_ZeroMQ extends Adapter
{
	private $socket = null;
	
	
	/**
	 * Set up the adapter
	 *
	 * @return void
	 */
	public function setup()
	{
		$this->socket = new ZMQSocket(new ZMQContext(), ZMQ::SOCKET_PUSH);
		$this->socket->bind('tcp://*:5560');
	}
	
	/**
	 * Push the data onto a ZeroMQ socket
	 * 
	 * @param array $data The data in fomatted: http://developer.github.com/v3/events/
	 *
	 * @return void
	 */
	public function push($data)
	{
		$this->socket->sendmulti(array('github', json_encode($data)));
	}

}