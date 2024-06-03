<?php
// namespace Twiggi\Twig\Extension;

use PhpOption\None;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;


class CustomTwigExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new TwigFunction('addToLib', [$this, 'addToLib']),
        ];
    }

    public function addToLib(int $userId, int $bookId)
    { // It was fail
        return null;
        // $libsActions = new Libs();
        // return $libsActions->addToLib($userId, $bookId);
    }
}
