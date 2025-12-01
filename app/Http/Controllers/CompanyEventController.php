<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class CompanyEventController extends Controller
{
    public function create()
    {
        return view('company.events.create');
    }

    //SIMPAN EVENT
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
            'date' => 'required',
            'time' => 'required',
            'quota' => 'required|integer',
        ]);
        //CREATE
        Event::create([
            'company_id' => auth('company')->id(),
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'date' => $request->date,
            'time' => $request->time,
            'quota' => $request->quota,
            'event_code' => 'E' . rand(100,999),
        ]);

        return redirect()->route('company.dashboard')->with('success', 'Event created!');
    }

    //HAPUS EVENT
    public function destroy($id)
    {
        Event::findOrFail($id)->delete();

        return redirect()->route('company.dashboard')
            ->with('success', 'Event deleted successfully!');
    }


    //EDIT EVENT
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('company.events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
            'date' => 'required|date',
            'time' => 'required',
            'quota' => 'required|integer|min:1',
        ]);

        $event = Event::findOrFail($id);

        $event->update([
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'date' => $request->date,
            'time' => $request->time,
            'quota' => $request->quota,
        ]);

        return redirect()->route('company.dashboard')
            ->with('success', 'Event updated successfully!');
    }

}
