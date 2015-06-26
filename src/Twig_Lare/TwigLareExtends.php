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

/**
 * Extends a template by one or another, depending on whether the namespace matches
 *
 * <pre>
 *  {% lare_extends "::__base.html" %}
 *  or
 *  {% lare_extends "::__base.html" "Lare.Namespace" %}
 *  or
 *  {% lare_extends "::__base.html" "Lare.Namespace" "::__lare.html"  %}
 * </pre>
 */
class Twig_Lare_TokenParser_LareExtends extends \Twig_TokenParser
{
    public function parse(\Twig_Token $token)
    {
        $stream = $this->parser->getStream();
        $extension_namespace = null;
        $lare_template = null;
        if (!$this->parser->isMainScope()) {
            throw new \Twig_Error_Syntax('Cannot extend from a block', $token->getLine(), $this->parser->getFilename());
        }

        if (null !== $this->parser->getParent()) {
            throw new \Twig_Error_Syntax('Multiple extends tags are forbidden', $token->getLine(), $this->parser->getFilename());
        }

        $default_template = $this->parser->getExpressionParser()->parseExpression();
        if (!$stream->test(\Twig_Token::BLOCK_END_TYPE)) {
            $extension_namespace = $this->parser->getExpressionParser()->parseExpression();
            if (!$stream->test(\Twig_Token::BLOCK_END_TYPE)) {
                $lare_template = $this->parser->getExpressionParser()->parseExpression();
            } else {
                $lare_template = new \Twig_Node_Expression_Constant("::__lare.html", $token->getLine());
            }
        }
        $this->parser->getStream()->expect(\Twig_Token::BLOCK_END_TYPE);
        $arguments = new \Twig_Node_Expression_Array(array(), $token->getLine());
        $arguments->addElement($default_template);
        $arguments->addElement($lare_template);
        $arguments->addElement($extension_namespace);
        $this->parser->setParent(new \Twig_Node_Expression_Function('_lare_calculate_template', $arguments, $token->getLine()));
    }

    /**
     * Gets the tag name associated with this token parser.
     *
     * @return string The tag name
     */
    public function getTag()
    {
        return 'lare_extends';
    }
}
