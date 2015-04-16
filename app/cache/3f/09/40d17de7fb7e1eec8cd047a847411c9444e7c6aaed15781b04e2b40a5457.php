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
                       
                        <h1 class=\"animation-slideDown\"><strong>";
        // line 10
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["info"]) ? $context["info"] : null), "title", array()), "html", null, true);
        echo "</strong></h1>
                        <h2 class=\"h3 animation-slideUp hidden-xs\">";
        // line 11
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
        // line 28
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
        return array (  71 => 28,  51 => 11,  47 => 10,  39 => 4,  36 => 3,  11 => 1,);
    }
}
