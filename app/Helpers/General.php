<?php

use App\Models\FlamingoProduct;
use App\Models\User;
use App\Models\Store;
use Nette\Utils\Random;
use App\Models\StoreAccount;
use App\Enums\Platform\Platform;
use App\Models\FlamingoProductVariant;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

if (!function_exists('generateEmail')) {
    function generateEmail()
    {
        do {
            $year = date('Y');
            $month = date('m');
            $randomNumber = random_int(00, 99);
            $email =  $year . $month . $randomNumber . '@friendApp.com';
        } while (User::where('email', $email)->exists());

        return $email;
    }
}

if (!function_exists('generatePassword')) {
    function generatePassword()
    {
        $year = date('Y');
        $month = date('m');
        $randomNumber = random_int(00, 99);
        $password = $year . $month . $randomNumber . Random::generate(15);
        return $password;
    }
}

if (!function_exists('generateRandomPassword')) {
    function generateRandomPassword()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $password = '';
        $max = strlen($characters) - 1;
        for ($i = 0; $i < $max; $i++) {
            $password .= $characters[mt_rand(0, $max)];
        }
        return $password;
    }
}

if (!function_exists('getPaginationData')) {
    function getPaginationData($data)
    {
        // $data = $data->toArray();
        
        $paginationData = [
            'first_page_url' => $data['first_page_url'] ?? null,
            'last_page_url'  => $data['last_page_url'] ?? null,
            'from' => $data['from'] ?? null,
            'last_page' => $data['last_page'] ?? null,
            'last_page_url' => $data['last_page_url'] ?? null,
            'links'         => $data['links'],
            'next_page_url' => $data['next_page_url'],
            'path'          => $data['path'],
            'per_page' => $data['per_page'] ?? null,
            'prev_page_url' => $data['prev_page_url'] ?? null,
            'current_page' => $data['current_page'] ?? null,
            'to' => $data['to'] ?? null,
            'total' => $data['total'] ?? null,
        ];

        return $paginationData;
    }
}

if (!function_exists('selectRandomElement')) {
    function selectRandomElement($values, $weights)
    {

        $weightedValues = array_combine($values, $weights);
        $rand = mt_rand(1, (int) array_sum($weightedValues));

        foreach ($weightedValues as $value => $weight) {
            $rand -= $weight;
            if ($rand <= 0) {
                return $value;
            }
        }
    }
}

if (!function_exists('generateRandom11DigitNumber')) {
    function generateRandomNumber(int $numberOfNumbers): int
    {
        $number = '';
        for ($i = 0; $i < $numberOfNumbers; $i++) {
            $number .= rand(0, 9);
        }

        return $number;
    }
}

if (!function_exists('generateDateBasedSequentialNumber')) {
    function generateDateBasedSequentialNumber($model, $date, $numberOfPaddedZeros, $prefix)
    {
        // Get the total number of records created today for this model
        $countToday = $model::whereDate('created_at', $date)->count();

        $sequentialNumber = $countToday + 1;

        $formattedSequentialNumber = str_pad($sequentialNumber, $numberOfPaddedZeros, '0', STR_PAD_LEFT);

        return $prefix . '_' . $date . $formattedSequentialNumber;
    }
}

if (!function_exists('prepareTranslatableData')) {
    function prepareTranslatableData(array $validatedData): array
    {
        $translatableData = [];
        $supportedLocales = Config::get('app.available_locales', []);

        foreach ($validatedData as $key => $value) {
            if (strpos($key, '_') !== false) {
                [$field, $locale] = explode('_', $key, 2);

                if (in_array($locale, $supportedLocales)) {
                    $translatableData[$field][$locale] = $value;
                } else {
                    $translatableData[$key] = $value;
                }
            } else {
                $translatableData[$key] = $value;
            }
        }
        return $translatableData;
    }
}
if (!function_exists('admin_id')) {
    function admin_id()
    {
        return auth()->guard('admin')->user()->id;
    }
}
if (!function_exists('customer_id')) {
    function customer_id()
    {
        return auth()->guard('customer')->user()->id;
    }
}
if(!function_exists('RandomCode'))
{
    function RandomCode()
    {
        return mt_rand(1111 , 9999);
    }
}