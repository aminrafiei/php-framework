<?php

/* layout.view.php */
class __TwigTemplate_26345a836fae6f96108b08d9da0bc74207a8316aea0f58717a30c081e0ce72f8 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        echo "<!doctype html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <link href=\"https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css\" rel=\"stylesheet\">
    <meta name=\"viewport\"
          content=\"width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"ie=edge\">
    <title>Document</title>
</head>
<header>
    ";
        // line 12
        $this->loadTemplate("partials/header.php", "layout.view.php", 12)->display($context);
        // line 13
        echo "</header>
<body>

<div class=\"container mx-auto\">
    ";
        // line 17
        $this->displayBlock('content', $context, $blocks);
        // line 19
        echo "</div>
</body>
</html>";
    }

    // line 17
    public function block_content($context, array $blocks = [])
    {
        // line 18
        echo "    ";
    }

    public function getTemplateName()
    {
        return "layout.view.php";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  56 => 18,  53 => 17,  47 => 19,  45 => 17,  39 => 13,  37 => 12,  24 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "layout.view.php", "/var/www/html/php-framework/View/layout.view.php");
    }
}
