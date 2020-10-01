<?php
include 'cssparser.php';
$test = new Stylesheet('sample.css');
echo '<pre>';
print_r($test);
$test->rules[0]->formatProperties();
echo '</pre>';

?>