<?php

namespace App\Http\Controllers;

use App\Http\Resources\AnimalKindsResourse;
use App\Http\Resources\AnimalResource;
use App\Models\Animal;
use App\Models\AnimalKinds;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnimalController extends Controller
{
    public function createAnimal(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'kind' => 'required|max:255',
        ]);

        $isValidate = !$validator->fails() ?? false;

        if (!in_array($request->kind, AnimalKinds::getAllKinds())) {
            $isValidate = false;
        }

        if ($isValidate) {
            Animal::create($request->all());
        }

        return [
            'error'=> $isValidate ? null : $validator->errors(),
            'data' => $isValidate ? 'ok' : 'not ok'
        ];
    }

    public function getAnimal($name) {
        $data = AnimalResource::collection(Animal::where('name', $name)->get());
        return count($data) !== 0 ? $data : 'not found';
    }

    public function makeAnimalOlder(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        $isValidate = !$validator->fails() ?? false;


        $isAnimalExist = Animal::checkExistingAnimalByName($request->name);
        if ($isValidate && $isAnimalExist) {
            if (isset($request->growth_factor)) {
                Animal::makeAnimalOlderAndBiggerByName($request->name, $request->growth_factor);
            } else {
                Animal::makeAnimalOlderByName($request->name);
            }
        }

        return [
            'error'=> $isValidate ? null : $validator->errors(),
            'data' => $isValidate && $isAnimalExist ? 'ok' : 'not ok'
        ];
    }
    public function truncateAnimalsTable() {
        Animal::truncate();
    }
}
