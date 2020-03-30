<?php

class ConexionSoftmor
{

	static public function conectar()
	{

		//cPHEYt5nxfW3
		 $link = new PDO("mysql:host=localhost;dbname=u203735599_soft",
	        "u203735599_soft",
		             "1Q8jeQzVtmVULd5dpX");
	//	$link = new PDO(
	//		"mysql:host=localhost;dbname=softmor",
	//		"root",
	//		""
	//	);

		$link->exec("set names utf8");

		return $link;
	}
}
