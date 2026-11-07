# Peyvand hotfix

This patch is applied on top of `peyvand-group-import-patch.zip`.

## Fixes

- Escapes the `{{phone}}` examples in the bulk-import Blade template using HTML entities, preventing Blade from parsing the sample as a nested expression.
- Adds a temporary backward-compatible route name `campaigns.index` that redirects to the ordinary group-import screen. No campaign model or SMS campaign subsystem is reintroduced.
- Restricts short-link codes to 3–32 characters, so `/ab` falls through as 404.
- Explicitly raises `ModelNotFoundException` when an already accepted team invitation is used again.

## Apply

Extract the files into the project root, merging/overwriting the matching files, then run:

```bash
php artisan optimize:clear
php artisan test
```

No database migration is required for this hotfix.
