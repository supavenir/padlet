<?php
namespace models;

use Ubiquity\attributes\items\Id;
use Ubiquity\attributes\items\Column;
use Ubiquity\attributes\items\Validator;
use Ubiquity\attributes\items\Transformer;
use Ubiquity\attributes\items\Table;
use Ubiquity\attributes\items\ManyToOne;
use Ubiquity\attributes\items\JoinColumn;

#[\AllowDynamicProperties()]
#[Table(name: "comment")]
class Comment{
	
	#[Id()]
	#[Column(name: "id",dbType: "int(11)")]
	#[Validator(type: "id",constraints: ["autoinc"=>true])]
	private $id;

	
	#[Column(name: "content",nullable: true,dbType: "text")]
	private $content;

	
	#[Column(name: "dateC",nullable: true,dbType: "datetime")]
	#[Validator(type: "type",constraints: ["ref"=>"dateTime"])]
	#[Transformer(name: "datetime")]
	private $dateC;

	
	#[ManyToOne()]
	#[JoinColumn(className: "models\\Publication",name: "idPublication")]
	private $publication;

	
	#[ManyToOne()]
	#[JoinColumn(className: "models\\User",name: "idUser")]
	private $user;


	public function getId(){
		return $this->id;
	}


	public function setId($id){
		$this->id=$id;
	}


	public function getContent(){
		return $this->content;
	}


	public function setContent($content){
		$this->content=$content;
	}


	public function getDateC(){
		return $this->dateC;
	}


	public function setDateC($dateC){
		$this->dateC=$dateC;
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
		return ($this->content??'no value').'';
	}

}