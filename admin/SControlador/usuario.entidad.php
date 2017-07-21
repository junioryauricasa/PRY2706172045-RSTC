<?php
class usuario
{
	private $intUserId;
	private $nvchUserName;
	private $nchUserMail;
	private $nvchUserPassword;
	private $intIdEmpleado;
	private $intTypeUser;
	private $bitUserEstado;

	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}
?>