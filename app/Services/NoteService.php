<?php

namespace App\Services;

use App\Models\Note;
use Illuminate\Support\Facades\Log;
use Throwable;

class NoteService
{
    /**
     * Store a note in storage.
     */
    public static function store($user, array $fields)
    {
        try {
            return $user->notes()->create($fields);
        } catch (Throwable $e) {
            Log::error($e->getMessage() . "\n" . $e->getTraceAsString());

            return false;
        }
    }

    /**
     * Update a note in storage.
     */
    public static function update(string $id, array $fields)
    {
        try {
            $note = Note::findOrFail($id);
            $note->fill($fields);
            $note->save();

            return $note;
        } catch (Throwable $e) {
            Log::error($e->getMessage() . "\n" . $e->getTraceAsString());

            return false;
        }
    }

    /**
     * Delete a note from storage.
     */
    public static function delete(string $id): bool
    {
        try {
            $note = Note::findOrFail($id);
            $note->delete();

            return true;
        } catch (Throwable $e) {
            Log::error($e->getMessage() . "\n" . $e->getTraceAsString());

            return false;
        }
    }
}
