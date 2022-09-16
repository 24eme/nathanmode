<?php
class Email
{
		private static $_instance = null;
		protected $_context;

		public function __construct($context = null)
		{
			  $this->_context = ($context)? $context : sfContext::getInstance();
		}

		public static function getInstance($context = null)
		{
       	if(is_null(self::$_instance)) {
       		self::$_instance = new Email($context);
				}
				return self::$_instance;
  	}

    public function firstProductionRelance($productions, $destinataires, $correspondants, $isCoupe = false)
    {
        $subject = 'Reminder // Bulk orders to come';
        $body = $this->getBodyFromPartial('first_production_relance', array('items' => $productions));
				$message = Swift_Message::newInstance()
								->setFrom(array(sfConfig::get('app_email_plugin_from_adresse') => sfConfig::get('app_email_plugin_from_name')))
								->setTo($destinataires)
								->setCc((count($correspondants) > 0)? $correspondants : array(sfConfig::get('app_email_plugin_replyto_cc_adresse')))
								->setReplyTo((count($correspondants) > 0)? $correspondants : array(sfConfig::get('app_email_plugin_replyto_cc_adresse')))
								->setSubject($subject)
								->setBody($body)
								->setContentType('text/html');
        return $this->getMailer()->send($message);
    }

    public function secondProductionRelance($productions, $destinataires, $correspondants, $isCoupe = false)
    {
        $subject = 'Urgent reminder // Bulk orders to come';
        $body = $this->getBodyFromPartial('second_production_relance', array('items' => $productions));
				$message = Swift_Message::newInstance()
								->setFrom(array(sfConfig::get('app_email_plugin_from_adresse') => sfConfig::get('app_email_plugin_from_name')))
								->setTo($destinataires)
								->setCc((count($correspondants) > 0)? $correspondants : array(sfConfig::get('app_email_plugin_replyto_cc_adresse')))
								->setReplyTo((count($correspondants) > 0)? $correspondants : array(sfConfig::get('app_email_plugin_replyto_cc_adresse')))
								->setSubject($subject)
								->setBody($body)
								->setContentType('text/html');
        return $this->getMailer()->send($message);
		}

    public function collectionRelance($collections, $destinataires, $correspondants, $isCoupe = false)
    {
        $subject = 'Urgent reminder // Collections order to come';
        $body = $this->getBodyFromPartial('collection_relance', array('items' => $collections, 'isCoupe' => $isCoupe));
				$message = Swift_Message::newInstance()
								->setFrom(array(sfConfig::get('app_email_plugin_from_adresse') => sfConfig::get('app_email_plugin_from_name')))
								->setTo($destinataires)
								->setCc((count($correspondants) > 0)? $correspondants : array(sfConfig::get('app_email_plugin_replyto_cc_adresse')))
								->setReplyTo((count($correspondants) > 0)? $correspondants : array(sfConfig::get('app_email_plugin_replyto_cc_adresse')))
								->setSubject($subject)
								->setBody($body)
								->setContentType('text/html');
				return $this->getMailer()->send($message);
		}

    public function logErreurRelance($log)
    {
        $subject = 'Nathanmode-crm // log relances';
        $body = "<p>Certaines relances n'ont pas pu être remises pour les raisons suivantes :<br /><br />$log</p>";
				$message = Swift_Message::newInstance()
								->setFrom(array(sfConfig::get('app_email_plugin_from_adresse') => sfConfig::get('app_email_plugin_from_name')))
								->setTo(array(sfConfig::get('app_email_plugin_replyto_cc_adresse')))
								->setSubject($subject)
								->setBody($body)
								->setContentType('text/html');
				return $this->getMailer()->send($message);
		}

    protected function getMailer()
    {
        return $this->_context->getMailer();
    }

    protected function getBodyFromPartial($partial, $vars = null)
    {
        return $this->_context->getController()->getAction('Email', 'main')->getPartial('Email/' . $partial, $vars);
    }
}
