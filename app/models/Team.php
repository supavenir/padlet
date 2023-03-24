<?php
namespace models;

use Ubiquity\attributes\items\Id;
use Ubiquity\attributes\items\Column;
use Ubiquity\attributes\items\Validator;
use Ubiquity\attributes\items\Table;
use Ubiquity\attributes\items\OneToMany;
use Ubiquity\attributes\items\ManyToOne;
use Ubiquity\attributes\items\JoinColumn;
use Ubiquity\attributes\items\ManyToMany;
use Ubiquity\attributes\items\JoinTable;

#[\AllowDynamicProperties()]
#[Table(name: "team")]
class Team{
	
	#[Id()]
	#[Column(name: "id",dbType: "int(11)")]
	#[Validator(type: "id",constraints: ["autoinc"=>true])]
	private $id;

	
	#[Column(name: "name",nullable: true,dbType: "varchar(100)")]
	#[Validator(type: "length",constraints: ["max"=>"100"])]
	private $name;

	
	#[OneToMany(mappedBy: "team",className: "models\\Padlet")]
	private $padlets;

	
	#[ManyToOne()]
	#[JoinColumn(className: "models\\User",name: "idOwner")]
	private $user;

	
	#[ManyToMany(targetEntity: "models\\User",inversedBy: "teams")]
	#[JoinTable(name: "teammember")]
	private $users;


	 public function __construct(){
		$this->padlets = [];
		$this->users = [];
	}


	public function getId(){
		return $this->id;
	}


	public function setId($id){
		$this->id=$id;
	}


	public function getName(){
		return $this->name;
	}


	public function setName($name){
		$this->name=$name;
	}


	public function getPadlets(){
		return $this->padlets;
	}


	public function setPadlets($padlets){
		$this->padlets=$padlets;
	}


	 public function addToPadlets($padlet){
		$this->padlets[]=$padlet;
		$padlet->setTeam($this);
	}


	public function getUser(){
		return $this->user;
	}


	public function setUser($user){
		$this->user=$user;
	}


	public function getUsers(){
		return $this->users;
	}


	public function setUsers($users){
		$this->users=$users;
	}


	 public function addUser($user){
		$this->users[]=$user;
	}


	 public function __toString(){
		return ($this->name??'no value').'';
	}

}