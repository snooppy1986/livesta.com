<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Butschster\Head\Facades\Meta;

use Illuminate\Http\Request;
use function Symfony\Component\Console\Command\setDescription;

class MainController extends Controller
{
    /*protected $meta;
    public function __construct(MetaInterface $meta)
    {
        $this->meta = $meta;
    }*/

    public function index()
    {
        return view('main.index');
    }
}
