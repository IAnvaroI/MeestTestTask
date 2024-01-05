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
        return NoteResource::collection(Auth::user()->notes()->paginate(1));
    }

    /**
     * Store a newly created note in storage.
     */
    public function store(StoreNoteRequest $request): JsonResponse
    {
        $note = NoteService::store(Auth::user(), $request->toArray());

        return response()->json(['message' => 'Note created successfully', 'data' => $note]);
    }

    /**
     * Display the note.
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

        return response()->json(['message' => 'Note updated successfully', 'note' => $note]);
    }

    /**
     * Remove the specified note from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        NoteService::delete($id);

        return response()->json(['message' => 'Note deleted successfully']);
    }
}
