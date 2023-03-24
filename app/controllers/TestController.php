<?php
namespace controllers;
use models\Team;
use models\User;
use Ubiquity\attributes\items\router\Get;
use Ubiquity\orm\DAO;

/**
 * Controller TestController
 */

class TestController extends \controllers\ControllerBase {

	public function index(){
	    //TODO index action implementation
		$this->loadView("TestController/index.html");
	}

	#[Get(path: "/hello/test/{message}",name: "test.hello")]
	public function hello($message) {
		$user=DAO::getById(User::class,1);
		$team=new Team();
		$team->setName($message);
		$team->setUser($user);
		DAO::insert($team);
		$this->loadView('TestController/hello.html',compact('message'));
	}




	public function userAction() {
		$this->loadView('TestController/userAction.html');
	}

}
