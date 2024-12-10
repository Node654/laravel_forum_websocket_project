<?php

use Illuminate\Http\RedirectResponse;

function responseOk(): RedirectResponse
{
    return redirect()->route('sections.index');
}
