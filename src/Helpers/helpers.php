<?php declare(strict_types=1);

function d($var, ?string $varname = null): void
{
    echo '<pre class="dumper">';
    echo $varname ? '<strong>$' . str_replace(";", '', $varname) . '</strong><br>' : null;
    $sep = '';
    if (is_object($var)) {
        $class = get_class($var);
        $strlen = strlen("Instance of : " . $class);
        for ($i = 0; $i < $strlen; ++$i) {
            $sep .= '-';
        }
        echo $sep . '<br>Instance of : ' . $class . '<br>' . $sep . '</br>';
    }
    if (is_object($var) or is_array($var)) {
        echo (is_object($var) or $var instanceof stdClass ? 'is object' : 'is array') . '<br>' . $sep . '<br>';
        print_r((is_object($var) ? ($var instanceof stdClass ? $var : $var->toArray()) : $var));
    } else {
        echo 'is var<br>' . $sep . '<br>';
        var_dump($var);
    }
    echo '</pre>';
}

function de($var, $varname = null)
{
    d($var, $varname);
    exit;
}

function translatable(string $string): string
{
    return strstr($string, 'trans_') ? trans(str_replace('trans_', '', $string)) : $string;
}