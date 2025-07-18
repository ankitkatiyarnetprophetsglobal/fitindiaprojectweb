<?php

namespace App\Http\Controllers\Admin\Auth\QuizMaster;
use App\Models\QuizmasterModel\SocEventMaster;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SocEventMasterController extends Controller
{
    // List all versions
public function index()
    {
        $events = SocEventMaster::paginate(10);
        return view('admin.Quizmaster.soc_events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.Quizmaster.soc_events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'venue' => 'required|string',
            'cycle' => 'required|integer',
            't_shirt' => 'required|integer',
            'meal' => 'nullable|integer',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'event_date' => 'required|date_format:Y-m-d',
            'status' => 'required|boolean',
        ]);

        SocEventMaster::create($request->all());

        return redirect()->route('admin.soc-events.index')->with('success', 'Event Created Successfully.');
    }

    public function edit(SocEventMaster $soc_event)
    {
        return view('admin.Quizmaster.soc_events.edit', compact('soc_event'));
    }

    public function update(Request $request, SocEventMaster $soc_event)
    {
        $request->validate([
            'venue' => 'required|string',
            'cycle' => 'required|integer',
            't_shirt' => 'required|integer',
            'meal' => 'nullable|integer',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'event_date' => 'required|date_format:Y-m-d',
            'status' => 'required|boolean',
        ]);

        $soc_event->update($request->all());

        return redirect()->route('admin.soc-events.index')->with('success', 'Event Updated Successfully.');
    }

    public function destroy(SocEventMaster $soc_event)
    {
        $soc_event->delete();
        return redirect()->route('admin.soc-events.index')->with('success', 'Event Deleted Successfully.');
    }

}
