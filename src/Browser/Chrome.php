<?php
namespace TomatoPHP\FilamentCms\Browser;

use Closure;
use Illuminate\Support\Collection;
use Laravel\Dusk\Chrome\SupportsChrome;
use Facebook\WebDriver\WebDriverPlatform;
use Laravel\Dusk\Concerns\ProvidesBrowser;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\WebDriverBrowserType;
use Facebook\WebDriver\Remote\WebDriverCapabilityType;

/**
 *
 * @property RemoteWebDriver $getDriver
 * @property Collection $arguments
 * @property int $requestTimeout
 * @property int $connectTimeout
 * @property static start()
 * @property static stop()
 * @property static setRequestTimeout(int $timeout)
 * @property string getCallerName()
 * @property RemoteWebDriver driver()
 * @property static addArgument(string $argument):
 * @property static setProfile(string $id):
 * @property static browserData(string $path)
 * @property static disableInfobars()
 * @property static disableNotifications()
 * @property static disableExtensions()
 * @property static userAgent(string $useragent)
 * @property static proxyServer(string $ip)
 * @property static windowSize(int $width, int $height)
 * @property static ignoreSslErrors()
 * @property static noZygote()
 * @property static noSandbox()
 * @property static disableGpu()
 * @property static cookie()
 * @property static remote()
 * @property static headless()
 * @property static setConnectTimeout(int $timeout)
 * @method  browse(Closure $callback): Browser
 * @method close()
 */
class Chrome
{
    use ProvidesBrowser,
        SupportsChrome;


    /**
     * @var RemoteWebDriver
     */
    public RemoteWebDriver $getDriver;


    /**
     * A list of remote web driver arguments.
     *
     * @var Collection
     */
    protected Collection $arguments;


    /**
     * Set the maximum time of a request to remote WebDriver server.
     *
     * @var int
     */
    protected int $requestTimeout = 50000;

    /**
     * Set the maximum time of a connection to remote WebDriver server.
     *
     * @var int
     */
    protected int $connectTimeout = 50000;




    /**
     * Initialises the dusk browser and starts the chrome driver.
     *
     * @return void
     */
    public function __construct(
        /**
         * Request caller name.
         *
         * @var string
         */
        protected string $callerName
    )
    {
        $this->arguments = Collection::make();
    }

    /**
     * Start the browser.
     *
     * @return $this
     */
    public function start(): static
    {
        static::startChromeDriver();

        return $this;
    }


    /**
     * Stop Browser
     *
     * @return $this
     * @throws \Exception
     */
    public function stop(): static
    {
        try {
            $this->closeAll();
        } catch (\Exception $e) {
            throw $e;
        } finally {
            static::stopChromeDriver();

            return $this;
        }
    }

    /**
     * Set the request timeout.
     *
     * @return $this
     */
    public function setRequestTimeout(int $timeout): static
    {
        $this->requestTimeout = $timeout;

        return $this;
    }

    /**
     * Set the connect timeout.
     *
     * @return $this
     */
    public function setConnectTimeout(int $timeout): static
    {
        $this->connectTimeout = $timeout;

        return $this;
    }

    /**
     * Run the browser in headless mode.
     *
     * @return $this
     */
    public function headless(): static
    {
        return $this->addArgument('--headless');
    }


    /**
     * Set Remote Port
     *
     * @return $this
     */
    public function remote(): static
    {
        return $this->addArgument('--remote-debugging-port=9222');
    }

    /**
     * Set Cookies Folder For The Browser
     *
     * @return $this
     */
    public function cookie(): static
    {
        return $this->addArgument('--enable-file-cookies');
    }

    /**
     * Disable the browser using gpu.
     *
     * @return $this
     */
    public function disableGpu(): static
    {
        return $this->addArgument('--disable-gpu');
    }

    /**
     * Disable the sandbox.
     *
     * @return $this
     */
    public function noSandbox(): static
    {
        return $this->addArgument('--no-sandbox');
    }

    /**
     * Disables the use of a zygote process for forking child processes.
     *
     * @return $this
     */
    public function noZygote():static
    {
        return $this->noSandbox()->addArgument('--no-zygote');
    }

    /**
     * Ignore SSL certificate error messages.
     *
     * @return $this
     */
    public function ignoreSslErrors():static
    {
        return $this->addArgument('--ignore-certificate-errors');
    }

    /**
     * Set the initial browser window size.
     *
     * @param int $width the browser width in pixels
     * @param int $height the browser height in pixels
     *
     * @return $this
     */
    public function windowSize(int $width, int $height): static
    {
        return $this->addArgument('--window-size=' . $width . ',' . $height);
    }

    /**
     * Set the user proxy IP.
     *
     * @param string $ip the user proxy IP
     *
     * @return $this
     */
    public function proxyServer(string $ip): static
    {
        return $this->addArgument('--proxy-server=' . $ip);
    }

    /**
     * Set user Agent for selected browser.
     *
     * @param string $useragent
     * @return $this
     */
    public function userAgent(string $useragent): static
    {
        return $this->addArgument('--user-agent=' . $useragent);
    }

    /**
     * Disabled Extensions On The Browser
     *
     * @return $this
     */
    public function disableExtensions(): static
    {
        return $this->addArgument('--disable-extensions');
    }

    /**
     * Disabled Browser Notifications
     *
     * @return $this
     */
    public function disableNotifications(): static
    {
        return $this->addArgument('--disable-notifications');
    }

    /**
     * Disabled Info Bar on the browser
     *
     * @return $this
     */
    public function disableInfobars(): static
    {
        return $this->addArgument('disable-infobars');
    }


    /**
     * Set The Browser Data Base Path
     *
     * @param string $path
     * @return $this
     */
    public function browserData(string $path):static
    {
        return $this->addArgument('--user-data-dir=' . $path);
    }

    /**
     * @param string $id
     * @return $this
     */
    public function setProfile(string $id): static
    {
        return $this->addArgument('--profile-directory=Profile ' . $id);
    }

    /**
     * Add a browser option.
     *
     * @param string $argument
     * @return $this
     */
    protected function addArgument(string $argument): static
    {
        if (!$this->arguments->contains($argument)) {
            $this->arguments->push($argument);
        }

        return $this;
    }

    /**
     * Create the RemoteWebDriver instance.
     *
     * @return RemoteWebDriver
     */
    public function driver(): RemoteWebDriver
    {
        $options = (new ChromeOptions())->addArguments($this->arguments->toArray());
        $options->setExperimentalOption('excludeSwitches', ['enable-automation']);

        $this->getDriver =  RemoteWebDriver::create(
            'http://localhost:9515',
            DesiredCapabilities::chrome()->setCapability(
                ChromeOptions::CAPABILITY,
                $options
            ),
            $this->connectTimeout,
            $this->requestTimeout
        );

        return $this->getDriver;
    }

    /**
     * Get the browser caller name.
     *
     * @return string
     */
    protected function getCallerName(): string
    {
        return \str_replace('\\', '_', \get_class($this)) . '_' . $this->callerName;
    }
}
