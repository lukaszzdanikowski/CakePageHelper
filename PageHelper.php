<?php
App::uses('Helper', 'View/Helper');

class PageHelper extends Helper {
	
	public $helpers = array('Session');
	
	public function user_is_logged_in() {
		return !!$this->Session->read('Auth.User');
	}

	public function user_is_admin() {
		$user = $this->Session->read('Auth.User');
		return (isset($user['isAdmin']) && $user['isAdmin'] == 1 && isset($user['isActive']) && $user['isActive'] == 1);
	}
	
	public function pluralize($value, $form1, $form2, $form3) {
		// Polish pluralize
		// 0 głosów, 1 głos, 2-4 głosy, 5-21 głosów, 22-24 głosy, 25-31 głosów, 32-34 głosy
		if (is_numeric($value)) {
			$number = abs($value);
			if ($number === 1) {
				return $form1;
			} else {
				if ((($number % 100 < 10) || ($number % 100 > 20)) && ($number % 10 > 1) && ($number % 10 < 5)) {
					return $form2;
				} else {
					return $form3;
				}
			}
		} else {
			throw new Exception("First argument of pluralize must be a number");
		}
	}
}
