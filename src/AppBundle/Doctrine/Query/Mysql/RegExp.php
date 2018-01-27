<?php


namespace AppBundle\Doctrine\Query\Mysql;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;

class RegExp extends FunctionNode
{

    public $value = null;
    public $regexp = null;

    public function parse(\Doctrine\ORM\Query\Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->value = $parser->StringPrimary();
        $parser->match(Lexer::T_COMMA);
        $this->regexp = $parser->StringExpression();
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }

    public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker)
    {
        $d = $this->value->dispatch($sqlWalker);
        $v = $this->regexp->dispatch($sqlWalker);
        return '(' . $d . ' REGEXP ' . $v . ')';
    }
}