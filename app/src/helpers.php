<?php

// helpers function

if (!function_exists('theme')) {
    /**
     * Return a specified view from current theme.
     *
     * @param string|null $view
     * @param array  $data
     * @param array  $mergeData
     *
     * @return \Illuminate\View\View
     */
    function theme($view = null, array $data = array(), array $mergeData = array())
    {
        $theme = app('themes');

        if (is_null($view)) {
            return $theme;
        }

        return $theme->view($view, $data, $mergeData);
    }
}

if (! function_exists('theme_asset')){

    function theme_asset($asset, $secure = null)
    {
        $theme  = app('themes');
        if(is_null($asset)){
            return;
        }

        return $theme->asset($asset, $secure);
    }
}

if (! function_exists('posts') ){

    function posts()
    {   
        return (new Minion\Entities\Post)->type('post');
    }
}

if (! function_exists('pages') ){

    function pages()
    {   
        return (new Minion\Entities\Post)->type('page');
    }
}

if (! function_exists('categories') ){

    function categories()
    {   
        return (new Minion\Entities\Category);
    }
}

if (! function_exists('media') ){

    function media()
    {   
        return (new Minion\Entities\Media);
    }
}

if (! function_exists('comments')) {
    
    function comments()
    {
        return (new Minion\Entities\Comment);
    }
}

if (! function_exists('plugin_menus')){
    function plugin_menus(){
        $plugin = app()->make('plugins');
        return $plugin->getMenus();
    }
}

if (! function_exists('minion_menus') ){
    
    function minion_menus($args = [])
    {   
        $menu = Menu::new();
        $pages = pages()->menus()->get();
        return buildMenu($pages, $menu);
    }
}

if (! function_exists('nestedSelect') ){

    function nestedSelect($items, $options, $space = '')
    { 
        foreach($items as $item){
            $options[$item->id] = $space . $item->title;
            if($item->children()->count() > 0) 
            {   
                $space .= '-';
                $options = nestedSelect($item->children()->orderBy('order')->get(), $options, $space); 
                $space = '';           
            }
        }
        return $options;
    }
}

if (! function_exists('nestedSelectNoTrans') ){

    function nestedSelectNoTrans($items, $options, $space = '')
    { 
        foreach($items as $item){
            $options[$item->id] =  $space . $item->name;
            if($item->children()->count() > 0) 
            {   
                $space .= '-';
                $options = nestedSelectNoTrans($item->children()->orderBy('name')->get(), $options, $space); 
                $space = '';           
            }
        }
        return $options;
    }
}

if(! function_exists('formatBytes')){
    
    function formatBytes($size, $precision = 2) { 
        $size = max(0, (int)$size);
        $units = array( 'b', 'Kb', 'Mb', 'Gb', 'Tb', 'Pb', 'Eb', 'Zb', 'Yb');
        $power = $size > 0 ? floor(log($size, 1024)) : 0;
        return number_format($size / pow(1024, $power), $precision, '.', ',') . $units[$power];
    } 
}

if(! function_exists('image_content')){
    
    function image_content($content){
        preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $content, $image);
        return isset($image['src'])? $image['src'] : 'http://placehold.it/340x200';
    }
}

if(! function_exists('gravatar')){

    function gravatar($email = '', $rating = 'pg') {
        $default = asset('images/man.png'); // Set a Default Avatar
        $email = md5(strtolower(trim($email)));
        $gravurl = "http://www.gravatar.com/avatar/$email?s=60&r=$rating";
        return $gravurl;
    }
}