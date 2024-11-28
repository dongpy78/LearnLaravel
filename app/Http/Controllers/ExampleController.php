<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleController extends Controller
{
    public function homePage()
    {
        $ourName = 'Van Dong';
        $animals = ['Meocon', 'Dog', 'Elephant'];
        return view('homepage', ['allAnimals' => $animals, 'name' => $ourName, 'catName' => "Meo Meo"]);
    }
    public function aboutPage()
    {
        return '<h1>About Page!!!!</h1><a href="/">Back to Homepage</a>';
    }
}
