<?php

namespace ProdeBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ProdeBundle extends Bundle
{
	public function getParent()
    {
        return "FOSUserBundle";
    }

}
