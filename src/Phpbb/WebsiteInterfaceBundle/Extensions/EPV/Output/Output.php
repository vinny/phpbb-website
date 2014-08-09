<?php
/**
 * Created by PhpStorm.
 * User: paulsohier
 * Date: 02-08-14
 * Time: 18:44
 */

namespace Phpbb\WebsiteInterfaceBundle\Extensions\EPV\Output;


use Symfony\Component\Console\Formatter\OutputFormatterInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Output implements OutputInterface{

	private $buffer = "";

	/**
	 * Writes a message to the output.
	 *
	 * @param string|array $messages The message as an array of lines or a single string
	 * @param bool $newline Whether to add a newline
	 * @param int $type The type of output (one of the OUTPUT constants)
	 *
	 * @throws \InvalidArgumentException When unknown output type is given
	 *
	 * @api
	 */
	public function write($messages, $newline = false, $type = self::OUTPUT_NORMAL)
	{
		if (!is_array($messages))
		{
			$messages = array($messages);
		}
		foreach($messages as $message)
		{
			$this->buffer .= $this->parse($message);
			if ($newline)
			{
				$this->buffer .= "\n";
			}
		}
	}

	/**
	 * Writes a message to the output and adds a newline at the end.
	 *
	 * @param string|array $messages The message as an array of lines of a single string
	 * @param int $type The type of output (one of the OUTPUT constants)
	 *
	 * @throws \InvalidArgumentException When unknown output type is given
	 *
	 * @api
	 */
	public function writeln($messages, $type = self::OUTPUT_NORMAL)
	{
		$this->write($messages, true, $type);
	}

	/**
	 * Sets the verbosity of the output.
	 *
	 * @param int $level The level of verbosity (one of the VERBOSITY constants)
	 *
	 * @api
	 */
	public function setVerbosity($level)
	{

	}

	/**
	 * Gets the current verbosity of the output.
	 *
	 * @return int     The current level of verbosity (one of the VERBOSITY constants)
	 *
	 * @api
	 */
	public function getVerbosity()
	{

	}

	/**
	 * Sets the decorated flag.
	 *
	 * @param bool $decorated Whether to decorate the messages
	 *
	 * @api
	 */
	public function setDecorated($decorated)
	{

	}

	/**
	 * Gets the decorated flag.
	 *
	 * @return bool    true if the output will decorate messages, false otherwise
	 *
	 * @api
	 */
	public function isDecorated()
	{

	}

	/**
	 * Sets output formatter.
	 *
	 * @param OutputFormatterInterface $formatter
	 *
	 * @api
	 */
	public function setFormatter(OutputFormatterInterface $formatter)
	{

	}

	/**
	 * Returns current output formatter instance.
	 *
	 * @return  OutputFormatterInterface
	 *
	 * @api
	 */
	public function getFormatter()
	{

	}

	public function getBuffer()
	{
		return $this->buffer;
	}

	/**
	 * Parse the code from the CLI to html.
	 * @param $message
	 * @return mixed Parsed message
	 */
	private function parse($message)
	{
		return $message;
	}
}