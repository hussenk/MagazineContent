<?php

namespace App\Http\Controllers;

use App\Models\Magazine;
use App\Http\Requests\StoreMagazineRequest;
use App\Http\Requests\UpdateMagazineRequest;
use App\Http\Resources\MagazineResource;

class MagazineController extends Controller
{

    public function index()
    {
        $magazine =  Magazine::pagnaite(10);
        return MagazineResource::collection($magazine);
    }

    public function store(StoreMagazineRequest $request)
    {
        $input = $request->validate();
        $magazine = Magazine::create($input);

        return $this->messageResponse('created', 201, $magazine);
    }


    public function show($id)
    {
        $magazine = Magazine::findOrFail($id);
        return $this->messageResponse('Show single', $data = $magazine);
    }

    public function update(UpdateMagazineRequest $request, $id)
    {
        $input = $request->validate();

        $magazine = Magazine::findOrFail($id);
        $magazine->update($input);

        return $this->messageResponse('Updated', $data = $magazine);
    }

    public function destroy($id)
    {
        $magazine = Magazine::findOrFail($id);
        $magazine->delete();

        return $this->messageResponse('deleted');
    }


    public function messageResponse(string $message, int $status = 200, $data = null)
    {
        return response([
            'data' => $data ? new MagazineResource($data) : '',
            'message' => $message,
        ], $status);
    }
}
