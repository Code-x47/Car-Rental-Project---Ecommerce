<?php

namespace App\Services;

use Smarty\Smarty;

class SmartyService
{
    public static function render(string $template, array $data = [])
    {
        $smarty = new Smarty();

        $smarty->setTemplateDir(resource_path('views/smarty'));
        $smarty->setCompileDir(storage_path('framework/smarty/compile'));
        $smarty->setCacheDir(storage_path('framework/smarty/cache'));

        // Assign all passed data
        foreach ($data as $key => $value) {
            $smarty->assign($key, $value);
        }

        return $smarty->fetch($template . '.tpl');
    }
}
