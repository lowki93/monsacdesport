<?php

namespace MonSac\DeSportBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class MonSacDeSportBundle extends Bundle
{
	public function getParent()
	{
		return 'FOSUserBundle';
	}
}
