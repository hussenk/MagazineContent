<?php

namespace App\Http\Controllers;

use App\Models\Writer;
use App\Http\Requests\StoreWriterRequest;
use App\Http\Requests\UpdateWriterRequest;
use App\Http\Resources\NameResource;

class WriterController extends Controller
{

    public function index()
    {
        return NameResource::collection(Writer::all());
    }


    public function store(StoreWriterRequest $request)
    {
        $request->validated();
        $writer = Writer::create($request->all());
        return $this->messageResponse('created', 201, $writer);
    }


    public function show($id)
    {
        $date =  Writer::findOrFail($id);

        return $this->messageResponse('Show single', $date = $date);
    }


    public function update(UpdateWriterRequest $request, $id)
    {
        $request->validated();
        $date =  Writer::findOrFail($id);
        $date->update($request->all());
        return $this->messageResponse('updated', $date = $date);
    }

    public function destroy($id)
    {
        $date =  Writer::findOrFail($id);
        $date->delete();
        return $this->messageResponse('deleted');
    }

    public function messageResponse(string $message, int $status = 200, $date = null)
    {
        return response(
            [
                'message' => $message,
                'data' => $date ? new NameResource($date) : '',
            ],
            $status,
        );
    }
}
