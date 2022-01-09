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
        $writer =  Writer::findOrFail($id);

        return $this->messageResponse('Show single', $data = $writer);
    }


    public function update(UpdateWriterRequest $request, $id)
    {
        $request->validated();
        $writer =  Writer::findOrFail($id);
        $writer->update($request->all());
        return $this->messageResponse('updated', $data = $writer);
    }

    public function destroy($id)
    {
        $writer =  Writer::findOrFail($id);
        $writer->delete();
        return $this->messageResponse('deleted');
    }

    public function messageResponse(string $message, int $status = 200, $data = null)
    {
        return response(
            [
                'message' => $message,
                'data' => $data ? new NameResource($data) : '',
            ],
            $status,
        );
    }
}
