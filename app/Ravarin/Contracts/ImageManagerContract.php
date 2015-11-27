<?php 

namespace Ravarin\Contracts;

interface ImageManagerContract 
{
    public function make($src, $destination);

    public function thumbnail($src, $destination);
}