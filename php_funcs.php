<?php
echo "<pre class='vardump'>";
var_dump($arResult);
echo "</pre>";
?>
<?php
global $USER;
if ($USER->IsAdmin()):
echo "<pre style='display:none;'>";
var_dump($arResult);
echo "</pre>";
endif;
?>
