<?php

namespace App\Classes;

use Illuminate\Support\Facades\Http;

class SpaceXAPI
{
    public static function fetch_all()
    {
        $response = Http::get("https://api.spacexdata.com/v3/capsules");
        return $response->body();
    }

    public static function fetch_active()
    {
        $response = Http::get("https://api.spacexdata.com/v3/capsules?status=active");
        return $response->body();
    }

    public static function fetch_by_status($status)
    {
        $response = Http::get("https://api.spacexdata.com/v3/capsules?status=$status");
        return $response->body();
    }

    public static function fetch_by_serial($id)
    {
        $base_url = "https://api.spacexdata.com/v3/capsules/".$id;
        $response = Http::get($base_url);
        return $response->body();
    }

}
