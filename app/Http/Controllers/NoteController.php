<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Http\Resources\NoteResource;
use App\Models\Note;
use App\Services\NoteService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    /**
     * Display a listing of the notes.
     */
    public function index()
    {
//        return response()->json([
//            'notes' => NoteResource::collection(Auth::user()->notes()->paginate(1))->response()->getData(),
////            'notes' => Auth::user()->notes()->paginate(1),
////            'notes' => Note::where('user_id', Auth::user()->id)->get(),
//        ]);

        return NoteResource::collection(Auth::user()->notes()->paginate(1));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNoteRequest $request): JsonResponse
    {
        $note = NoteService::store(Auth::user(), $request->toArray());

        if ($note) {
            return response()->json(['message' => 'Note created successfully', 'data' => $note]);
        }

        return response()->json(['message' => 'Note was not created'], 500);
    }

    /**
     * Display the note resource.
     */
    public function show(string $id)
    {
        return new NoteResource(Note::find($id));
    }

    /**
     * Update the specified note in storage.
     */
    public function update(UpdateNoteRequest $request, string $id): JsonResponse
    {
        $note = NoteService::update($id, $request->toArray());

        if ($note) {
            return response()->json(['message' => 'Note updated successfully', 'note' => $note]);
        }

        return response()->json(['message' => 'Note was not updated'], 500);
    }

    /**
     * Remove the specified note from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $status = NoteService::delete($id);

        if ($status) {
            return response()->json(['message' => 'Note deleted successfully']);
        }

        return response()->json(['message' => 'Note was not deleted'], 500);
    }
}
