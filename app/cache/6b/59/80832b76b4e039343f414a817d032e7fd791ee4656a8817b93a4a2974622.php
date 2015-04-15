<?php

/* layout.html */
class __TwigTemplate_6b5980832b76b4e039343f414a817d032e7fd791ee4656a8817b93a4a2974622 extends Twig_Template
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
        echo "<!DOCTYPE HTML>
<!--
\tPrologue by HTML5 UP
\thtml5up.net | @n33co
\tFree for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
\t<head>
\t\t<title>
\t\t";
        // line 10
        $this->displayBlock('title', $context, $blocks);
        // line 16
        echo "\t\t</title>

\t\t<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\" />
\t\t
\t\t";
        // line 20
        if ($this->getAttribute((isset($context["info"]) ? $context["info"] : null), "description", array())) {
            // line 21
            echo "\t\t<meta name=\"description\" content=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["info"]) ? $context["info"] : null), "description", array()), "html", null, true);
            echo "\">
\t\t";
        }
        // line 23
        echo "
\t\t";
        // line 24
        if ($this->getAttribute((isset($context["info"]) ? $context["info"] : null), "keywords", array())) {
            // line 25
            echo "\t\t<meta name=\"keywords\" content=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["info"]) ? $context["info"] : null), "keywords", array()), "html", null, true);
            echo "\" />
\t\t";
        }
        // line 27
        echo "
\t\t<!--[if lte IE 8]><script src=\"css/ie/html5shiv.js\"></script><![endif]-->
\t\t<script src=\"";
        // line 29
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/me/js/jquery.min.js\"></script>
\t\t<script src=\"";
        // line 30
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/me/js/jquery.scrolly.min.js\"></script>
\t\t<script src=\"";
        // line 31
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/me/js/jquery.scrollzer.min.js\"></script>
\t\t<script src=\"";
        // line 32
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/me/js/skel.min.js\"></script>
\t\t<script src=\"";
        // line 33
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/me/js/skel-layers.min.js\"></script>
\t\t<script src=\"";
        // line 34
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/me/js/init.js\"></script>
\t\t<noscript>
\t\t\t<link rel=\"stylesheet\" href=\"";
        // line 36
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/me/css/skel.css\" />
\t\t\t<link rel=\"stylesheet\" href=\"";
        // line 37
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/me/css/style.css\" />
\t\t\t<link rel=\"stylesheet\" href=\"";
        // line 38
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/me/css/style-wide.css\" />
\t\t</noscript>
\t\t<!--[if lte IE 9]><link rel=\"stylesheet\" href=\"themes/me/css/ie/v9.css\" /><![endif]-->
\t\t<!--[if lte IE 8]><link rel=\"stylesheet\" href=\"themes/me/css/ie/v8.css\" /><![endif]-->
\t</head>
\t<body>

\t\t<!-- Header -->
\t\t\t<div id=\"header\" class=\"skel-layers-fixed\">

\t\t\t\t<div class=\"top\">

\t\t\t\t\t<!-- Logo -->
\t\t\t\t\t\t<div id=\"logo\">
\t\t\t\t\t\t\t<span class=\"image avatar48\"><img src=\"";
        // line 52
        echo twig_escape_filter($this->env, $this->env->getExtension('slim')->base(), "html", null, true);
        echo "/themes/me/images/avatar.jpg\" alt=\"\" /></span>
\t\t\t\t\t\t\t<h1 id=\"title\">Jane Doe</h1>
\t\t\t\t\t\t\t<p>Hyperspace Engineer</p>
\t\t\t\t\t\t</div>

\t\t\t\t\t<!-- Nav -->
\t\t\t\t\t\t<nav id=\"nav\">
\t\t\t\t\t\t\t<!--
\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\tPrologue's nav expects links in one of two formats:
\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t1. Hash link (scrolls to a different section within the page)
\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t   <li><a href=\"#foobar\" id=\"foobar-link\" class=\"icon fa-whatever-icon-you-want skel-layers-ignoreHref\"><span class=\"label\">Foobar</span></a></li>

\t\t\t\t\t\t\t\t2. Standard link (sends the user to another page/site)

