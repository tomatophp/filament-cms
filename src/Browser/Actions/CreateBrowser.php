<?php

namespace TomatoPHP\FilamentCms\Browser\Actions;

use TomatoPHP\FilamentCms\Browser\Chrome;

/**
 * @method visit(string|null $dashboardLink)
 */
class CreateBrowser
{
    private ?Chrome $dusk;

    public function __construct(
        private string $type='web',
        private bool $show=false
    )
    {
        $this->dusk = new Chrome($this->type);

        try {
            if (!$this->show) {
                $this->dusk->headless()
                    ->disableGpu()
                    ->noSandbox();
            }

            $this->dusk->windowSize(1200, 1200);
            $this->dusk->ignoreSslErrors();
            $this->dusk->disableNotifications();
            $this->dusk->disableInfobars();
            $this->agent();
            $this->dusk->start();
        } catch (\Exception $e) {
            $this->dusk->stop();
        }
    }

    /**
     * @return void
     */
    private function agent(): void
    {
        if ($this->type === 'web') {
            $webAgent = "Mozilla/5.0 (X11; Linux x86_64) ";
            $webAgent .= "AppleWebKit/537.36 (KHTML, like Gecko) ";
            $webAgent .= "Chrome/111.0.0.0 Safari/537.36";
            $this->dusk->userAgent($webAgent);
        }
        else {
            $mobileAgent = "Mozilla/5.0 (Linux; Android 7.0; SM-G930V Build/NRD90M) ";
            $mobileAgent .= "AppleWebKit/537.36 (KHTML, like Gecko) ";
            $mobileAgent .= "Chrome/59.0.3071.125 Mobile Safari/537.36";
            $this->dusk->userAgent($mobileAgent);
        }
    }

    /**
     * @return Chrome|null
     */
    public function dusk(): Chrome|null
    {
        return $this->dusk;
    }
}
