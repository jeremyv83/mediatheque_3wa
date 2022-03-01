<?php

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

new \Symfony\WebpackEncoreBundle\WebpackEncoreBundle();

class Kernel extends BaseKernel
{
    use MicroKernelTrait;
}
