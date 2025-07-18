<?php

namespace App\Http\Controllers\Tenant\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class AdminEventController extends Controller
{
    public function index()
    {
        $events = Event::latest()->get();
        return tenant_view('admin.pages.events', compact('events'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'nullable|string|max:255',
            'start_date_time' => 'required|date',
            'end_date_time' => 'required|date|after:start_date_time',
        ]);

        $event = Event::create($validated);

        return response()->json([
            'success' => true,
            'event' => $event,
            'message' => 'Event created successfully!'
        ]);
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'nullable|string|max:255',
            'start_date_time' => 'required|date',
            'end_date_time' => 'required|date|after:start_date_time',
        ]);

        $event->update($validated);

        return response()->json([
            'success' => true,
            'event' => $event,
            'message' => 'Event updated successfully!'
        ]);
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return response()->json([
            'success' => true,
            'message' => 'Event deleted successfully!'
        ]);
    }
}
