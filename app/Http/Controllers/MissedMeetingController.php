<?php

namespace App\Http\Controllers;

use App\Mail\MissedMeetingMail;
use App\Models\MissedMeeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MissedMeetingController extends Controller
{
    public function store(Request $request)
    {
        if (auth()->user()->is_simran) {
            return response()->json([
                'status' => 'failed',
                'message' => "Simran, you can't mark yourself late to meetings",
            ], 403);
        }

        Mail::to([
            [
                'name' => config('mail.recipient.name'),
                'email' => config('mail.recipient.email'),
            ],
        ])->send(new MissedMeetingMail());

        MissedMeeting::create([
            'user_id' => auth()->user()->id,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Meeting has successfully been logged as missed',
        ]);
    }

    public function destroy(MissedMeeting $missedMeeting)
    {
        if (auth()->user()->is_simran) {
            return response()->json([
                'status' => 'failed',
                'message' => "Simran, you can't delete missed meetings",
            ], 403);
        }

        // Only the meeting owner can delete a meeting
        if ($missedMeeting->user->id !== auth()->user()->id) {
            return response()->json([
                'status' => 'failed',
                'message' => 'You are not authorized to delete this meeting',
            ], 403);
        }

        $missedMeeting->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Meeting removed',
        ]);
    }
}
