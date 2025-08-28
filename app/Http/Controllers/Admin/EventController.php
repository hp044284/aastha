<?php
namespace App\Http\Controllers\Admin;
use Exception;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\EventDataTable;
use App\Http\Requests\Event\StoreEventRequest;
use App\Http\Requests\Event\UpdateEventRequest;

class EventController extends Controller
{
    public function index(EventDataTable $dataTable)
    {
        try {
            return $dataTable->render('Admin.events.index');
        } catch (Exception $e) {
            return to_route('dashboard')->with('error', 'Failed to fetch events: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            return view('Admin.events.create');
        } catch (Exception $e) {
            return back()->with('error', 'Failed to load create form: ' . $e->getMessage());
        }
    }

    public function store(StoreEventRequest $request)
    {
        try 
        {
            $validated = $request->validated();
            $validated['status'] = $request->has('status') ? 1 : 0;
            
            Event::create($validated);
            return redirect()->route('events.index')->with('success', 'Event created successfully.');
        } 
        catch (Exception $e) 
        {
            return back()->withInput()->with('error', 'Failed to create event: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        try 
        {
            $event = Event::findOrFail($id);
            return view('Admin.events.show', compact('event'));
        } 
        catch (Exception $e) 
        {
            return back()->with('error', 'Failed to fetch event: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try 
        {
            $event = Event::findOrFail($id);
            return view('Admin.events.edit', compact('event'));
        } 
        catch (Exception $e) 
        {
            return back()->with('error', 'Failed to load edit form: ' . $e->getMessage());
        }
    }

    public function update(UpdateEventRequest $request, $id)
    {
        try 
        {
            $event = Event::findOrFail($id);
            $validated = $request->validated();
            $validated['status'] = $request->has('status') ? 1 : 0;
            $event->update($validated);
            return redirect()->route('events.index')->with('success', 'Event updated successfully.');
        } 
        catch (Exception $e) 
        {
            return back()->withInput()->with('error', 'Failed to update event: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try 
        {
            $event = Event::findOrFail($id);
            $event->delete();
            return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
        } 
        catch (Exception $e) 
        {
            return back()->with('error', 'Failed to delete event: ' . $e->getMessage());
        }
    }
}
