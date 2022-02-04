<?php

namespace App\Http\Controllers\Marvel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class ApiController extends Controller
{
    public function comics() 
    {
        $gateway = 'https://gateway.marvel.com:443/v1/public';
        $ts = 1;
        $publickey = 'd5def239451a47a3a02b01acd922bf92';
        $privatekey = 'bce182f6aa8ecfd5a61ba609f4b910bbbc73272e';
        $hash = md5($ts.$privatekey.$publickey);
        $arrayParams = [
            'noVariants' => "false",
            'hasDigitalIssue' => 'false',
            'orderBy' => 'issueNumber',
            'limit' => "12",
        ];
        
        foreach($arrayParams as $k => $p) {
            $stringParams = "{$k}={$p}&";
        }

        $response = 
            Http::get("{$gateway}/comics?{$stringParams}ts={$ts}&apikey={$publickey}&hash={$hash}");
        
        return response($response);
    }    

    public function getComics($id)
    {
        $gateway = 'https://gateway.marvel.com:443/v1/public';
        $ts = 1;
        $publickey = 'd5def239451a47a3a02b01acd922bf92';
        $privatekey = 'bce182f6aa8ecfd5a61ba609f4b910bbbc73272e';
        $hash = md5($ts.$privatekey.$publickey);

        $response = 
            Http::get("{$gateway}/comics/{$id}?ts={$ts}&apikey={$publickey}&hash={$hash}");
        
        return response($response);        
    }
}
