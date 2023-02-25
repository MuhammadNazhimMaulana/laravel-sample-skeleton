<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\ExampleInterface;

class ExampleController extends Controller
{
    public function __construct(ExampleInterface $exampleInterface)
    {
        $this->exampleInterface = $exampleInterface;
    }

    public function index()
    {
        return $this->exampleInterface->index();
    }
}
