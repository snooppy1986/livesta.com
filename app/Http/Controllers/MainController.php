<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Butschster\Head\Facades\Meta;

use Illuminate\Http\Request;
use function Symfony\Component\Console\Command\setDescription;

class MainController extends Controller
{
    public function index()
    {
        return view('main.index');
    }
}
