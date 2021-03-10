<?php


namespace ASTDemo\Rector;


use PhpParser\Node;
use PhpParser\Node\Expr\FuncCall;
use PhpParser\Node\Name;
use Rector\Core\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

class FunctionCallBarToBaz extends AbstractRector
{
    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('rename function bar to baz and swap order of arguments', [
            new CodeSample(
                'public function bar($a, $b)',
                'public function baz($b, $a)'
            )
        ]);
    }

    /**
     * @return string[]
     */
    public function getNodeTypes(): array
    {
        return [FuncCall::class];
    }

    /**
     * @param FuncCall $node
     * @return Node|null
     */
    public function refactor(Node $node): ?Node
    {
        if (!$this->isName($node, 'bar')) {
            return null;
        }

        if (count($node->args) !== 2) {
            return null;
        }

        // rename
        $node->name = new Name('baz');

        // swap
        $swapTmp = $node->args[1];
        $node->args[1] = $node->args[0];
        $node->args[0] = $swapTmp;

        return $node;
    }
}
