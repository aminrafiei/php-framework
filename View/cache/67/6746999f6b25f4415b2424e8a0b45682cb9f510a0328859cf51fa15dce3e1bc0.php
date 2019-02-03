<?php

/* partials/header.php */
class __TwigTemplate_95cf2cc9d6b786c169c1eb230987dc84e9da66cca772903aae395b08d20de7cb extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        echo "<?php if (auth()) : ?>
    welcome32 <?php print auth()->name ?>
<?php endif ?>
<hr>

<?php if (session()->hasMessage()) : ?>
    Message : <?php print(session()->getMessage()) ?>
<?php endif; ?>

<ul>
    <li><a href=\"/\">home</a></li>
    <?php if (!auth()) : ?>
        <li>
            <a href=\"login\">login</a> / <a href=\"register\">register</a>
        </li>
    <?php endif ?>
    <li><a href=\"task\">task</a></li>
    <li><a href=\"about\">about</a></li>
</ul>";
    }

    public function getTemplateName()
    {
        return "partials/header.php";
    }

    public function getDebugInfo()
    {
        return array (  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "partials/header.php", "/var/www/html/php-framework/View/partials/header.php");
    }
}
