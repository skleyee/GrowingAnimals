<?php

namespace App\Http\Controllers;

use App\Http\Resources\AnimalKindsResourse;
use App\Models\AnimalKinds;
use Illuminate\Http\Request;

class AnimalKindsController extends Controller
{
    public function index() {
        return AnimalKindsResourse::collection(AnimalKinds::all());
    }
}
