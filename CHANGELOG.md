# V5.0.0

- support Filament v5 and Laravel 12/13 (Pest 4/5, Testbench 10/11)
- `lara-zeus/spatie-translatable` ^2.0 for the translatable post resource
- fix `FilamentCMS::types()` class name casing that broke autoloading on case-sensitive file systems
- the author select and filter fall back to the configured auth user model instead of `App\Models\User`
- remove the unused `Post::comments()` relation (its model never shipped)
- replace deprecated `form()` calls on table filters and bulk actions with `schema()`
- add install command test and run the test matrix on Laravel 12/13 and PHP 8.3/8.4

# V1.0.0

First release of the package
