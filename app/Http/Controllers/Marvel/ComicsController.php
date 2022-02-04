<?php

namespace App\Http\Controllers\Marvel;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Marvel\ApiController;

class ComicsController extends Controller
{
    public function index()
    {
        $api = new ApiController();
        $comics = $api->comics(); 
        if ($comics->status() == 200) 
            $response = json_decode($comics->getContent());

        if(!$response->code == 200)
            return view('marvel/comics');

        $dataComics = $response->data->results;
        return view('marvel/comics', compact('dataComics'));  
    }

    public function getComics($id)
    {
        $api = new ApiController();
        $getComics = $api->getComics($id);

        if ($getComics->status() == 200) 
            $response = json_decode($getComics->getContent());

        if(!$response->code == 200)
            dd('NOT FOUND');

        $comics = $response->data->results;
        return view('marvel/details', compact('comics')); 
    }
}