\t\t\t\t\t\t\t\t   <li><a href=\"http://foobar.tld\" id=\"foobar-link\" class=\"icon fa-whatever-icon-you-want\"><span class=\"label\">Foobar</span></a></li>
\t\t\t\t\t\t\t
\t\t\t\t\t\t\t-->
\t\t\t\t\t\t\t<ul>
\t\t\t\t\t\t\t\t<li><a href=\"#top\" id=\"top-link\" class=\"skel-layers-ignoreHref\"><span class=\"icon fa-home\">Intro</span></a></li>
\t\t\t\t\t\t\t\t<li><a href=\"#portfolio\" id=\"portfolio-link\" class=\"skel-layers-ignoreHref\"><span class=\"icon fa-th\">Portfolio</span></a></li>
\t\t\t\t\t\t\t\t<li><a href=\"#about\" id=\"about-link\" class=\"skel-layers-ignoreHref\"><span class=\"icon fa-user\">About Me</span></a></li>
\t\t\t\t\t\t\t\t<li><a href=\"#contact\" id=\"contact-link\" class=\"skel-layers-ignoreHref\"><span class=\"icon fa-envelope\">Contact</span></a></li>
\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t</nav>
\t\t\t\t\t\t
\t\t\t\t</div>
\t\t\t\t
\t\t\t\t<div class=\"bottom\">

\t\t\t\t\t<!-- Social Icons -->
\t\t\t\t\t\t<ul class=\"icons\">
\t\t\t\t\t\t\t<li><a href=\"#\" class=\"icon fa-twitter\"><span class=\"label\">Twitter</span></a></li>
\t\t\t\t\t\t\t<li><a href=\"#\" class=\"icon fa-facebook\"><span class=\"label\">Facebook</span></a></li>
\t\t\t\t\t\t\t<li><a href=\"#\" class=\"icon fa-github\"><span class=\"label\">Github</span></a></li>
\t\t\t\t\t\t\t<li><a href=\"#\" class=\"icon fa-dribbble\"><span class=\"label\">Dribbble</span></a></li>
\t\t\t\t\t\t\t<li><a href=\"#\" class=\"icon fa-envelope\"><span class=\"label\">Email</span></a></li>
\t\t\t\t\t\t</ul>
\t\t\t\t
\t\t\t\t</div>
\t\t\t
\t\t\t</div>

\t\t<!-- Main -->
\t\t\t<div id=\"main\">
\t\t\t\t
\t\t\t\t";
        // line 100
        $this->displayBlock('content', $context, $blocks);
        // line 101
        echo "\t\t\t
\t\t\t</div>

\t\t<!-- Footer -->
\t\t\t<div id=\"footer\">
\t\t\t\t
\t\t\t\t<!-- Copyright -->
\t\t\t\t\t<ul class=\"copyright\">
\t\t\t\t\t\t<li>&copy; Untitled. All rights reserved.</li><li>Design: <a href=\"http://html5up.net\">HTML5 UP</a></li>
\t\t\t\t\t</ul>
\t\t\t\t
\t\t\t</div>

\t</body>
</html>";
    }

    // line 10
    public function block_title($context, array $blocks = array())
    {
        // line 11
        echo "\t\t\t";
        if ($this->getAttribute((isset($context["info"]) ? $context["info"] : null), "title", array())) {
            // line 12
            echo "\t\t\t\t";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["info"]) ? $context["info"] : null), "title", array()), "html", null, true);
            echo " -
\t\t\t";
        }
        // line 14
        echo "\t\t\tMinion
\t\t";
    }

    // line 100
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
        return array (  201 => 100,  196 => 14,  190 => 12,  187 => 11,  184 => 10,  166 => 101,  164 => 100,  113 => 52,  96 => 38,  92 => 37,  88 => 36,  83 => 34,  79 => 33,  75 => 32,  71 => 31,  67 => 30,  63 => 29,  59 => 27,  53 => 25,  51 => 24,  48 => 23,  42 => 21,  40 => 20,  34 => 16,  32 => 10,  21 => 1,);
    }
}
