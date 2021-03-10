<?php


namespace ASTDemo\Rector;


use PhpParser\Node;
use PhpParser\Node\Name;
use PhpParser\Node\Stmt\ClassMethod;
use Rector\Core\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

class ClassMethodFooToBar extends AbstractRector
{
    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('rename class method foo to bar', [
            new CodeSample(
                'public function foo()',
                'public function bar()'
            )
        ]);
    }

    /**
     * @return string[]
     */
    public function getNodeTypes(): array
    {
        return [ClassMethod::class];
    }

    /**
     * @param ClassMethod $node
     * @return Node|null
     */
    public function refactor(Node $node): ?Node
    {
        if (!$this->isName($node, 'foo')) {
            return null;
        }

        $node->name = new Name('bar');
        return $node;
    }
}
