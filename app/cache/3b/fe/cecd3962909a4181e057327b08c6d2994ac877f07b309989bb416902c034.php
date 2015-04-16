<?php

/* docs.html */
class __TwigTemplate_3bfececd3962909a4181e057327b08c6d2994ac877f07b309989bb416902c034 extends Twig_Template
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
                    <h1 class=\"animation-slideDown\"><strong>Documentation</strong></h1>
                </div>                
            </section>
            <!-- END Intro -->

            <!-- Helpdesk -->
            <section class=\"site-content site-section\">
                <div class=\"container\">
                    <div class=\"row\">
                         <div class=\"col-sm-3 col-md-3\">
                            ";
        // line 19
        echo $this->env->getExtension('slim')->renderNav("docs");
        echo "   
                         </div>
                        <!-- Sidebar -->
                        <div class=\"col-sm-9 col-md-9\">
                            <aside class=\"sidebar site-block\">
                                ";
        // line 24
        echo (isset($context["content"]) ? $context["content"] : null);
        echo "
                                <!-- END Latest Articles -->
                            </aside>
                        </div>
                        <!-- END Sidebar -->
                    </div>
                </div>
            </section>
            <!-- END Helpdesk -->
";
    }

    public function getTemplateName()
    {
        return "docs.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  64 => 24,  56 => 19,  39 => 4,  36 => 3,  11 => 1,);
    }
}
