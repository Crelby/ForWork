<?php
//печать массива на экран
echo "<pre style='display:none;'>";
var_dump($arResult);
echo "</pre>";
?>

<?php
//печать массива только для админа
global $USER;
if ($USER->IsAdmin()):
echo "<pre class='vardump'>";
var_dump($arResult);
echo "</pre>";
endif;
?>

<?php
//Привести цену к общему виду
function clean_price($value, $default = 0, $decimal = false)
{
    $value = mb_ereg_replace('[^0-9.,]', '', $value);
    $value = mb_ereg_replace('[,]+', ',', $value);
    $value = mb_ereg_replace('[.]+', '.', $value);

    $pos_1 = mb_strpos($value, '.');
    $pos_2 = mb_strpos($value, ',');

    if ($decimal) {
        if ($pos_1 && $pos_2) {
            // 1,000,000.00
            $value = mb_substr($value . '00', 0, $pos_1 + 3);
            $value = str_replace(',', '', $value);
        } elseif ($pos_1) {
            // 1000000.00
            $value = mb_substr($value . '00', 0, $pos_1 + 3);
        } elseif ($pos_2) {
            if ((mb_strlen($value) - $pos_2) == 3) {
                // 10,00
                $value = str_replace(',', '.', $value);
            } else {
                // 100,000,000
                $value = str_replace(',', '', $value) . '.00';
            }
        } elseif (mb_strlen($value) == 0) {
            return $default;
        } else {
            $value = $value . '.00';
        }

        return ($value == '0.00') ? 0 : $value;
    } else {
        if ($pos_1 && $pos_2) {
            // 1,000,000.00
            $value = mb_substr($value, 0, $pos_1);
            $value = str_replace(',', '', $value);
        } elseif ($pos_1) {
            // 1000000.00
            $value = mb_substr($value, 0, $pos_1);
        } elseif ($pos_2) {
            // 100,000,000
            $value = str_replace(',', '', $value);
        }

        return (mb_strlen($value) == 0) ? $default : intval($value);
    }
}
?>