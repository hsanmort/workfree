<?php

namespace WF\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class WFUserBundle extends Bundle
{
	public function getParent()
	{
		return 'FOSUserBundle';
	}
}
