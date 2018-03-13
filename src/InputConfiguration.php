<?php

/*
 * This file is part of the Symfony MakerBundle package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Bundle\MakerBundle;

final class InputConfiguration
{
    private $arguments = [];

    private $nonInteractiveArguments = [];

    /**
     * Call in MakerInterface::configureCommand() to disable the automatic interactive
     * prompt for an argument.
     *
     * @param string $argumentName
     */
    public function setArgumentAsNonInteractive(string $argumentName)
    {
        $this->nonInteractiveArguments[] = $argumentName;
    }

    public function getNonInteractiveArguments(): array
    {
        return $this->nonInteractiveArguments;
    }

    public function argument(string $argumentName, bool $ai = true, array $autocomplete = null, callable $validator = null)
    {
        $this->arguments[$argumentName] = [
            'automatic' => $ai,
            'validator' => $validator,
            'autocomplete' => $autocomplete,
        ];
    }

    public function get(string $argumentName): array
    {
        return array_key_exists($argumentName, $this->arguments) ? $this->arguments[$argumentName] : [];
    }
}
