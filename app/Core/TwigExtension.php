<?php
/**
 * Slim - a micro PHP 5 framework
 *
 * @author      Josh Lockhart
 * @author      Andrew Smith
 * @link        http://www.slimframework.com
 * @copyright   2013 Josh Lockhart
 * @version     0.1.3
 * @package     SlimViews
 *
 * MIT LICENSE
 *
 * Permission is hereby granted, free of charge, to any person obtaining
 * a copy of this software and associated documentation files (the
 * "Software"), to deal in the Software without restriction, including
 * without limitation the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to
 * the following conditions:
 *
 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
 * LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
 * OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
 * WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
namespace Minion\Core;

use Slim\Slim;
use Minion\Core\Gear;

class TwigExtension extends \Twig_Extension
{
    public function getName()
    {
        return 'slim';
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('urlFor', array($this, 'urlFor')),
            new \Twig_SimpleFunction('baseUrl', array($this, 'base')),
            new \Twig_SimpleFunction('siteUrl', array($this, 'site')),
            new \Twig_SimpleFunction('currentUrl', array($this, 'currentUrl')),
            new \Twig_SimpleFunction('navigation', array($this, 'navigation')),
            new \Twig_SimpleFunction('renderNav', array($this, 'renderNav')),
        );
    }

    public function urlFor($name, $params = array(), $appName = 'default')
    {
        return Slim::getInstance($appName)->urlFor($name, $params);
    }

    public function site($url, $withUri = true, $appName = 'default')
    {
        return $this->base($withUri, $appName) . '/' . ltrim($url, '/');
    }

    public function base($withUri = true, $appName = 'default')
    {
        $req = Slim::getInstance($appName)->request();
        $uri = $req->getUrl();

        if ($withUri) {
            $uri .= $req->getRootUri();
        }
        return $uri;
    }

    public function currentUrl($withQueryString = true, $appName = 'default')
    {
        $app = Slim::getInstance($appName);
        $req = $app->request();
        $uri = $req->getUrl() . $req->getPath();

        if ($withQueryString) {
            $env = $app->environment();

            if ($env['QUERY_STRING']) {
                $uri .= '?' . $env['QUERY_STRING'];
            }
        }

        return $uri;
    }

    /**
     * navigation.
     *
     * @return
     */
    public function navigation($folder = null)
    {
        $gear = new Gear;
        $menus = $gear->navigation();

        if(!is_null($folder))
        {
            $array = array_where($menus, function($key, $value) use ($folder) {
                if($key === $folder) return $value;
            });
        }else{
            $array = $menus;
        }
        return $array;
    }

    /**
     * render nav.
     *
     * @return
     */
    public function navToHTML($array, $top = true, $folder = null)
    {
        if ($top) {
            $html = '';
        } else {
            $html = '<ul class="fa-ul ul-breath">';
        }

        foreach ($array as $key => $value) {

            if (!is_int($key)) {
                if($key === $folder){
                    $html .= $this->navToHTML($value, false) ;
                }else{
                    if (preg_match('/^\d+\-/', $key)) {
                        list($index, $path) = explode('-', $key, 2);
                        $key = $path;
                    }
                   
                    $title = ucwords(str_replace(['-', '_'], ' ', basename($key)));
                    $html .= '<h4 class="site-heading"><strong>' . $title . '</strong></h4>' . $this->navToHTML($value, false) . '</h4>';
                }
               
            } else {
                $html .= '<li class="nav-item-' . $this->slugify($value['title']) . ($value['active'] ? ' baun-nav-active' : '') . '">';
                $html .= '<a href="' . ($value['url'] == '/' ? $value['url'] : '/' . $value['url']) . '">' . $value['title'] . '</a>';
                $html .= '</li>';
            }
        }

        $html .= '</ul>';
        return $html;
    }

    /**
     * .
     *
     * @return
     */
    public function renderNav($folder = null)
    {
        $menus = $this->navigation($folder);
        
        return $this->navToHTML($menus, true, $folder);
    }

    private function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
        // trim
        $text = trim($text, '-');
        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        // lowercase
        $text = strtolower($text);
        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
}
