<?php
namespace models;

use Ubiquity\attributes\items\Id;
use Ubiquity\attributes\items\Column;
use Ubiquity\attributes\items\Validator;
use Ubiquity\attributes\items\Transformer;
use Ubiquity\attributes\items\Table;
use Ubiquity\attributes\items\OneToMany;
use Ubiquity\attributes\items\ManyToMany;
use Ubiquity\attributes\items\JoinTable;

#[\AllowDynamicProperties()]
#[Table(name: "user")]
class User{
	
	#[Id()]
	#[Column(name: "id",dbType: "int(11)")]
	#[Validator(type: "id",constraints: ["autoinc"=>true])]
	private $id;

	
	#[Column(name: "login",dbType: "varchar(255)")]
	#[Validator(type: "length",constraints: ["max"=>"255","notNull"=>true])]
	#[Transformer('crypt')]
    private $login;

	
	#[Column(name: "password",nullable: true,dbType: "varchar(255)")]
	#[Validator(type: "length",constraints: ["max"=>"255"])]
	#[Transformer(name: "hpassword")]
	private $password;

	
	#[Column(name: "email",nullable: true,dbType: "varchar(255)")]
	#[Validator(type: "email",constraints: [])]
	#[Validator(type: "length",constraints: ["max"=>"255"])]
	#[Transformer(name: "crypt")]
	private $email;

	
	#[OneToMany(mappedBy: "user",className: "models\\Comment")]
	private $comments;

	
	#[OneToMany(mappedBy: "user",className: "models\\Padlet")]
	private $padlets;

	
	#[OneToMany(mappedBy: "user",className: "models\\Pubevaluation")]
	private $pubevaluations;

	
	#[OneToMany(mappedBy: "user",className: "models\\Publication")]
	private $publications;

	
	#[OneToMany(mappedBy: "user",className: "models\\Team")]
	private $teams;

	
	#[ManyToMany(targetEntity: "models\\Team",inversedBy: "users")]
	#[JoinTable(name: "teammember")]
	private $teammembers;


	 public function __construct(){
		$this->comments = [];
		$this->padlets = [];
		$this->pubevaluations = [];
		$this->publications = [];
		$this->teams = [];
		$this->teammembers = [];
	}


	public function getId(){
		return $this->id;
	}


	public function setId($id){
		$this->id=$id;
	}


	public function getLogin(){
		return $this->login;
	}


	public function setLogin($login){
		$this->login=$login;
	}


	public function getPassword(){
		return $this->password;
	}


	public function setPassword($password){
		$this->password=$password;
	}


	public function getEmail(){
		return $this->email;
	}


	public function setEmail($email){
		$this->email=$email;
	}


	public function getComments(){
		return $this->comments;
	}


	public function setComments($comments){
		$this->comments=$comments;
	}


	 public function addToComments($comment){
		$this->comments[]=$comment;
		$comment->setUser($this);
	}


	public function getPadlets(){
		return $this->padlets;
	}


	public function setPadlets($padlets){
		$this->padlets=$padlets;
	}


	 public function addToPadlets($padlet){
		$this->padlets[]=$padlet;
		$padlet->setUser($this);
	}


	public function getPubevaluations(){
		return $this->pubevaluations;
	}


	public function setPubevaluations($pubevaluations){
		$this->pubevaluations=$pubevaluations;
	}


	 public function addToPubevaluations($pubevaluation){
		$this->pubevaluations[]=$pubevaluation;
		$pubevaluation->setUser($this);
	}


	public function getPublications(){
		return $this->publications;
	}


	public function setPublications($publications){
		$this->publications=$publications;
	}


	 public function addToPublications($publication){
		$this->publications[]=$publication;
		$publication->setUser($this);
	}


	public function getTeams(){
		return $this->teams;
	}


	public function setTeams($teams){
		$this->teams=$teams;
	}


	 public function addToTeams($team){
		$this->teams[]=$team;
		$team->setUser($this);
	}


	public function getTeammembers(){
		return $this->teammembers;
	}


	public function setTeammembers($teammembers){
		$this->teammembers=$teammembers;
	}


	 public function addTeammember($teammember){
		$this->teammembers[]=$teammember;
	}


	 public function __toString(){
		return ($this->email??'no value').'';
	}

}