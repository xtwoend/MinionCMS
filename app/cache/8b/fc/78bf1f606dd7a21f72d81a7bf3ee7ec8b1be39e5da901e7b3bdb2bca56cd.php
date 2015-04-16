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
                        
                        <div class=\"col-sm-12 col-md-12\">
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
                                            <a href=\"\">
                                                <img src=\"";
            // line 28
            echo twig_escape_filter($this->env, $this->getAttribute($context["post"], "image", array()), "html", null, true);
            echo "\" alt=\"image\" class=\"img-responsive\">
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
                           
                            ";
        // line 54
        if (($this->getAttribute((isset($context["pagination"]) ? $context["pagination"] : null), "total_pages", array()) > 1)) {
            // line 55
            echo "                                <div class=\"text-right\">
                                    <ul class=\"pagination\">
                                        ";
            // line 57
            if (($this->getAttribute((isset($context["pagination"]) ? $context["pagination"] : null), "current_page", array()) > 1)) {
                // line 58
                echo "                                            <li><a href=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["pagination"]) ? $context["pagination"] : null), "base_url", array()), "html", null, true);
                echo "?page=";
                echo twig_escape_filter($this->env, ($this->getAttribute((isset($context["pagination"]) ? $context["pagination"] : null), "current_page", array()) - 1), "html", null, true);
                echo "\" class=\"prev\"><i class=\"fa fa-angle-left\"></i></a></li>
                                        ";
            }
            // line 60
            echo "                                        ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable(range(1, $this->getAttribute((isset($context["pagination"]) ? $context["pagination"] : null), "total_pages", array())));
            foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                // line 61
                echo "                                            ";
                if (($context["i"] == $this->getAttribute((isset($context["pagination"]) ? $context["pagination"] : null), "current_page", array()))) {
                    // line 62
                    echo "                                                <li class=\"active\"><a class=\"current-page\">";
                    echo twig_escape_filter($this->env, $context["i"], "html", null, true);
                    echo "</a></li>
                                            ";
                } else {
                    // line 64
                    echo "                                                <li><a href=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["pagination"]) ? $context["pagination"] : null), "base_url", array()), "html", null, true);
                    echo "?page=";
                    echo twig_escape_filter($this->env, $context["i"], "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $context["i"], "html", null, true);
                    echo "</a></li>
                                            ";
                }
                // line 66
                echo "                                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 67
            echo "                                        ";
            if (($this->getAttribute((isset($context["pagination"]) ? $context["pagination"] : null), "current_page", array()) < $this->getAttribute((isset($context["pagination"]) ? $context["pagination"] : null), "total_pages", array()))) {
                // line 68
                echo "                                            <li><a href=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["pagination"]) ? $context["pagination"] : null), "base_url", array()), "html", null, true);
                echo "?page=";
                echo twig_escape_filter($this->env, ($this->getAttribute((isset($context["pagination"]) ? $context["pagination"] : null), "current_page", array()) + 1), "html", null, true);
                echo "\" class=\"next\"><i class=\"fa fa-angle-right\"></i></a></li>
                                        ";
            }
            // line 70
            echo "                                    </ul>
                                </div>
                            ";
        }
        // line 73
        echo "                            <!-- END Pagination -->
                        </div>
                        <!-- END Posts -->
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
        return array (  184 => 73,  179 => 70,  171 => 68,  168 => 67,  162 => 66,  152 => 64,  146 => 62,  143 => 61,  138 => 60,  130 => 58,  128 => 57,  124 => 55,  122 => 54,  117 => 51,  104 => 44,  96 => 41,  90 => 37,  84 => 35,  82 => 34,  78 => 33,  70 => 28,  62 => 22,  58 => 21,  39 => 4,  36 => 3,  11 => 1,);
    }
}
