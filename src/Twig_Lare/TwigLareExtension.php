<?php

namespace Lare_Team\TwigLare;

use Lare_Team\Lare\Lare as Lare;

/*
 *
 * (c) 2015 Lare Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class Twig_Lare_Extension extends \Twig_Extension
{
    public function getTokenParsers()
    {
        return array(
            new Twig_Lare_TokenParser_LareExtends(),
        );
    }

    public function getName()
    {
        return 'lare_twig_extension';
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('_lare_calculate_template', array($this, '_lare_calculate_template'))
        );
    }

    public function _lare_calculate_template($default_template_key, $default_template, $lare_tepmlate_key, $lare_template, $extension_namespace_key, $extension_namespace){
        if (isset($lare_template) && Lare::matches($extension_namespace)) {
            return $lare_template;
        } else {
            return $default_template;
        }
    }


    public function getGlobals()
    {
        return array(
            'lare_current_namespace' => Lare::get_current_namespace(),
        );
    }
}
