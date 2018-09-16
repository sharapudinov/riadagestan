<?
namespace Vettich\AutopostingPlus;
use Bitrix\Main\Entity;
use Bitrix\Main\Type;

class DBOptionTable extends \Vettich\AutopostingPlus\DBase
{
	public static function getTableName()
	{
		return 'vettich_autopostingplus_option';
	}

	public static function getMap()
	{
		return array(
			new Entity\IntegerField('ID', array(
				'primary' => true,
				'autocomplete' => true
			)),
			new Entity\StringField('PENDING_PUBLICATION'),
			new Entity\StringField('PENDING_PUBLICATION_HITS'),
			new Entity\StringField('PENDING_PUBLICATION_IS_INTERVAL'),
			new Entity\IntegerField('PENDING_PUBLICATION_INTERVAL'),
			new Entity\BooleanField('PENDING_PUBLICATION_IS_PERIOD', array('values'=>array('N', 'Y'))),
			new Entity\StringField('PENDING_PUBLICATION_PERIOD_FROM'),
			new Entity\StringField('PENDING_PUBLICATION_PERIOD_TO'),
			new Entity\StringField('PENDING_PUBLICATION_DATE'),
			new Entity\DatetimeField('PENDING_PUBLICATION_NEXT_DATETIME', array('default_value' => \Bitrix\Main\Type\DateTime::createFromPhp(new \DateTime()))),
		);
	}

	public static function OnBeforeAdd(Entity\Event $event)
	{
		$result = new Entity\EventResult;
		$data = $event->getParameter("fields");
		$result->unsetFields(array('PENDING_PUBLICATION_NEXT_DATETIME'));
		return $result;
	}

	public static function OnBeforeUpdate(Entity\Event $event)
	{
		$result = new Entity\EventResult;
		$data = $event->getParameter("fields");

		if(empty($data['PENDING_PUBLICATION_PERIOD_FROM']))
			$result->unsetField('PENDING_PUBLICATION_PERIOD_FROM');
		if(empty($data['PENDING_PUBLICATION_PERIOD_TO']))
			$result->unsetField('PENDING_PUBLICATION_PERIOD_TO');

		if(!isset($data['PENDING_PUBLICATION_NEXT_DATETIME']))
		{
			$newNextDateTime = new \DateTime();
			$newNextDateTime->add(new \DateInterval('PT'.intval($data['PENDING_PUBLICATION_INTERVAL']).'M'));
			$result->modifyFields(array(
				'PENDING_PUBLICATION_NEXT_DATETIME' => \Bitrix\Main\Type\DateTime::createFromPhp($newNextDateTime),
			));
			$result->unsetField('PENDING_PUBLICATION_INTERVAL');
		}
		else
			$result->unsetField('PENDING_PUBLICATION_NEXT_DATETIME');

		return $result;
	}
}
