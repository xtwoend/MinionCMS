<?php

namespace Minion\Themes\View;

use Illuminate\View\FileViewFinder;

class ThemeFileViewFinder extends FileViewFinder
{

    /**
     * edit set path
     * @param array $paths [description]
     */
    public function setPaths(array $paths)
    {
        $this->paths = $paths;
        return $this;
    }

}