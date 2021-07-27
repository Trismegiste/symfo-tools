<?php

/*
 * Vesta
 */

namespace App\Twig;

use App\Entity\RealEstate;
use Symfony\Contracts\Translation\TranslatorInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

/**
 * Extension for Twig
 */
class AppExtension extends AbstractExtension
{

    protected $translator;

    public function __construct(TranslatorInterface $translate)
    {
        $this->translator = $translate;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('crc_hue', [$this, 'getHue']),
        ];
    }

    public function getFilters()
    {
        return [
            new TwigFilter('catchline', [$this, 'getCatchLine'])
        ];
    }

    /**
     * Gets a hue between 0 to 360° from a string
     * 
     * @param string $tag
     * @return int
     */
    public function getHue(string $tag): int
    {
        $hue = hexdec(substr(hash('crc32', $tag), 7));

        return (360.0 * $hue) / 16;
    }

    public function getCatchLine(RealEstate $immo): string
    {
        return sprintf('%s %d m² %s %s',
                $immo->getTitle(),
                $immo->getSurface(),
                $this->translator->trans('ROOM_NUMBER', ['room' => $immo->getRoom()]),
                $this->translator->trans('FLOOR_NUMBER', ['floor' => $immo->getFloor()])
        );
    }

}
