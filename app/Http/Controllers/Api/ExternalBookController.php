<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\CreateBookRequest;
use App\Http\Requests\Book\ExternalBookRequest;
use App\Http\Requests\Book\UpdateBookRequest;
use App\Http\Resources\Book\BookResource;
use App\Models\Book;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ExternalBookController extends Controller
{
    private string $googleApiToken;
    public function __construct()
    {
        $this->googleApiToken = env('GOOGLE_API_TOKEN');
    }

    public function getInfoBooks(Request $request): JsonResponse
    {

        $url = $this->getUrlWithQueryParams($request);

        $client = new Client();
        $response = $client->get("https://www.googleapis.com/books/v1/volumes{$url}");

        $books =json_decode($response->getBody()->getContents(), true);

        $bookResponse = [];
        foreach ($books['items'] as $book) {
            $bookResponse[] = [
                'title' => isset($book['volumeInfo']['title']) ? $book['volumeInfo']['title'] : null,
                'description' => isset($book['volumeInfo']['description']) ? $book['volumeInfo']['description'] : null,
                'pages' => isset($book['volumeInfo']['pageCount']) ? $book['volumeInfo']['pageCount'] : null,
                'categories' => isset($book['volumeInfo']['categories']) ? $book['volumeInfo']['categories'] : null,
                'authors' => isset($book['volumeInfo']['authors']) ? $book['volumeInfo']['authors'] : null,
                'images' => isset($book['volumeInfo']['imageLinks']) ? $book['volumeInfo']['imageLinks'] : null,
                'isbn' => isset($book['volumeInfo']['industryIdentifiers']) ? $book['volumeInfo']['industryIdentifiers'] : null,
            ];
        }


        return response()->json($bookResponse);

    }


    private function getUrlWithQueryParams(Request $request): string|array
    {
        $title = $request->query('title');
        $author = $request->query('author');

        if(!$title) {
            return [];
        }

        if($author) {
            $url = "?q={$title}+inauthor:{$author}";
        } else {
            $url = "?q={$title}";
        }

        return $url;
    }


}
