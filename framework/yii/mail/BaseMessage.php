<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\mail;

use yii\base\Object;
use Yii;

/**
 * BaseMessage serves as a base class that implements the [[send()]] method required by [[MessageInterface]].
 *
 * By default, [[send()]] will use the "mail" application component to send the current message.
 * The "mail" application component should be a mailer instance implementing [[MailerInterface]].
 *
 * @see BaseMailer
 *
 * @property BaseMailer $mailer mailer component instance. This property is read-only.
 *
 * @author Paul Klimov <klimov.paul@gmail.com>
 * @since 2.0
 */
abstract class BaseMessage extends Object implements MessageInterface
{
	/**
	 * @return MailerInterface the mailer component
	 */
	public function getMailer()
	{
		return Yii::$app->getComponent('mail');
	}

	/**
	 * @inheritdoc
	 */
	public function send()
	{
		return $this->getMailer()->send($this);
	}

	/**
	 * PHP magic method that returns the string representation of this object.
	 * @return string the string representation of this object.
	 */
	public function __toString()
	{
		// __toString cannot throw exception
		// use trigger_error to bypass this limitation
		try {
			return $this->toString();
		} catch (\Exception $e) {
			trigger_error($e->getMessage());
			return '';
		}
	}
}
