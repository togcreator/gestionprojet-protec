<?php
/**
 * Created by PhpStorm.
 * User: HP4510
 * Date: 21/09/2017
 * Time: 12:00
 */

namespace MailBundle\Doctrine\Query;

use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\AST\Functions\FunctionNode;

class GroupConcat extends FunctionNode {

    public $isDistinct = false;
    public $expression = null;

    /**
     * @param \Doctrine\ORM\Query\SqlWalker $sqlWalker
     *
     * @return string
     */
    public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker)
    {
        return 'GROUP_CONCAT(' .
        ($this->isDistinct ? 'DISTINCT ' : '') .
        $this->expression->dispatch($sqlWalker) .
        ')';
    }

    /**
     * @param \Doctrine\ORM\Query\Parser $parser
     *
     * @return void
     */
    public function parse(\Doctrine\ORM\Query\Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);

        $lexer = $parser->getLexer();
        if ($lexer->isNextToken(Lexer::T_DISTINCT)) {
            $parser->match(Lexer::T_DISTINCT);

            $this->isDistinct = true;
        }

        $this->expression = $parser->SingleValuedPathExpression();

        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }
}