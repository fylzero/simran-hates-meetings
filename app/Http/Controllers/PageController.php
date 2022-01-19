<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\MissedMeeting;

class PageController extends Controller
{
    public function home()
    {
        $missedMeetingsAll = MissedMeeting::count();
        $missedMeetingsDaysSince = ($missedMeetingsAll)
            ? MissedMeeting::daysSinceLast() : 'X';

        return Inertia::render('Dashboard', [
            'missedMeetingsAll' => $missedMeetingsAll,
            'missedMeetingsToday' => MissedMeeting::today()->count(),
            'missedMeetingsThisWeek' => MissedMeeting::thisWeek()->count(),
            'missedMeetingsThisMonth' => MissedMeeting::thisMonth()->count(),
            'missedMeetingsDaysSince' => $missedMeetingsDaysSince,
        ]);
    }

    public function shameLog()
    {
        return Inertia::render('ShameLog', [
            'missedMeetings' => MissedMeeting::latest()->with('user')->get(),
        ]);
    }
}