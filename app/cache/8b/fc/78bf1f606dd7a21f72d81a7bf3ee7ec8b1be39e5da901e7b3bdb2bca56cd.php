<?php

/* blog.html */
class __TwigTemplate_8bfc78bf1f606dd7a21f72d81a7bf3ee7ec8b1be39e5da901e7b3bdb2bca56cd extends Twig_Template
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
        echo "
<!-- Intro -->
            <section class=\"site-section site-section-light site-section-top themed-background-dark\">
                <div class=\"container\">
                    <h1 class=\"animation-slideDown\"><strong>Latest News</strong></h1>
                    <h2 class=\"h3 animation-slideUp\">Learn about our progress and offers!</h2>
                </div>
            </section>
            <!-- END Intro -->

<!-- Content -->
            <section class=\"site-content site-section\">
                <div class=\"container\">
                    <div class=\"row\">
                        <!-- Posts -->
                        
                        <div class=\"col-sm-8 col-md-9\">
                            ";
        // line 21
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["posts"]) ? $context["posts"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["post"]) {
            // line 22
            echo "                            <!-- Blog Post -->
                            <div class=\"site-block\">
                                <div class=\"row\">
                                    <div class=\"col-md-4\">
                                        <p>
                                            <a href=\"blog_post.html\">
                                                <img src=\"img/placeholders/photos/photo1.jpg\" alt=\"image\" class=\"img-responsive\">
                                            </a>
                                        </p>
                                    </div>
                                    <div class=\"col-md-8\">
                                        <h3 class=\"site-heading\"><strong>";
            // line 33
            echo twig_escape_filter($this->env, $this->getAttribute($context["post"], "title", array()), "html", null, true);
            echo "</strong></h3>
                                        ";
            // line 34
            if ($this->getAttribute($context["post"], "excerpt", array())) {
                // line 35
                echo "                                        ";
                echo twig_escape_filter($this->env, $this->getAttribute($context["post"], "excerpt", array()), "html", null, true);
                echo "
                                    \t";
            }
            // line 37
            echo "                                    </div>
                                </div>
                                <div class=\"clearfix\">
                                    <p class=\"pull-right\">
                                        <a href=\"";
            // line 41
            echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
            echo "/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["post"], "route", array()), "html", null, true);
            echo "\" class=\"label label-primary\">Read more..</a>
                                    </p>
                                    <ul class=\"list-inline pull-left\">
                                        <li><i class=\"fa fa-calendar\"></i> ";
            // line 44
            echo twig_escape_filter($this->env, $this->getAttribute($context["post"], "published", array()), "html", null, true);
            echo "</li>
                                    </ul>
                                </div>
                            </div>
                            <!-- END Blog Post -->

                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['post'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 51
        echo "
                            <!-- Pagination -->
                            <div class=\"text-right\">
                                <ul class=\"pagination\">
                                    <li><a href=\"javascript:void(0)\"><i class=\"fa fa-angle-left\"></i></a></li>
                                    <li class=\"active\"><a href=\"javascript:void(0)\">1</a></li>
                                    <li><a href=\"javascript:void(0)\">2</a></li>
                                    <li><a href=\"javascript:void(0)\">3</a></li>
                                    <li><a href=\"javascript:void(0)\">4</a></li>
                                    <li><a href=\"javascript:void(0)\"><i class=\"fa fa-angle-right\"></i></a></li>
                                </ul>
                            </div>
                            <!-- END Pagination -->
                        </div>
                        <!-- END Posts -->

                        <!-- Sidebar -->
                        <div class=\"col-sm-4 col-md-3\">
                            <aside class=\"sidebar site-block\">
                                <!-- Search -->
                                <div class=\"sidebar-block\">
                                    <form action=\"blog.html\" method=\"post\" onsubmit=\"return false;\">
                                        <div class=\"input-group\">
                                            <input type=\"text\" id=\"search-term\" name=\"searh-term\" class=\"form-control\" placeholder=\"Search..\">
                                            <div class=\"input-group-btn\">
                                                <button type=\"submit\" class=\"btn btn-primary\"><i class=\"fa fa-search\"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- END Search -->

                                <!-- Categories -->
                                <div class=\"sidebar-block\">
                                    <h4 class=\"site-heading\"><strong>News</strong> Categories</h4>
                                    <ul class=\"fa-ul ul-breath\">
                                        <li><i class=\"fa fa-angle-right fa-li\"></i> <a href=\"javascript:void(0)\">Updates</a></li>
                                        <li><i class=\"fa fa-angle-right fa-li\"></i> <a href=\"javascript:void(0)\">Special Offers</a></li>
                                        <li><i class=\"fa fa-angle-right fa-li\"></i> <a href=\"javascript:void(0)\">Products</a></li>
                                        <li><i class=\"fa fa-angle-right fa-li\"></i> <a href=\"javascript:void(0)\">Features</a></li>
                                        <li><i class=\"fa fa-angle-right fa-li\"></i> <a href=\"javascript:void(0)\">Articles</a></li>
                                        <li><i class=\"fa fa-angle-right fa-li\"></i> <a href=\"javascript:void(0)\">Tutorials</a></li>
                                        <li><i class=\"fa fa-angle-right fa-li\"></i> <a href=\"javascript:void(0)\">Guides</a></li>
                                    </ul>
                                </div>
                                <!-- END Categories -->

                                <!-- Popular and Recent -->
                                <div class=\"sidebar-block\">
                                    <h4 class=\"site-heading\"><strong>Best</strong> Articles</h4>
                                    <ul class=\"nav nav-tabs push-bit\" data-toggle=\"tabs\">
                                        <li class=\"active\"><a href=\"#posts-popular\"><i class=\"fa fa-trophy\"></i> Popular</a></li>
                                        <li><a href=\"#posts-recent\"><i class=\"fa fa-clock-o\"></i> Recent</a></li>
                                    </ul>
                                    <div class=\"tab-content\">
                                        <div class=\"tab-pane active\" id=\"posts-popular\">
                                            <div class=\"content-float clearfix\">
                                                <img src=\"img/placeholders/avatars/avatar12.jpg\" alt=\"Avatar\" class=\"img-circle pull-left\">
                                                <h5><a href=\"javascript:void(0)\"><strong>How to be more productive</strong></a></h5>
                                                <small class=\"text-muted\">1 year ago</small>
                                            </div>
                                            <div class=\"content-float clearfix\">
                                                <img src=\"img/placeholders/avatars/avatar2.jpg\" alt=\"Avatar\" class=\"img-circle pull-left\">
                                                <h5><a href=\"javascript:void(0)\"><strong>CSS3 &amp; HTML5 Tutorial</strong></a></h5>
                                                <small class=\"text-muted\">6 days ago</small>
                                            </div>
                                            <div class=\"content-float clearfix\">
                                                <img src=\"img/placeholders/avatars/avatar3.jpg\" alt=\"Avatar\" class=\"img-circle pull-left\">
                                                <h5><a href=\"javascript:void(0)\"><strong>How to push your company forward</strong></a></h5>
                                                <small class=\"text-muted\">15 days ago</small>
                                            </div>
                                            <div class=\"content-float clearfix\">
                                                <img src=\"img/placeholders/avatars/avatar1.jpg\" alt=\"Avatar\" class=\"img-circle pull-left\">
                                                <h5><a href=\"javascript:void(0)\"><strong>How to stop procrastination</strong></a></h5>
                                                <small class=\"text-muted\">2 years ago</small>
                                            </div>
                                            <div class=\"content-float clearfix\">
                                                <img src=\"img/placeholders/avatars/avatar11.jpg\" alt=\"Avatar\" class=\"img-circle pull-left\">
                                                <h5><a href=\"javascript:void(0)\"><strong>New updates and more!</strong></a></h5>
                                                <small class=\"text-muted\">1 month ago</small>
                                            </div>
                                            <div class=\"text-right\">
                                                <a href=\"javascript:void(0)\" class=\"label label-primary\">Read More..</a>
                                            </div>
                                        </div>
                                        <div class=\"tab-pane\" id=\"posts-recent\">
                                            <div class=\"content-float clearfix\">
                                                <img src=\"img/placeholders/avatars/avatar6.jpg\" alt=\"Avatar\" class=\"img-circle pull-left\">
                                                <h5><a href=\"javascript:void(0)\"><strong>How to push your company forward</strong></a></h5>
                                                <small class=\"text-muted\">1 day ago</small>
                                            </div>
                                            <div class=\"content-float clearfix\">
                                                <img src=\"img/placeholders/avatars/avatar4.jpg\" alt=\"Avatar\" class=\"img-circle pull-left\">
                                                <h5><a href=\"javascript:void(0)\"><strong>New updates and more!</strong></a></h5>
                                                <small class=\"text-muted\">1 week ago</small>
                                            </div>
                                            <div class=\"content-float clearfix\">
                                                <img src=\"img/placeholders/avatars/avatar16.jpg\" alt=\"Avatar\" class=\"img-circle pull-left\">
                                                <h5><a href=\"javascript:void(0)\"><strong>How to be more productive</strong></a></h5>
                                                <small class=\"text-muted\">2 weeks ago</small>
                                            </div>
                                            <div class=\"content-float clearfix\">
                                                <img src=\"img/placeholders/avatars/avatar9.jpg\" alt=\"Avatar\" class=\"img-circle pull-left\">
                                                <h5><a href=\"javascript:void(0)\"><strong>CSS3 &amp; HTML5 Tutorial</strong></a></h5>
                                                <small class=\"text-muted\">1 month ago</small>
                                            </div>
                                            <div class=\"content-float clearfix\">
                                                <img src=\"img/placeholders/avatars/avatar5.jpg\" alt=\"Avatar\" class=\"img-circle pull-left\">
                                                <h5><a href=\"javascript:void(0)\"><strong>How to stop procrastination</strong></a></h5>
                                                <small class=\"text-muted\">2 months ago</small>
                                            </div>
                                            <div class=\"text-right\">
                                                <a href=\"javascript:void(0)\" class=\"label label-primary\">Read More..</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END Popular and Recent -->

                                <!-- About -->
                                <div class=\"sidebar-block\">
                                    <h4 class=\"site-heading\"><strong>About</strong> Us</h4>
                                    <p>Etiam egestas fringilla enim, id convallis lectus laoreet at. Fusce purus nisi, gravida sed consectetur ut, interdum quis nisi. Quisque egestas nisl id lectus facilisis scelerisque? Proin rhoncus dui at ligula vestibulum ut facilisis ante sodales! Suspendisse potenti. Aliquam tincidunt sollicitudin sem nec ultrices.</p>
                                </div>
                                <!-- END About -->
                            </aside>
                        </div>
                        <!-- END Sidebar -->
                    </div>
                </div>
            </section>
            <!-- END Content -->

";
    }

    public function getTemplateName()
    {
        return "blog.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  114 => 51,  101 => 44,  93 => 41,  87 => 37,  81 => 35,  79 => 34,  75 => 33,  62 => 22,  58 => 21,  39 => 4,  36 => 3,  11 => 1,);
    }
}
