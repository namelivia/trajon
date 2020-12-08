<?php

namespace App\Http\Controllers;

use App\Image;
use App\Http\Controllers\Controller;
use Storage;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;

class GalleryController extends Controller
{
    /**
     * Show all images.
     *
     * @return View
     */
    public function all(Request $request)
    {
        $jwt = $request->header('X-Pomerium-Jwt-Assertion');
        $key = Storage::disk('local')->get('jwt.pem');
        $decoded = JWT::decode($jwt, $key, ['ES256']);
        $pagesize = 9;
        $page = (int)$request->input('page') ?? 0;
        $images = array_map(function($item) {
            return new Image($item);
        }, array_filter(Storage::cloud()->files('/'), function($item) {
            return substr_compare($item, '.jpg', -strlen('.jpg')) === 0;
        }));
        usort($images, function($a, $b) {
            return $a->getTimestamp() < $b->getTimestamp() ? 1 : -1;
        });
        $imagesPage = array_slice($images, $page * $pagesize, $pagesize);
        $response = (object)[];
        $response->offset = $page * $pagesize;
        $response->limit = $pagesize;
        $response->total = count($images);
        return view('gallery', ['images' => $imagesPage, 'response' => $response, 'email' => $decoded->email]);
    }
}
