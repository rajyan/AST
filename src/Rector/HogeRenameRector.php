<?php


namespace ASTDemo\Rector;


use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\New_;
use PhpParser\Node\Expr\StaticCall;
use PhpParser\Node\Expr\Variable;
use PhpParser\Node\Scalar\String_;
use PhpParser\Node\Stmt\ClassMethod;
use Rector\Core\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

class HogeRenameRector extends AbstractRector
{

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('rename hoge by expression', [
            new CodeSample(
                'class method: hoge',
                'class method: a'
            ),
            new CodeSample(
                'variable: hoge',
                'variable: b'
            ),
            new CodeSample(
                'string: hoge',
                'string: c'
            ),
            new CodeSample(
                'new: hoge',
                'new: d'
            ),
            new CodeSample(
                'method: hoge',
                'method: e'
            ),
            new CodeSample(
                'static call class: hoge',
                'static call class: f'
            ),
            new CodeSample(
                'static class method: hoge',
                'static class method: g'
            )
        ]);
    }

    /**
     * @inheritDoc
     */
    public function getNodeTypes(): array
    {
        return [
            ClassMethod::class,
            Variable::class,
            String_::class,
            New_::class,
            MethodCall::class,
            StaticCall::class
        ];
    }

    /**
     * @inheritDoc
     */
    public function refactor(Node $node): ?Node
    {
        $nameResolver = $this->nodeNameResolver;

        if ($node instanceof ClassMethod) {
            if (!$nameResolver->isName($node, 'hoge')) {
                return null;
            }
            $node->name = new Node\Identifier('a');
        } else if ($node instanceof Variable) {
            if (!$nameResolver->isName($node, 'hoge')) {
                return null;
            }
            $node->name = 'b';
        } else if ($node instanceof String_) {
            if ($node->value !== 'hoge') {
                return null;
            }
            $node->value = 'c';
        } else if ($node instanceof New_) {
            if ($nameResolver->getShortName($node->class) !== 'hoge') {
                return null;
            }
            $node->class = new Node\Name('d');
        } else if ($node instanceof MethodCall) {
            if ($this->getName($node->name) !== 'hoge') {
                return null;
            }
            $node->name = new Node\Identifier('e');
        } else if ($node instanceof StaticCall) {
            if (!$this->nodeNameResolver->isStaticCallNamed($node, 'hoge', 'hoge')) {
                return null;
            }
            $node->class = new Node\Name('f');
            $node->name = new Node\Identifier('g');
        }

        return $node;
    }
}
