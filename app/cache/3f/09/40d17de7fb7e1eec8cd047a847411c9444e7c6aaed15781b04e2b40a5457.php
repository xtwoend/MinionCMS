<?php

/* post.html */
class __TwigTemplate_3f0940d17de7fb7e1eec8cd047a847411c9444e7c6aaed15781b04e2b40a5457 extends Twig_Template
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
        echo "<!-- Media Container -->
            <div class=\"media-container\">
                <!-- Intro -->
                <section class=\"site-section site-section-light site-section-top\">
                    <div class=\"container\">
                        <a href=\"javascript:void(0)\">
                            <img src=\"img/placeholders/avatars/avatar2.jpg\" alt=\"Author\" class=\"site-top-avatar pull-right img-circle animation-fadeIn360\">
                        </a>
                        <h1 class=\"animation-slideDown\"><strong>";
        // line 12
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["info"]) ? $context["info"] : null), "title", array()), "html", null, true);
        echo "</strong></h1>
                        <h2 class=\"h3 animation-slideUp hidden-xs\">";
        // line 13
        echo twig_escape_filter($this->env, (isset($context["published"]) ? $context["published"] : null), "html", null, true);
        echo "</h2>
                    </div>
                </section>
                <!-- END Intro -->

                <!-- For best results use an image with a resolution of 2560x279 pixels -->
                <img src=\"img/placeholders/headers/blog_post.jpg\" alt=\"Image\" class=\"media-image animation-pulseSlow\">
            </div>
            <!-- END Media Container -->

            <!-- Article -->
            <section class=\"site-content site-section\">
                <div class=\"container\">
                    <div class=\"row\">
                        <div class=\"col-md-10 col-md-offset-1 site-block\">
                            <!-- Story -->
                            <article>
                                ";
        // line 30
        echo (isset($context["content"]) ? $context["content"] : null);
        echo "
                            </article>
                            <!-- END Story -->
                        </div>
                    </div>
                    <hr>
                </div>
            </section>
            <!-- END Article -->

            <!-- Extra Info -->
            <section class=\"site-content site-section\">
                <div class=\"container\">
                    <div class=\"row\">
                        <div class=\"col-md-5 col-md-offset-1 site-block\">
                            <h3 class=\"site-heading\"><strong>About</strong> the Author</h3>
                            <ul class=\"media-list\">
                                <li class=\"media\">
                                    <a href=\"javascript:void(0)\" class=\"pull-left\">
                                        <img src=\"img/placeholders/avatars/avatar2.jpg\" alt=\"avatar\" class=\"img-circle\">
                                    </a>
                                    <div class=\"media-body\">
                                        <a href=\"javascript:void(0)\"><strong>John</strong> Doe</a>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices, justo vel imperdiet gravida, urna ligula hendrerit nibh, ac cursus nibh sapien in purus. Mauris tincidunt tincidunt turpis in porta.</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class=\"col-md-5 site-block\">
                            <h3 class=\"site-heading\"><strong>Read</strong> More</h3>
                            <ul class=\"fa-ul ul-breath\">
                                <li><i class=\"fa fa-angle-right fa-li\"></i> <a href=\"javascript:void(0)\">Best trip of my life</a></li>
                                <li><i class=\"fa fa-angle-right fa-li\"></i> <a href=\"javascript:void(0)\">Travelling by train across the country</a></li>
                                <li><i class=\"fa fa-angle-right fa-li\"></i> <a href=\"javascript:void(0)\">My next big trip</a></li>
                                <li><i class=\"fa fa-angle-right fa-li\"></i> <a href=\"javascript:void(0)\">I would like to travel more</a></li>
                            </ul>
                        </div>
                    </div>
                    <hr>
                </div>
            </section>
            <!-- END Extra Info -->

            <!-- Comments -->
            <section class=\"site-content site-section\">
                <div class=\"container\">
                    <div class=\"row\">
                        <div class=\"col-md-10 col-md-offset-1 site-block\">
                            <h3 class=\"site-heading\"><strong>User</strong> Comments</h3>
                            <ul class=\"media-list\">
                                <li class=\"media\">
                                    <a href=\"javascript:void(0)\" class=\"pull-left\">
                                        <img src=\"img/placeholders/avatars/avatar12.jpg\" alt=\"Avatar\" class=\"img-circle\">
                                    </a>
                                    <div class=\"media-body\">
                                        <span class=\"text-muted pull-right\"><small><em>1 min ago</em></small></span>
                                        <a href=\"javascript:void(0)\"><strong>Ella Parker</strong></a>
                                        <p>Donec lacinia venenatis metus at bibendum? In hac habitasse platea dictumst. Proin ac nibh rutrum lectus rhoncus eleifend. Sed porttitor pretium venenatis. Suspendisse potenti. Aliquam quis ligula elit. Aliquam at orci ac neque semper dictum. Sed tincidunt scelerisque ligula, et facilisis nulla hendrerit non. Suspendisse potenti. Pellentesque non accumsan orci. Praesent at lacinia dolor. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    </div>
                                </li>
                                <li class=\"media\">
                                    <a href=\"javascript:void(0)\" class=\"pull-left\">
                                        <img src=\"img/placeholders/avatars/avatar8.jpg\" alt=\"Avatar\" class=\"img-circle\">
                                    </a>
                                    <div class=\"media-body\">
                                        <span class=\"text-muted pull-right\"><small><em>10 min ago</em></small></span>
                                        <a href=\"javascript:void(0)\"><strong>Brian Sims</strong></a>
                                        <p>Donec lacinia venenatis metus at bibendum? In hac habitasse platea dictumst. Proin ac nibh rutrum lectus rhoncus eleifend. Sed porttitor pretium venenatis. Suspendisse potenti. Aliquam quis ligula elit. Aliquam at orci ac neque semper dictum. Sed tincidunt scelerisque ligula, et facilisis nulla hendrerit non. Suspendisse potenti. Pellentesque non accumsan orci. Praesent at lacinia dolor. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    </div>
                                </li>
                                <li class=\"media\">
                                    <a href=\"javascript:void(0)\" class=\"pull-left\">
                                        <img src=\"img/placeholders/avatars/avatar15.jpg\" alt=\"Avatar\" class=\"img-circle\">
                                    </a>
                                    <div class=\"media-body\">
                                        <span class=\"text-muted pull-right\"><small><em>30 min ago</em></small></span>
                                        <a href=\"javascript:void(0)\"><strong>Peter Driessen</strong></a>
                                        <p>Donec lacinia venenatis metus at bibendum? In hac habitasse platea dictumst. Proin ac nibh rutrum lectus rhoncus eleifend. Sed porttitor pretium venenatis. Suspendisse potenti. Aliquam quis ligula elit. Aliquam at orci ac neque semper dictum. Sed tincidunt scelerisque ligula, et facilisis nulla hendrerit non. Suspendisse potenti. Pellentesque non accumsan orci. Praesent at lacinia dolor. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    </div>
                                </li>
                                <li class=\"media\">
                                    <a href=\"javascript:void(0)\" class=\"pull-left\">
                                        <img src=\"img/placeholders/avatars/avatar.jpg\" alt=\"Avatar\" class=\"img-circle\">
                                    </a>
                                    <div class=\"media-body\">
                                        <form action=\"blog_post.html\" method=\"post\" onsubmit=\"return false;\">
                                            <textarea id=\"article-comment\" name=\"article-comment\" class=\"form-control\" rows=\"4\" placeholder=\"Enter you comment..\"></textarea>
                                            <button type=\"submit\" class=\"btn btn-primary\"><i class=\"fa fa-pencil\"></i> Post</button>
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END Comments -->

";
    }

    public function getTemplateName()
    {
        return "post.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  73 => 30,  53 => 13,  49 => 12,  39 => 4,  36 => 3,  11 => 1,);
    }
}
