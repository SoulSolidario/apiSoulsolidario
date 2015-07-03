<?php
namespace app\entidades
{
	/**
	*
	*/

	class Alternativa
	{
		private $codAlternativa;
		private $descricaoAlternativa
		private $valorArea;

		/*
		* Construtor
		*/

		function __construct($codAlternativa, $descricaoAlternativa, $valorArea)
		{
			this->codAlternativa = $codAlternativa;
			this->descricaoAlternativa = $descricaoAlternativa;
			this->valorArea = $valorArea;
		}


	}
}