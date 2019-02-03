{% if 'Twig'|auth %}
welcome {{ 'Twig'|authName }}
{% endif %}
<hr>

<?php if (session()->hasMessage()) : ?>
    Message : <?php print(session()->getMessage()) ?>
<?php endif; ?>

<ul>
    <li><a href="/">home</a></li>
    <?php if (!auth()) : ?>
        <li>
            <a href="login">login</a> / <a href="register">register</a>
        </li>
    <?php endif ?>
    <li><a href="task">task</a></li>
    <li><a href="about">about</a></li>
</ul>