<?php
namespace models;

use Ubiquity\attributes\items\Id;
use Ubiquity\attributes\items\Column;
use Ubiquity\attributes\items\Validator;
use Ubiquity\attributes\items\Table;
use Ubiquity\attributes\items\ManyToOne;
use Ubiquity\attributes\items\JoinColumn;

#[\AllowDynamicProperties()]
#[Table(name: "pubevaluation")]
class Pubevaluation{
	
	#[Id()]
	#[Column(name: "idUser",dbType: "int(11)")]
	#[Validator(type: "id",constraints: ["autoinc"=>true])]
	private $idUser;

	
	#[Id()]
	#[Column(name: "idPublication",dbType: "int(11)")]
	#[Validator(type: "id",constraints: ["autoinc"=>true])]
	private $idPublication;

	
	#[Column(name: "note",nullable: true,dbType: "tinyint(4)")]
	private $note;

	
	#[ManyToOne()]
	#[JoinColumn(className: "models\\Publication",name: "idPublication")]
	private $publication;

	
	#[ManyToOne()]
	#[JoinColumn(className: "models\\User",name: "idUser")]
	private $user;


	public function getIdUser(){
		return $this->idUser;
	}


	public function setIdUser($idUser){
		$this->idUser=$idUser;
	}


	public function getIdPublication(){
		return $this->idPublication;
	}


	public function setIdPublication($idPublication){
		$this->idPublication=$idPublication;
	}


	public function getNote(){
		return $this->note;
	}


	public function setNote($note){
		$this->note=$note;
	}


	public function getPublication(){
		return $this->publication;
	}


	public function setPublication($publication){
		$this->publication=$publication;
	}


	public function getUser(){
		return $this->user;
	}


	public function setUser($user){
		$this->user=$user;
	}


	 public function __toString(){
		return ($this->note??'no value').'';
	}

}