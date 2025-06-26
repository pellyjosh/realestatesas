<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
// Make sure to import the Event model
use App\Models\Event; 
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        // Fetch all events from the database
        $events = Event::all(); 
        // Return the view and pass the events data to it
        return view('client.pages.events', compact('events'));
    }
}
