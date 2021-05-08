<?php
/**
 * User Controller
 *
 * @author Serhii Shkrabak
 * @global object $CORE->model
 * @package Model\Main
 */
namespace Model;

use \Model\Entities\Report;

class Main
{
	use \Library\Shared;

	public function uniwebhook(String $type = '', String $value = '', Int $code = 0):?array {
		$result = null;
		switch ($type) {
			case 'message':
				if ($value == 'вихід') {
					$result = ['type' => 'context', 'set' => null];
				} else
				$result = [
					'to' => $GLOBALS['uni.user'],
					'type' => 'message',
					'value' => "Сервіс `Texнічні дані` отримав повідомлення $value"
				];
				break;
				case 'click':
					$result = [
						'to' => $GLOBALS['uni.user'],
						'type' => 'message',
						'value' => "Сервіс `Texнічні дані`. Натиснуто кнопку $code",
						'keyboard' => [
							'inline' => false,
							'buttons' => [
								[['id' => 9, 'title' => 'Надати номер', 'request' => 'contact']]
							]
						]
					];
					break;
				case 'contact':
					$result = [
						'to' => $GLOBALS['uni.user'],
						'type' => 'message',
						'value' => "Сервіс `Texнічні дані`. Отримано номер $value"
					];
					break;
		}

		return $result;
	}

	public function formsubmitAmbassador(String $firstname, String $secondname, String $phone, String $position = ''):?array {
		$result = null;
		$chat = 391575974;
		$this->TG->alert("Нова заявка в *Цифрові Амбасадори*:\n$firstname $secondname, $position\n*Зв'язок*: $phone");
		$result = [];
		return $result;
	}

	public function reportpdf():?array {
		require_once('fpdf.php');
		$result = null;
		$chat = 391575974;
		$report = new Entities\Report(1,'','','','');
		$result = [$report->save()];
		return $result;
	}

	public function __construct() {
		$this->db = new \Library\MySQL('core',
			\Library\MySQL::connect(
				$this->getVar('DB_HOST', 'e'),
				$this->getVar('DB_USER', 'e'),
				$this->getVar('DB_PASS', 'e')
			) );
		$this->setDB($this->db);
		$this -> TG = new Services\Telegram(key: "", emergency: 391575974);
	}
}