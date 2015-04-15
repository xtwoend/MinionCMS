<?php

/* layout.html */
class __TwigTemplate_952af4af14942304309a73a557d2aaa17fa626385fc5fe1965a53777e0915211 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<!--[if IE 8]>         <html class=\"no-js lt-ie9\"> <![endif]-->
<!--[if gt IE 8]><!--> <html class=\"no-js\"> <!--<![endif]-->
    <head>
        <meta charset=\"utf-8\">

        <title>";
        // line 7
        $this->displayBlock('title', $context, $blocks);
        // line 12
        echo "</title>
        ";
        // line 13
        if ($this->getAttribute((isset($context["info"]) ? $context["info"] : null), "description", array())) {
            // line 14
            echo "        <meta name=\"description\" content=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["info"]) ? $context["info"] : null), "description", array()), "html", null, true);
            echo "\">
        ";
        }
        // line 16
        echo "        ";
        if ($this->getAttribute((isset($context["info"]) ? $context["info"] : null), "description", array())) {
            // line 17
            echo "        <meta name=\"keywords\" content=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["info"]) ? $context["info"] : null), "keywords", array()), "html", null, true);
            echo "\">
        ";
        }
        // line 19
        echo "        <meta name=\"author\" content=\"pixelcave\">
        <meta name=\"robots\" content=\"noindex, nofollow\">

        <meta name=\"viewport\" content=\"width=device-width,initial-scale=1,maximum-scale=1.0\">

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel=\"shortcut icon\" href=\"";
        // line 26
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/proui/img/favicon.ico\">
        <link rel=\"apple-touch-icon\" href=\"";
        // line 27
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/proui/img/icon57.png\" sizes=\"57x57\">
        <link rel=\"apple-touch-icon\" href=\"";
        // line 28
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/proui/img/icon72.png\" sizes=\"72x72\">
        <link rel=\"apple-touch-icon\" href=\"";
        // line 29
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/proui/img/icon76.png\" sizes=\"76x76\">
        <link rel=\"apple-touch-icon\" href=\"";
        // line 30
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/proui/img/icon114.png\" sizes=\"114x114\">
        <link rel=\"apple-touch-icon\" href=\"";
        // line 31
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/proui/img/icon120.png\" sizes=\"120x120\">
        <link rel=\"apple-touch-icon\" href=\"";
        // line 32
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/proui/img/icon144.png\" sizes=\"144x144\">
        <link rel=\"apple-touch-icon\" href=\"";
        // line 33
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/proui/img/icon152.png\" sizes=\"152x152\">
        <!-- END Icons -->

        <!-- Stylesheets -->
        <!-- Bootstrap is included in its original form, unaltered -->
        <link rel=\"stylesheet\" href=\"";
        // line 38
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/proui/css/bootstrap.min.css\">

        <!-- Related styles of various icon packs and plugins -->
        <link rel=\"stylesheet\" href=\"";
        // line 41
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/proui/css/plugins.css\">

        <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
        <link rel=\"stylesheet\" href=\"";
        // line 44
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/proui/css/main.css\">

        <!-- The themes stylesheet of this template (for using specific theme color in individual elements - must included last) -->
        <link rel=\"stylesheet\" href=\"";
        // line 47
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/proui/css/themes.css\">
        <!-- END Stylesheets -->

        <!-- Modernizr (browser feature detection library) & Respond.js (Enable responsive CSS code on browsers that don't support it, eg IE8) -->
        <script src=\"";
        // line 51
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/proui/js/vendor/modernizr-2.7.1-respond-1.4.2.min.js\"></script>
    </head>
    <body>
        <!-- Page Container -->
        <!-- In the PHP version you can set the following options from inc/config file -->
        <!-- 'boxed' class for a boxed layout -->
        <div id=\"page-container\">
            <!-- Site Header -->
            <header>
                <div class=\"container\">
                    <!-- Site Logo -->
                    <a href=\"index.html\" class=\"site-logo\">
                        <i class=\"gi gi-flash\"></i> <strong>Minion</strong>CMS
                    </a>
                    <!-- Site Logo -->

                    <!-- Site Navigation -->
                    <nav>
                        <!-- Menu Toggle -->
                        <!-- Toggles menu on small screens -->
                        <a href=\"javascript:void(0)\" class=\"btn btn-default site-menu-toggle visible-xs visible-sm\">
                            <i class=\"fa fa-bars\"></i>
                        </a>
                        <!-- END Menu Toggle -->

                        <!-- Main Menu -->
                        <ul class=\"site-nav\">
                            <!-- Toggles menu on small screens -->
                            <li class=\"visible-xs visible-sm\">
                                <a href=\"javascript:void(0)\" class=\"site-menu-toggle text-center\">
                                    <i class=\"fa fa-times\"></i>
                                </a>
                            </li>
                            <!-- END Menu Toggle -->
                            
                            <li>
                                <a href=\"";
        // line 87
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->site("docs"), "html", null, true);
        echo "\">Documentation</a>
                            </li>
                            <li>
                                <a href=\"https://github.com/xtwoend/MinionCMS\">Download</a>
                            </li>
                            <li>
                                <a href=\"";
        // line 93
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->site("blog"), "html", null, true);
        echo "\">Blog</a>
                            </li>
                            <li>
                                <a href=\"https://github.com/xtwoend/MinionCMS\">Github</a>
                            </li>
                        </ul>
                        <!-- END Main Menu -->
                    </nav>
                    <!-- END Site Navigation -->
                </div>
            </header>
            <!-- END Site Header -->
            ";
        // line 105
        $this->displayBlock('content', $context, $blocks);
        // line 106
        echo "
            <!-- Footer -->
            <footer class=\"site-footer site-section\">
                <div class=\"container\">
                    <!-- Footer Links -->
                    <div class=\"row\">
                        <div class=\"col-sm-6 col-md-3\">
                            <h4 class=\"footer-heading\">About Us</h4>
                            <ul class=\"footer-nav list-inline\">
                                <li><a href=\"about.html\">Company</a></li>
                                <li><a href=\"contact.html\">Contact</a></li>
                                <li><a href=\"contact.html\">Support</a></li>
                            </ul>
                        </div>
                        <div class=\"col-sm-6 col-md-3\">
                            <h4 class=\"footer-heading\">Legal</h4>
                            <ul class=\"footer-nav list-inline\">
                                <li><a href=\"javascript:void(0)\">Licensing</a></li>
                                <li><a href=\"javascript:void(0)\">Privacy Policy</a></li>
                            </ul>
                        </div>
                        <div class=\"col-sm-6 col-md-3\">
                            <h4 class=\"footer-heading\">Follow Us</h4>
                            <ul class=\"footer-nav footer-nav-social list-inline\">
                                <li><a href=\"javascript:void(0)\"><i class=\"fa fa-facebook\"></i></a></li>
                                <li><a href=\"javascript:void(0)\"><i class=\"fa fa-twitter\"></i></a></li>
                                <li><a href=\"javascript:void(0)\"><i class=\"fa fa-google-plus\"></i></a></li>
                                <li><a href=\"javascript:void(0)\"><i class=\"fa fa-dribbble\"></i></a></li>
                                <li><a href=\"javascript:void(0)\"><i class=\"fa fa-rss\"></i></a></li>
                            </ul>
                        </div>
                        <div class=\"col-sm-6 col-md-3\">
                            <h4 class=\"footer-heading\"><span id=\"year-copy\">2014</span> &copy; <a href=\"http://goo.gl/TDOSuC\">ProUI Frontend</a></h4>
                            <ul class=\"footer-nav list-inline\">
                                <li>Crafted with <i class=\"fa fa-heart text-danger\"></i> by <a href=\"http://goo.gl/vNS3I\">pixelcave</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- END Footer Links -->
                </div>
            </footer>
            <!-- END Footer -->
        </div>
        <!-- END Page Container -->

        <!-- Scroll to top link, initialized in js/app.js - scrollToTop() -->
        <a href=\"#\" id=\"to-top\"><i class=\"fa fa-angle-up\"></i></a>

        <!-- Include Jquery library from Google's CDN but if something goes wrong get Jquery from local file (Remove 'http:' if you have SSL) -->
        <script src=\"http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js\"></script>
        <script>!window.jQuery && document.write(decodeURI('%3Cscript src=\"";
        // line 156
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/proui/js/vendor/jquery-1.11.1.min.js\"%3E%3C/script%3E'));</script>

        <!-- Bootstrap.js, Jquery plugins and Custom JS code -->
        <script src=\"";
        // line 159
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/proui/js/vendor/bootstrap.min.js\"></script>
        <script src=\"";
        // line 160
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/proui/js/plugins.js\"></script>
        <script src=\"";
        // line 161
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/proui/js/app.js\"></script>
    </body>
</html>";
    }

    // line 7
    public function block_title($context, array $blocks = array())
    {
        // line 8
        echo "            ";
        if ($this->getAttribute((isset($context["info"]) ? $context["info"] : null), "title", array())) {
            // line 9
            echo "                ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["info"]) ? $context["info"] : null), "title", array()), "html", null, true);
            echo " -
            ";
        }
        // line 11
        echo "            Minion CMS
        ";
    }

    // line 105
    public function block_content($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "layout.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  276 => 105,  271 => 11,  265 => 9,  262 => 8,  259 => 7,  252 => 161,  248 => 160,  244 => 159,  238 => 156,  186 => 106,  184 => 105,  169 => 93,  160 => 87,  121 => 51,  114 => 47,  108 => 44,  102 => 41,  96 => 38,  88 => 33,  84 => 32,  80 => 31,  76 => 30,  72 => 29,  68 => 28,  64 => 27,  60 => 26,  51 => 19,  45 => 17,  42 => 16,  36 => 14,  34 => 13,  31 => 12,  29 => 7,  21 => 1,);
    }
}
