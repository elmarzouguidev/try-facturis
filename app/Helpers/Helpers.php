<?php

use App\Models\User;
use App\Support\Helpers\Type;
use Illuminate\Support\Str;

if (! function_exists('getDomainName')) {
    function getDomainName(): string
    {
        return request()->getSchemeAndHttpHost() . '/';
    }
}

/******************* */

if (! function_exists('getUuid')) {
    function getUuid(): string
    {
        return Str::uuid()->toString();
    }
}

/*******Calculation Helper ********/

if (! function_exists('percentToDecimal')) {
    function percentToDecimal($percent): float
    {
        $percent = str_replace('%', '', $percent);

        return $percent;
    }
}

/**
 * Helper to only return digits, extract commas, etc.
 *
 * @param  string|null  $text
 * @return float
 */
if (! function_exists('onlyNumbers')) {
    function onlyNumbers(?string $text): float
    {
        if (! $text) {
            return 0;
        }

        return (float) preg_replace('/[^0-9.-]/', '', $text);
    }
}

if (! function_exists('LoadFromURL')) {
    function LoadFromURL($url): bool|string
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }
}

if (! function_exists('getAvatar')) {
    function getAvatar($email): string
    {
        // You can add any of the gravatar supported options to this array.
        // See https://gravatar.com/site/implement/images/
        $config = [
            'default' => getDefaultAvatar(),
            'size' => '200', // use 200px by 200px image
        ];

        return 'https://www.gravatar.com/avatar/' . md5($email) . '?' . http_build_query($config);
    }
}

if (! function_exists('getDefaultAvatar')) {
    function getDefaultAvatar(): string
    {
        return 'https://ui-avatars.com/api/' . implode('/', [

            //IMPORTANT: Do not change this order
            urlencode(auth()->user()->full_name), // name
            300, // image size
            '556ee6', // background color
            'ffffff', // font color
        ]);
    }
}


if (! function_exists('randomUserCode')) {
    function randomUserCode()
    {
        do {
            $number = random_int(10000000, 99999999);
        } while (User::where('code', '=', $number)->exists());

        return $number;
    }
}

if (! function_exists('type')) {
    /**
     * Create a new type instance.
     *
     * @template TVariable
     *
     * @param  TVariable  $variable
     * @return Type<TVariable>
     */
    function type(mixed $variable): Type
    {
        return new Type($variable);
    }
}





