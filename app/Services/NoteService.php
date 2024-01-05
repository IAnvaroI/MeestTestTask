<?php

namespace App\Services;

use App\Models\Note;

class NoteService
{
    /**
     * Store a note in storage.
     */
    public static function store($user, array $fields)
    {
        return $user->notes()->create($fields);
    }

    /**
     * Update a note in storage.
     */
    public static function update(string $id, array $fields)
    {
        $note = Note::findOrFail($id);
        $note->fill($fields);
        $note->save();

        return $note;
    }

    /**
     * Delete a note from storage.
     */
    public static function delete(string $id)
    {
        $note = Note::findOrFail($id);
        $note->delete();
    }
}
