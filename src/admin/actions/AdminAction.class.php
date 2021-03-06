<?php include_once dirname(__FILE__).'/../../common/ErrorCode.class.php';?>
<?php include_once dirname(__FILE__).'/../../common/entity/AdminEntity.class.php';?>
<?php

class AdminAction extends AjaxAction
{
	public function login(){
		$usr = isset($_POST["usrname"]) ? $_POST["usrname"] : null;
		$pwd = isset($_POST["usrpwd"]) ? $_POST["usrpwd"] : null;
		$usr = isset($_GET["usrname"]) ? $_GET["usrname"] : null;
		$pwd = isset($_GET["usrpwd"]) ? $_GET["usrpwd"] : null;
		$json['status'] = ErrorCode::E_SUCCESS;
		//$session = new Session();
		$json = new stdClass();
		$entity = new AdminEntity();
		if(empty($usr) || empty($pwd))
		{
			$json->status = ErrorCode::E_LOGIN_FAIL;
			$json->msg = ErrorCode::getErrDesc(ErrorCode::E_LOGIN_FAIL);
			echo json_encode($json, true);
			return;
		}

		if($entity->auth($usr, $pwd) == 1)
		{
			$json->status = ErrorCode::E_SUCCESS;
			$json->msg = ErrorCode::getErrDesc(ErrorCode::E_SUCCESS);
		}
		else {
			$json->status = ErrorCode::E_LOGIN_FAIL;
			$json->msg = ErrorCode::getErrDesc(ErrorCode::E_LOGIN_FAIL);
		}
		echo json_encode($json);
	}
}
?>
