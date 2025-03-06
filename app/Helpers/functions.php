<?php

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

function responseOk(): RedirectResponse
{
    return redirect()->route('sections.index');
}

if (!function_exists('getId'))
{
    function getId(\App\Services\Message\DTO\StoreMessageData $data): Stringable
    {
        return Str::of($data->body)
            ->matchAll('/@[\d]+/')
            ->unique()
            ->transform(function (string $item) {
                return Str::of($item)->replaceMatches('/@/', '')->value();
            });
    }
}

if (!function_exists('getImgIds'))
{
    function getImgIds(\App\Services\Message\DTO\StoreMessageData $data): Stringable
    {
        return Str::of($data->body)
            ->matchAll('/img=[\d]+/')
            ->transform(function (string $item) {
                return Str::of($item)->replaceMatches('/img=/', '')->value();
            });
    }
}
