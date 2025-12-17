<?php

function language()
{
    return app()->getLocale();
}

function languages()
{
    return \App\Models\Language::where(['status' => 1])->orderBy('name','ASC')->get();
}

function cms_user()
{
    return auth('cms')->user() ?? null;
}

function time_now()
{
    return date('Y-m-d H:i:s');
}

