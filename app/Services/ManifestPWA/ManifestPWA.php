<?php

namespace App\Services\ManifestPWA;

class ManifestPWA
{
    private string $projectCode;
    private string $name;
    private string $shortName;
    private string $description;
    private string $themeColor;
    private string $backgroundColor;
    private string $display;
    private string $orientation;
    private string $startUrl;
    private array $icons = [];


    public function __construct()
    {
        $this->themeColor = '#ffffff';
        $this->backgroundColor = '#ffffff';
        $this->display = 'standalone'; //fullscreen
        $this->orientation = 'portrait';
        $this->startUrl = '/?source=pwa';
    }



    public function load(string $projectCode): void
    {
        $this->setProjectCode($projectCode);

        switch ($this->projectCode) {
            case 'if':
                $this
                    ->setName('Įpročių formavimas')
                    ->setShortName('IF')
                    ->setDescription('Įpročių Formavimo App – tai paprasta, motyvuojanti programėlė, padedanti kurti ir palaikyti gerus įpročius. Kiekvieną dieną vartotojas atsižymi atliktas užduotis, o programėlė rodo progreso juostą ir streak’ą, skatina nepraleisti dienų bei formuoti nuoseklią rutiną. Minimalistinis dizainas, aiškios užduočių kortelės ir priminimai padeda lengvai išlaikyti discipliną.')
                    ->setThemeColor('#6A0DAD')
                    ->setBackgroundColor('#6A0DAD')
                    ->setIcons()
                    ->get();
                break;
            case 'ulala':
                $this
                    ->setName('Ulala')
                    ->setShortName('ulala')
                    ->setDescription('Programa skirta vartotojui saugoti ir organizuoti įvairaus tipo turinį – nuorodas (URL), paveikslėlius ir failus (attachmentus). Visa medžiaga gali būti grupuojama pagal temas, projektus ar kategorijas, kad lengvai būtų galima ją rasti ir peržiūrėti.')
                    ->setThemeColor('#FFC787')
                    ->setBackgroundColor('#FFC787')
                    ->setIcons()
                    ->get();
                break;
        }
    }
    public function get(): array
    {
        return [
            "name" => $this->name,
            "short_name" => $this->shortName,
            "description" => $this->description,
            "theme_color" => $this->themeColor,
            "background_color" => $this->backgroundColor,
            "display" => $this->display,
            "orientation" => $this->orientation,
            "start_url" => $this->startUrl,
            "icons" => $this->icons,
        ];
    }



    private function setProjectCode(string $projectCode): self
    {
        $this->projectCode = $projectCode;

        return $this;
    }
    private function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
    private function setShortName(string $shortName): self
    {
        $this->shortName = $shortName;

        return $this;
    }
    private function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
    private function setThemeColor(string $themeColor): self
    {
        $this->themeColor = $themeColor;

        return $this;
    }
    private function setBackgroundColor(string $backgroundColor): self
    {
        $this->backgroundColor = $backgroundColor;

        return $this;
    }
    private function setDisplay(string $display): self
    {
        $this->display = $display;

        return $this;
    }
    private function setOrientation(string $orientation): self
    {
        $this->orientation = $orientation;

        return $this;
    }
    private function setStartUrl(string $startUrl): self
    {
        $this->startUrl = $startUrl;

        return $this;
    }
    private function setIcons(): self
    {
        $iconSizes = [192,512];

        foreach ($iconSizes as $iconSize) {
            $this->icons[] = [
                'src' => $this->generateIconSrc($iconSize),
                'sizes' => $this->generateIconSizes($iconSize),
                'type' => 'image/png',
            ];
        }

        return $this;
    }


    private function generateIconSrc(int $size): string
    {
        return "$this->projectCode/pwa-{$size}x{$size}.png";
    }
    private function generateIconSizes(int $size): string
    {
        return "{$size}x{$size}";
    }
}
