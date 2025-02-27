<?php
require_once __DIR__ . '/vendor/autoload.php';

class ColorRGB
{
    private int $red;
    private int $green;
    private int $blue;

    public function __construct(int $red, int $green, int $blue)
    {
        $this->red = $red;
        $this->green = $green;
        $this->blue = $blue;
    }

    public function getRed(): int
    {
        return $this->red;
    }

    public function setRed(int $red): void
    {
        $this->red = $this->validateColor($red);
    }

    public function getBlue(): int
    {
        return $this->blue;
    }

    public function setBlue(int $blue): void
    {
        $this->blue = $this->validateColor($blue);
    }

    public function getGreen(): int
    {
        return $this->green;
    }

    public function setGreen(int $green): void
    {
        $this->green = $this->validateColor($green);
    }

    private function validateColor(int $value): int
    {
        if ($value < 0 || $value > 255) {
            throw new InvalidArgumentException("Ошибка: $value не является валидным цветом. Диапазон 0-255.");
        }

        return $value;
    }

    public function getHex(): string
    {
        return sprintf("#%02X%02X%02X", $this->red, $this->green, $this->blue);
    }

    public function equals(ColorRGB $color): bool
    {
        return $this->red === $color->getRed() &&
            $this->green === $color->getGreen() &&
            $this->blue === $color->getBlue();
    }

    public static function random(): ColorRGB
    {
        return new ColorRGB(rand(0, 255), rand(0, 255), rand(0, 255));
    }

    public static function mix(ColorRGB $color1, ColorRGB $color2, ColorRGB $color3): ColorRGB
    {
        $red = intval(round(($color1->getRed() + $color2->getRed() + $color3->getRed()) / 3));
        $green = intval(round(($color1->getGreen() + $color2->getGreen() + $color3->getGreen()) / 3));
        $blue = intval(round(($color1->getBlue() + $color2->getBlue() + $color3->getBlue()) / 3));

        return new ColorRGB($red, $green, $blue);
    }
}

$color1 = new ColorRGB(255, 0, 0);
$color2 = new ColorRGB(0, 255, 0);
$color3 = new ColorRGB(0, 0, 255);

$mixedColor = ColorRGB::mix($color1, $color2, $color3);

echo 'Смешанный цвет: ' . $mixedColor->getHex() . "\n";