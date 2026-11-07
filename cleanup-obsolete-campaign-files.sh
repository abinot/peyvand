#!/usr/bin/env bash
set -euo pipefail

ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
cd "$ROOT"

obsolete_files=(
  "app/Models/LinkCampaign.php"
  "app/Models/LinkCampaignRecipient.php"
  "database/factories/LinkCampaignFactory.php"
  "database/factories/LinkCampaignRecipientFactory.php"
  "resources/views/components/⚡campaign-manager.blade.php"
)

for file in "${obsolete_files[@]}"; do
  if [[ -f "$file" ]]; then
    rm -- "$file"
    printf 'Removed %s\n' "$file"
  fi
done

printf 'Legacy campaign source cleanup complete.\n'
