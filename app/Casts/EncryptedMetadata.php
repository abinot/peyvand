<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use InvalidArgumentException;

/**
 * Stores link metadata as JSON while encrypting common phone-number fields.
 * The model always exposes decrypted values to trusted application code.
 *
 * @implements CastsAttributes<array<string, mixed>|null, array<string, mixed>|null>
 */
class EncryptedMetadata implements CastsAttributes
{
    private const SENSITIVE_KEYS = [
        'phone', 'mobile', 'phone_number', 'mobile_number', 'telephone', 'mobile_phone',
    ];

    public function get(Model $model, string $key, mixed $value, array $attributes): ?array
    {
        if ($value === null || $value === '') {
            return null;
        }

        $metadata = is_array($value) ? $value : json_decode((string) $value, true);

        return is_array($metadata) ? $this->decryptValues($metadata) : null;
    }

    public function set(Model $model, string $key, mixed $value, array $attributes): ?string
    {
        if ($value === null) {
            return null;
        }

        if (! is_array($value)) {
            throw new InvalidArgumentException('Link metadata must be an array or null.');
        }

        return json_encode(
            $this->encryptValues($value),
            JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES,
        );
    }

    private function encryptValues(array $values): array
    {
        foreach ($values as $key => $value) {
            if (is_array($value)) {
                $values[$key] = $this->encryptValues($value);
                continue;
            }

            if (in_array(mb_strtolower((string) $key), self::SENSITIVE_KEYS, true) && is_scalar($value) && (string) $value !== '') {
                $string = (string) $value;
                $values[$key] = 'enc:'.Crypt::encryptString($string);
            }
        }

        return $values;
    }

    private function decryptValues(array $values): array
    {
        foreach ($values as $key => $value) {
            if (is_array($value)) {
                $values[$key] = $this->decryptValues($value);
                continue;
            }

            if (in_array(mb_strtolower((string) $key), self::SENSITIVE_KEYS, true) && is_string($value) && str_starts_with($value, 'enc:')) {
                try {
                    $values[$key] = Crypt::decryptString(substr($value, 4));
                } catch (DecryptException) {
                    // Leave unreadable legacy/corrupt values untouched rather than hiding them.
                }
            }
        }

        return $values;
    }
}
