<?php

namespace TomatoPHP\FilamentCms\Infolists\Components;

use Filament\Infolists\Components\Entry;
use Filament\Infolists\Components\TextEntry;
use Filament\Support\Contracts\HasLabel as LabelInterface;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

class MarkdownEntry extends TextEntry
{
    protected array $supportedLanguages = [
        '```bash',
        '```php',
        '```dotenv',
        '```js',
        '```java',
        '```dart',
        '```c',
        '```clike',
        '```json',
        '```html',
        '```css',
        '```scss',
        '```sql',
        '```yaml',
        '```xml',
        '```plaintext',
    ];

    public function supportedLanguages(array $languages): static
    {
        foreach ($languages as $language){
            $this->supportedLanguages[] = '```'.$language;
        }
        return $this;
    }

    public function formatState(mixed $state): mixed
    {
        $isHtml = $this->isHtml();

        $state = $this->evaluate($this->formatStateUsing ?? $state, [
            'state' => $state,
        ]);

        if ($isHtml) {
            $state = Str::sanitizeHtml($state);
        }

        if ($state instanceof Htmlable) {
            $isHtml = true;
            $state = $state->toHtml();
        }

        if ($state instanceof LabelInterface) {
            $state = $state->getLabel();
        }

        if ($characterLimit = $this->getCharacterLimit()) {
            $state = Str::limit($state, $characterLimit, $this->getCharacterLimitEnd());
        }

        if ($wordLimit = $this->getWordLimit()) {
            $state = Str::words($state, $wordLimit, $this->getWordLimitEnd());
        }

        if ($isHtml && $this->isMarkdown()) {
            $state = Str::of($state)->markdown()->replace($this->supportedLanguages, '<pre>')->replace('```', '</pre>')->toString();
        }

        $prefix = $this->getPrefix();
        $suffix = $this->getSuffix();

        if (
            (($prefix instanceof Htmlable) || ($suffix instanceof Htmlable)) &&
            (! $isHtml)
        ) {
            $isHtml = true;
            $state = e($state);
        }

        if (filled($prefix)) {
            if ($prefix instanceof Htmlable) {
                $prefix = $prefix->toHtml();
            } elseif ($isHtml) {
                $prefix = e($prefix);
            }

            $state = $prefix . $state;
        }

        if (filled($suffix)) {
            if ($suffix instanceof Htmlable) {
                $suffix = $suffix->toHtml();
            } elseif ($isHtml) {
                $suffix = e($suffix);
            }

            $state = $state . $suffix;
        }

        return $isHtml ? new HtmlString($state) : $state;
    }

    protected function setUp(): void
    {

    }
}
