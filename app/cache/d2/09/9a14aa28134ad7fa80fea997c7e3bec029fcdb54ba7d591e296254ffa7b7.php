<?php

/* index.html */
class __TwigTemplate_d2099a14aa28134ad7fa80fea997c7e3bec029fcdb54ba7d591e296254ffa7b7 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        try {
            $this->parent = $this->env->loadTemplate("layout.html");
        } catch (Twig_Error_Loader $e) {
            $e->setTemplateFile($this->getTemplateName());
            $e->setTemplateLine(1);

            throw $e;
        }

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "layout.html";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        // line 4
        echo "    <!-- Intro -->
            <section class=\"site-section site-section-light site-section-top parallax-image\" style=\"background-image: url('";
        // line 5
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/proui/img/placeholders/parallax/photo1.jpg');\">
                <div class=\"container\">
                    <h1 class=\"text-center animation-slideDown hidden-xs\"><strong>A complete web solution for your awesome project</strong></h1>
                    <h2 class=\"text-center animation-slideUp push hidden-xs\">Bring your project to life months sooner</h2>
                </div>
                <div class=\"row\">
                    <div class=\"col-md-4 col-md-offset-4 text-center push\">
                        <img src=\"";
        // line 12
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/proui/img/placeholders/screenshots/promo_desktop_left.png\" alt=\"Promo\" class=\"img-responsive center-block animation-fadeIn\">
                    </div>
                </div>
                <div class=\"site-block text-center\">
                    <a href=\"http://goo.gl/TDOSuC\" class=\"btn btn-lg btn-success\"><i class=\"fa fa-shopping-cart\"></i> Purchase ProUI (\$20)</a>
                    <a href=\"http://pixelcave.com/demo/proui\" class=\"btn btn-lg btn-primary\"><i class=\"fa fa-share\"></i> Live Preview</a>
                </div>
            </section>
            <!-- END Intro -->

            <!-- Promo #1 -->
            <section class=\"site-content site-section site-slide-content\">
                <div class=\"container\">
                    <div class=\"row\">
                        <div class=\"col-sm-6 site-block visibility-none\" data-toggle=\"animation-appear\" data-animation-class=\"animation-fadeInRight\" data-element-offset=\"-180\">
                            <img src=\"";
        // line 27
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/proui/img/placeholders/screenshots/promo_desktop_left.png\" alt=\"Promo #1\" class=\"img-responsive\">
                        </div>
                        <div class=\"col-sm-6 col-md-5 col-md-offset-1 site-block visibility-none\" data-toggle=\"animation-appear\" data-animation-class=\"animation-fadeInLeft\" data-element-offset=\"-180\">
                            <h3 class=\"h2 site-heading site-heading-promo\"><strong>Clean and Modern</strong> Design</h3>
                            <p class=\"promo-content\">ProUI is a professional, modern and solid foundation for your next awesome project. It comes packed with great features that you will love. <a href=\"features.html\">Learn More..</a></p>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END Promo #1 -->

            <!-- Quick Stats -->
            <section class=\"site-content site-section parallax-image\" style=\"background-image: url('";
        // line 39
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/proui/img/placeholders/parallax/photo2.jpg');\">
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
        // line 77
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/proui/img/placeholders/screenshots/promo_desktop_right.png\" alt=\"Promo #2\" class=\"img-responsive\">
                        </div>
                    </div>
                </div>
            </section>
            <!-- END Promo #2 -->

            <!-- Testimonials -->
            <section class=\"site-content site-section site-section-light parallax-image\" style=\"background-image: url('";
        // line 85
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/proui/img/placeholders/parallax/photo3.jpg');\">
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
        // line 101
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/proui/img/placeholders/avatars/avatar12.jpg\" alt=\"Avatar\" class=\"img-circle\">
                                </p>
                                <blockquote class=\"no-symbol\">
                                    <p>An awesome team that brought our ideas to life! Highly recommended!</p>
                                    <footer class=\"label label-default\"><strong>Sophie Illich</strong>, example.com</footer>
                                </blockquote>
                            </div>
                            <div class=\"item\">
                                <p>
                                    <img src=\"";
        // line 110
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/proui/img/placeholders/avatars/avatar7.jpg\" alt=\"Avatar\" class=\"img-circle\">
                                </p>
                                <blockquote class=\"no-symbol\">
                                    <p>I have never imagined that our final product would look that good!</p>
                                    <footer class=\"label label-default\"><strong>David Cull</strong>, example.com</footer>
                                </blockquote>
                            </div>
                            <div class=\"item\">
                                <p>
                                    <img src=\"";
        // line 119
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/proui/img/placeholders/avatars/avatar9.jpg\" alt=\"Avatar\" class=\"img-circle\">
                                </p>
                                <blockquote class=\"no-symbol\">
                                    <p>An extraordinary service that helped us grow way too fast!</p>
                                    <footer class=\"label label-default\"><strong>Nathan Brown</strong>, example.com</footer>
                                </blockquote>
                            </div>
                        </div>
                        <!-- END Wrapper for slides -->
                    </div>
                    <!-- END Testimonials Carousel -->
                </div>
            </section>
            <!-- END Testimonials -->

            <!-- Promo #3 -->
            <section class=\"site-content site-section site-slide-content\">
                <div class=\"container\">
                    <div class=\"row\">
                        <div class=\"col-sm-6 site-block visibility-none\" data-toggle=\"animation-appear\" data-animation-class=\"animation-fadeInRight\" data-element-offset=\"-180\">
                            <img src=\"";
        // line 139
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/proui/img/placeholders/screenshots/promo_tablet.png\" alt=\"Promo #3\" class=\"img-responsive\">
                        </div>
                        <div class=\"col-sm-6 col-md-5 col-md-offset-1 site-block visibility-none\" data-toggle=\"animation-appear\" data-animation-class=\"animation-fadeInLeft\" data-element-offset=\"-180\">
                            <h3 class=\"h2 site-heading site-heading-promo\"><strong>Fully</strong> Responsive</h3>
                            <p class=\"promo-content\">The User Interface will just work in mobile phones, tablets, laptops and desktops. You can focus on creating the project you want. <a href=\"features.html\">Learn More..</a></p>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END Promo #3 -->

            <!-- Sign Up Action -->
            <section class=\"site-content site-section site-section-light parallax-image\" style=\"background-image: url('img/placeholders/parallax/photo4.jpg');\">
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
        // line 182
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/proui/img/placeholders/screenshots/promo_mobile.png\" alt=\"Promo #4\" class=\"img-responsive\">
                        </div>
                    </div>
                </div>
            </section>
            <!-- END Promo #4 -->
            
            
";
    }

    public function getTemplateName()
    {
        return "index.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  249 => 182,  203 => 139,  180 => 119,  168 => 110,  156 => 101,  137 => 85,  126 => 77,  85 => 39,  70 => 27,  52 => 12,  42 => 5,  39 => 4,  36 => 3,  11 => 1,);
    }
}
