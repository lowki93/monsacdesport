<?php

namespace MonSac\DeSportBundle\Entity;

/**
* Commande status.
*/
class CommandeStatus
{
	const ALL 			= 0;

	const NOT_VALIDATED = 1;

	const VALIDATED 	= 2;

	const SHIPPED 		= 3;

	const RECEIVED 		= 4;
}
