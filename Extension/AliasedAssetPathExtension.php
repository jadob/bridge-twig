<?php
declare(strict_types=1);

namespace Jadob\Bridge\Twig\Extension;

use Override;
use RuntimeException;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AliasedAssetPathExtension extends AbstractExtension
{
    /**
     * @param array<string,string> $assets
     */
    public function __construct(protected array $assets)
    {
    }


    #[Override]
    public function getFunctions(): array
    {
        return [
            new TwigFunction('asset_aliased', $this->aliasedAssetPath(...))
        ];
    }

    public function aliasedAssetPath(string $alias): string
    {
        if (!isset($this->assets[$alias])) {
            throw new RuntimeException(sprintf('There is no asset with "%s" alias!', $alias));
        }

        return $this->assets[$alias];
    }
}