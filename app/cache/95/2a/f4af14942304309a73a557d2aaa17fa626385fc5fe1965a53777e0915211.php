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
        echo "        <meta name=\"author\" content=\"pixelcave\">
        <meta name=\"robots\" content=\"noindex, nofollow\">

        <meta name=\"viewport\" content=\"width=device-width,initial-scale=1,maximum-scale=1.0\">

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel=\"shortcut icon\" href=\"";
        // line 23
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/proui/img/favicon.ico\">
        <link rel=\"apple-touch-icon\" href=\"";
        // line 24
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/proui/img/icon57.png\" sizes=\"57x57\">
        <link rel=\"apple-touch-icon\" href=\"";
        // line 25
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/proui/img/icon72.png\" sizes=\"72x72\">
        <link rel=\"apple-touch-icon\" href=\"";
        // line 26
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/proui/img/icon76.png\" sizes=\"76x76\">
        <link rel=\"apple-touch-icon\" href=\"";
        // line 27
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/proui/img/icon114.png\" sizes=\"114x114\">
        <link rel=\"apple-touch-icon\" href=\"";
        // line 28
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/proui/img/icon120.png\" sizes=\"120x120\">
        <link rel=\"apple-touch-icon\" href=\"";
        // line 29
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/proui/img/icon144.png\" sizes=\"144x144\">
        <link rel=\"apple-touch-icon\" href=\"";
        // line 30
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/proui/img/icon152.png\" sizes=\"152x152\">
        <!-- END Icons -->

        <!-- Stylesheets -->
        <!-- Bootstrap is included in its original form, unaltered -->
        <link rel=\"stylesheet\" href=\"";
        // line 35
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/proui/css/bootstrap.min.css\">

        <!-- Related styles of various icon packs and plugins -->
        <link rel=\"stylesheet\" href=\"";
        // line 38
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/proui/css/plugins.css\">

        <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
        <link rel=\"stylesheet\" href=\"";
        // line 41
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/proui/css/main.css\">

        <!-- The themes stylesheet of this template (for using specific theme color in individual elements - must included last) -->
        <link rel=\"stylesheet\" href=\"";
        // line 44
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/proui/css/themes.css\">
        <!-- END Stylesheets -->

        <!-- Modernizr (browser feature detection library) & Respond.js (Enable responsive CSS code on browsers that don't support it, eg IE8) -->
        <script src=\"";
        // line 48
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
                                <a href=\"docs\">Documentation</a>
                            </li>
                            <li>
                                <a href=\"javascript:void(0)\" class=\"site-nav-sub\"><i class=\"fa fa-angle-down site-nav-arrow\"></i>Pages</a>
                                <ul>
                                    <li>
                                        <a href=\"blog.html\">Blog</a>
                                    </li>
                                    <li>
                                        <a href=\"blog_post.html\">Blog Post</a>
                                    </li>
                                    <li>
                                        <a href=\"portfolio_4.html\">Portfolio 4 Columns</a>
                                    </li>
                                    <li>
                                        <a href=\"portfolio_3.html\">Portfolio 3 Columns</a>
                                    </li>
                                    <li>
                                        <a href=\"portfolio_2.html\">Portfolio 2 Columns</a>
                                    </li>
                                    <li>
                                        <a href=\"portfolio_single.html\">Portfolio Single</a>
                                    </li>
                                    <li>
                                        <a href=\"team.html\">Team</a>
                                    </li>
                                    <li>
                                        <a href=\"helpdesk.html\">Helpdesk</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href=\"features.html\">Features</a>
                            </li>
                            <li>
                                <a href=\"pricing.html\">Pricing</a>
                            </li>
                            <li>
                                <a href=\"contact.html\">Contact</a>
                            </li>
                            <li>
                                <a href=\"about.html\">About</a>
                            </li>
                        </ul>
                        <!-- END Main Menu -->
                    </nav>
                    <!-- END Site Navigation -->
                </div>
            </header>
            <!-- END Site Header -->

            <!-- Home Carousel -->
            <div id=\"home-carousel\" class=\"carousel carousel-home slide\" data-ride=\"carousel\" data-interval=\"5000\">
                <!-- Wrapper for slides -->
                <div class=\"carousel-inner\">
                    <div class=\"active item\">
                        <section class=\"site-section site-section-light site-section-top themed-background-default\">
                            <div class=\"container\">
                                <h1 class=\"text-center animation-slideDown hidden-xs\"><strong>A complete web solution for your awesome project</strong></h1>
                                <h2 class=\"text-center animation-slideUp push hidden-xs\">Bring your project to life months sooner</h2>
                                <p class=\"text-center animation-fadeIn\">
                                    <img src=\"";
        // line 144
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/proui/img/placeholders/screenshots/promo_desktop_left.png\" alt=\"Promo Image 1\">
                                </p>
                            </div>
                        </section>
                    </div>
                    <div class=\"item\">
                        <section class=\"site-section site-section-light site-section-top themed-background-fire\">
                            <div class=\"container\">
                                <h1 class=\"text-center animation-fadeIn360 hidden-xs\"><strong>Featuring a Powerful and Flexible layout</strong></h1>
                                <h2 class=\"text-center animation-fadeIn360 push hidden-xs\">Letting you focus on creating your project</h2>
                                <p class=\"text-center animation-fadeInLeft\">
                                    <img src=\"";
        // line 155
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/proui/img/placeholders/screenshots/promo_desktop_right.png\" alt=\"Promo Image 2\">
                                </p>
                            </div>
                        </section>
                    </div>
                    <div class=\"item\">
                        <section class=\"site-section site-section-light site-section-top themed-background-amethyst\">
                            <div class=\"container\">
                                <h1 class=\"text-center animation-hatch hidden-xs\"><strong>Fully Responsive and Retina Ready</strong></h1>
                                <h2 class=\"text-center animation-hatch push hidden-xs\">The UI will look great and crisp</h2>
                                <p class=\"text-center animation-hatch\">
                                    <img src=\"";
        // line 166
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/proui/img/placeholders/screenshots/promo_mobile.png\" alt=\"Promo Image 3\">
                                </p>
                            </div>
                        </section>
                    </div>
                    <div class=\"item\">
                        <section class=\"site-section site-section-light site-section-top themed-background-modern\">
                            <div class=\"container\">
                                <h1 class=\"text-center animation-fadeInLeft hidden-xs\"><strong>Tons of features are designed &amp; waiting for you</strong></h1>
                                <h2 class=\"text-center animation-fadeInRight push hidden-xs\">Everything you need for your project</h2>
                                <p class=\"text-center animation-fadeIn360\">
                                    <img src=\"";
        // line 177
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/proui/img/placeholders/screenshots/promo_tablet.png\" alt=\"Promo Image 4\">
                                </p>
                            </div>
                        </section>
                    </div>
                </div>
                <!-- END Wrapper for slides -->

                <!-- Controls -->
                <a class=\"left carousel-control\" href=\"#home-carousel\" data-slide=\"prev\">
                    <span>
                        <i class=\"fa fa-chevron-left\"></i>
                    </span>
                </a>
                <a class=\"right carousel-control\" href=\"#home-carousel\" data-slide=\"next\">
                    <span>
                        <i class=\"fa fa-chevron-right\"></i>
                    </span>
                </a>
                <!-- END Controls -->
            </div>
            <!-- END Home Carousel -->

            <!-- Action -->
            <section class=\"site-content site-section\">
                <div class=\"container\">
                    <div class=\"site-block text-center\">
                        <a href=\"http://goo.gl/TDOSuC\" class=\"btn btn-lg btn-success\"><i class=\"fa fa-shopping-cart\"></i> Purchase ProUI (\$20)</a>
                        <a href=\"http://pixelcave.com/demo/proui\" class=\"btn btn-lg btn-primary\"><i class=\"fa fa-share\"></i> Live Preview</a>
                    </div>
                    <hr>
                </div>
            </section>
            <!-- END Action -->

            <!-- Promo #1 -->
            <section class=\"site-content site-section site-slide-content\">
                <div class=\"container\">
                    <div class=\"row\">
                        <div class=\"col-sm-6 site-block visibility-none\" data-toggle=\"animation-appear\" data-animation-class=\"animation-fadeInRight\" data-element-offset=\"-180\">
                            <img src=\"";
        // line 217
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/proui/img/placeholders/screenshots/promo_desktop_left.png\" alt=\"Promo #1\" class=\"img-responsive\">
                        </div>
                        <div class=\"col-sm-6 col-md-5 col-md-offset-1 site-block visibility-none\" data-toggle=\"animation-appear\" data-animation-class=\"animation-fadeInLeft\" data-element-offset=\"-180\">
                            <h3 class=\"h2 site-heading site-heading-promo\"><strong>Clean and Modern</strong> Design</h3>
                            <p class=\"promo-content\">ProUI is a professional, modern and solid foundation for your next awesome project. It comes packed with great features that you will love. <a href=\"features.html\">Learn More..</a></p>
                        </div>
                    </div>
                    <hr>
                </div>
            </section>
            <!-- END Promo #1 -->

            <!-- Promo #2 -->
            <section class=\"site-content site-section site-slide-content\">
                <div class=\"container\">
                    <div class=\"row\">
                        <div class=\"col-sm-6 col-md-5 site-block visibility-none\" data-toggle=\"animation-appear\" data-animation-class=\"animation-fadeInRight\" data-element-offset=\"-180\">
                            <h3 class=\"h2 site-heading site-heading-promo\"><strong>Powerful</strong> Admin Template</h3>
                            <p class=\"promo-content\">ProUI has a powerful and flexible layout to meet every need. It comes packed with 9 awesome and fresh color themes that you will love, too. <a href=\"features.html\">Learn More..</a></p>
                        </div>
                        <div class=\"col-sm-6 col-md-offset-1 site-block visibility-none\" data-toggle=\"animation-appear\" data-animation-class=\"animation-fadeInLeft\" data-element-offset=\"-180\">
                            <img src=\"";
        // line 238
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/proui/img/placeholders/screenshots/promo_desktop_right.png\" alt=\"Promo #2\" class=\"img-responsive\">
                        </div>
                    </div>
                    <hr>
                </div>
            </section>
            <!-- END Promo #2 -->

            <!-- Promo #3 -->
            <section class=\"site-content site-section site-slide-content\">
                <div class=\"container\">
                    <div class=\"row\">
                        <div class=\"col-sm-6 site-block visibility-none\" data-toggle=\"animation-appear\" data-animation-class=\"animation-fadeInRight\" data-element-offset=\"-180\">
                            <img src=\"";
        // line 251
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/proui/img/placeholders/screenshots/promo_tablet.png\" alt=\"Promo #3\" class=\"img-responsive\">
                        </div>
                        <div class=\"col-sm-6 col-md-5 col-md-offset-1 site-block visibility-none\" data-toggle=\"animation-appear\" data-animation-class=\"animation-fadeInLeft\" data-element-offset=\"-180\">
                            <h3 class=\"h2 site-heading site-heading-promo\"><strong>Fully</strong> Responsive</h3>
                            <p class=\"promo-content\">The User Interface will just work in mobile phones, tablets, laptops and desktops. You can focus on creating the project you want. <a href=\"features.html\">Learn More..</a></p>
                        </div>
                    </div>
                    <hr>
                </div>
            </section>
            <!-- END Promo #3 -->

            <!-- Promo #4 -->
            <section class=\"site-content site-section site-slide-content\">
                <div class=\"container\">
                    <div class=\"row\">
                        <div class=\"col-sm-6 col-md-5 site-block visibility-none\" data-toggle=\"animation-appear\" data-animation-class=\"animation-fadeInRight\" data-element-offset=\"-180\">
                            <h3 class=\"h2 site-heading site-heading-promo\"><strong>Mobile</strong> First</h3>
                            <p class=\"promo-content\">The layout adjusts as we move up from mobile devices to large desktop screens and not the other way around. This speed things up a lot. <a href=\"features.html\">Learn More..</a></p>
                        </div>
                        <div class=\"col-sm-6 col-md-offset-1 site-block visibility-none\" data-toggle=\"animation-appear\" data-animation-class=\"animation-fadeInLeft\" data-element-offset=\"-180\">
                            <img src=\"";
        // line 272
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/proui/img/placeholders/screenshots/promo_mobile.png\" alt=\"Promo #4\" class=\"img-responsive\">
                        </div>
                    </div>
                    <hr>
                </div>
            </section>
            <!-- END Promo #4 -->

            <!-- Testimonials -->
            <section class=\"site-content site-section\">
                <div class=\"container\">
                    <!-- Testimonials Carousel -->
                    <div id=\"testimonials-carousel\" class=\"carousel slide carousel-html\" data-ride=\"carousel\" data-interval=\"4000\">
                        <!-- Indicators -->
                        <ol class=\"carousel-indicators\">
                            <li data-target=\"#testimonials-carousel\" data-slide-to=\"0\" class=\"active\"></li>
                            <li data-target=\"#testimonials-carousel\" data-slide-to=\"1\"></li>
                            <li data-target=\"#testimonials-carousel\" data-slide-to=\"2\"></li>
                        </ol>
                        <!-- END Indicators -->

                        <!-- Wrapper for slides -->
                        <div class=\"carousel-inner text-center\">
                            <div class=\"active item\">
                                <p>
                                    <img src=\"";
        // line 297
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/proui/img/placeholders/avatars/avatar12.jpg\" alt=\"Avatar\" class=\"img-circle\">
                                </p>
                                <blockquote class=\"no-symbol\">
                                    <p>An awesome team that brought our ideas to life! Highly recommended!</p>
                                    <footer><strong>Sophie Illich</strong>, example.com</footer>
                                </blockquote>
                            </div>
                            <div class=\"item\">
                                <p>
                                    <img src=\"";
        // line 306
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/proui/img/placeholders/avatars/avatar7.jpg\" alt=\"Avatar\" class=\"img-circle\">
                                </p>
                                <blockquote class=\"no-symbol\">
                                    <p>I have never imagined that our final product would look that good!</p>
                                    <footer><strong>David Cull</strong>, example.com</footer>
                                </blockquote>
                            </div>
                            <div class=\"item\">
                                <p>
                                    <img src=\"";
        // line 315
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/proui/img/placeholders/avatars/avatar9.jpg\" alt=\"Avatar\" class=\"img-circle\">
                                </p>
                                <blockquote class=\"no-symbol\">
                                    <p>An extraordinary service that helped us grow way too fast!</p>
                                    <footer><strong>Nathan Brown</strong>, example.com</footer>
                                </blockquote>
                            </div>
                        </div>
                        <!-- END Wrapper for slides -->
                    </div>
                    <!-- END Testimonials Carousel -->
                </div>
            </section>
            <!-- END Testimonials -->

            <!-- Sign Up Action -->
            <section class=\"site-content site-section site-section-light themed-background-dark-night\">
                <div class=\"container\">
                    <h3 class=\"site-heading text-center\"><strong>Sign Up Today</strong> and receive <strong>30% discount</strong>!</h3>
                    <div class=\"site-block text-center\">
                        <form action=\"features.html\" method=\"post\" class=\"form-horizontal\" onsubmit=\"return false;\">
                            <div class=\"form-group\">
                                <div class=\"col-md-6 col-md-offset-3\">
                                    <label class=\"sr-only\" for=\"register-email\">Your Email</label>
                                    <div class=\"input-group input-group-lg\">
                                        <input type=\"email\" id=\"register-email\" name=\"register-email\" class=\"form-control\" placeholder=\"Your Email..\">
                                        <div class=\"input-group-btn\">
                                            <button type=\"submit\" class=\"btn btn-primary\"><i class=\"fa fa-plus\"></i> Sign Up</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
            <!-- END Sign Up Action -->

            <!-- Quick Stats -->
            <section class=\"site-content site-section themed-background\">
                <div class=\"container\">
                    <!-- Stats Row -->
                    <!-- CountTo (initialized in js/app.js), for more examples you can check out https://github.com/mhuggins/jquery-countTo -->
                    <div class=\"row\" id=\"counters\">
                        <div class=\"col-sm-4\">
                            <div class=\"counter site-block\">
                                <span data-toggle=\"countTo\" data-to=\"6800\" data-after=\"+\"></span>
                                <small>Projects</small>
                            </div>
                        </div>
                        <div class=\"col-sm-4\">
                            <div class=\"counter site-block\">
                                <span data-toggle=\"countTo\" data-to=\"5500\" data-after=\"+\"></span>
                                <small>Happy Customers</small>
                            </div>
                        </div>
                        <div class=\"col-sm-4\">
                            <div class=\"counter site-block\">
                                <span data-toggle=\"countTo\" data-to=\"100\" data-after=\"+\"></span>
                                <small>New Accounts Today</small>
                            </div>
                        </div>
                    </div>
                    <!-- END Stats Row -->
                </div>
            </section>
            <!-- END Quick Stats -->

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
        // line 432
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/proui/js/vendor/jquery-1.11.1.min.js\"%3E%3C/script%3E'));</script>

        <!-- Bootstrap.js, Jquery plugins and Custom JS code -->
        <script src=\"";
        // line 435
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/proui/js/vendor/bootstrap.min.js\"></script>
        <script src=\"";
        // line 436
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/proui/js/plugins.js\"></script>
        <script src=\"";
        // line 437
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
        return array (  564 => 11,  558 => 9,  555 => 8,  552 => 7,  545 => 437,  541 => 436,  537 => 435,  531 => 432,  411 => 315,  399 => 306,  387 => 297,  359 => 272,  335 => 251,  319 => 238,  295 => 217,  252 => 177,  238 => 166,  224 => 155,  210 => 144,  111 => 48,  104 => 44,  98 => 41,  92 => 38,  86 => 35,  78 => 30,  74 => 29,  70 => 28,  66 => 27,  62 => 26,  58 => 25,  54 => 24,  50 => 23,  41 => 16,  35 => 14,  33 => 13,  30 => 12,  28 => 7,  20 => 1,);
    }
}