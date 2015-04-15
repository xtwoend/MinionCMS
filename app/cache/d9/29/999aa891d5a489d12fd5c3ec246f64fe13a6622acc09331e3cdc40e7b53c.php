<?php

/* blog.html */
class __TwigTemplate_d929999aa891d5a489d12fd5c3ec246f64fe13a6622acc09331e3cdc40e7b53c extends Twig_Template
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
\t";
        // line 5
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["posts"]) ? $context["posts"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["post"]) {
            // line 6
            echo "\t\t<div class=\"post\">
\t\t\t<h2><a href=\"";
            // line 7
            echo twig_escape_filter($this->env, (isset($context["base_url"]) ? $context["base_url"] : null), "html", null, true);
            echo "/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["post"], "route", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["post"], "title", array()), "html", null, true);
            echo "</a></h2>
\t\t\t<div class=\"meta\">
\t\t\t\t<p>";
            // line 9
            echo twig_escape_filter($this->env, $this->getAttribute($context["post"], "published", array()), "html", null, true);
            echo "</p>
\t\t\t</div>
\t\t\t";
            // line 11
            if ($this->getAttribute($context["post"], "excerpt", array())) {
                // line 12
                echo "\t\t\t\t<div class=\"excerpt\">
\t\t\t\t\t<p>
\t\t\t\t\t\t";
                // line 14
                echo twig_escape_filter($this->env, $this->getAttribute($context["post"], "excerpt", array()), "html", null, true);
                echo "<br>
\t\t\t\t\t\t<a href=\"";
                // line 15
                echo twig_escape_filter($this->env, (isset($context["base_url"]) ? $context["base_url"] : null), "html", null, true);
                echo "/";
                echo twig_escape_filter($this->env, $this->getAttribute($context["post"], "route", array()), "html", null, true);
                echo "\">Continue reading &rarr;</a>
\t\t\t\t\t</p>
\t\t\t\t</div>
\t\t\t";
            }
            // line 19
            echo "\t\t</div>
\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['post'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 21
        echo "
\t";
        // line 22
        if (($this->getAttribute((isset($context["pagination"]) ? $context["pagination"] : null), "total_pages", array()) > 1)) {
            // line 23
            echo "\t\t<div class=\"pagination\">
\t\t\t";
            // line 24
            if (($this->getAttribute((isset($context["pagination"]) ? $context["pagination"] : null), "current_page", array()) > 1)) {
                // line 25
                echo "\t\t\t\t<a href=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["pagination"]) ? $context["pagination"] : null), "base_url", array()), "html", null, true);
                echo "?page=";
                echo twig_escape_filter($this->env, ($this->getAttribute((isset($context["pagination"]) ? $context["pagination"] : null), "current_page", array()) - 1), "html", null, true);
                echo "\" class=\"prev\">&lt; Prev</a>
\t\t\t";
            }
            // line 27
            echo "\t\t\t";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable(range(1, $this->getAttribute((isset($context["pagination"]) ? $context["pagination"] : null), "total_pages", array())));
            foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                // line 28
                echo "\t\t\t\t";
                if (($context["i"] == $this->getAttribute((isset($context["pagination"]) ? $context["pagination"] : null), "current_page", array()))) {
                    // line 29
                    echo "\t\t\t\t\t<span class=\"current-page\">";
                    echo twig_escape_filter($this->env, $context["i"], "html", null, true);
                    echo "</span>
\t\t\t\t";
                } else {
                    // line 31
                    echo "\t\t\t\t\t<a href=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["pagination"]) ? $context["pagination"] : null), "base_url", array()), "html", null, true);
                    echo "?page=";
                    echo twig_escape_filter($this->env, $context["i"], "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $context["i"], "html", null, true);
                    echo "</a>
\t\t\t\t";
                }
                // line 33
                echo "\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 34
            echo "\t\t\t";
            if (($this->getAttribute((isset($context["pagination"]) ? $context["pagination"] : null), "current_page", array()) < $this->getAttribute((isset($context["pagination"]) ? $context["pagination"] : null), "total_pages", array()))) {
                // line 35
                echo "\t\t\t\t<a href=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["pagination"]) ? $context["pagination"] : null), "base_url", array()), "html", null, true);
                echo "?page=";
                echo twig_escape_filter($this->env, ($this->getAttribute((isset($context["pagination"]) ? $context["pagination"] : null), "current_page", array()) + 1), "html", null, true);
                echo "\" class=\"next\">Next &gt;</a>
\t\t\t";
            }
            // line 37
            echo "\t\t</div>
\t";
        }
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
        return array (  148 => 37,  140 => 35,  137 => 34,  131 => 33,  121 => 31,  115 => 29,  112 => 28,  107 => 27,  99 => 25,  97 => 24,  94 => 23,  92 => 22,  89 => 21,  82 => 19,  73 => 15,  69 => 14,  65 => 12,  63 => 11,  58 => 9,  49 => 7,  46 => 6,  42 => 5,  39 => 4,  36 => 3,  11 => 1,);
    }
}
