<?php

namespace PhpTabs\Component;

/**
 * Log storage
 * 
 * Internal use for debugging during implementations 
 */
abstract class Log
{
  /** @var array config options */
  private static $data = array();

  /**
   * Adds a log event
   * 
   * @param string $message Text message to log
   * @param string $type optional type of log NOTICE | WARNING | ERROR
   * @return void
   */
  public static function add($message, $type = 'NOTICE')
  {
    if(Config::get('verbose'))
    {
      echo PHP_EOL . "[$type] $message";
    }

    self::$data[] = array('type' => $type, 'message' => $message);
  }

  /**
   * Counts log messages
   * 
   * @param string $type Used to filter count
   * @return integer Number of messages
   */
  public static function countLogs($type = null)
  {
    $count = 0;

    foreach(self::$data as $log)
    {
      if(null === $type || $type == $log['type'])
      {
        $count++;
      }
    }

    return $count;
  }

  /**
   * Gets last $count log messages
   * 
   * @param integer $count Number of messages to get
   * @param string $type Used to filter messages
   * @return array A list of messages
   */
  public static function tail($count = 50, $type = null)
  {
    $messages = array();
    $ptrLogs = self::countLogs($type) - 1;

    for($i = $ptrLogs; $i >= 0; $i--)
    {
      if(null === $type || $type == self::$data[$i]['type'])
      {
        array_push($messages, self::$data[$i]);

        if(count($messages) == $count)
        {
          return $messages;
        }
      }
    }

    return $messages;
  }
}
