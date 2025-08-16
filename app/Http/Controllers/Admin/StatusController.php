<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class StatusController extends Controller
{
    public function index($model, $id, Request $request)
    {
        try 
        {
            // Convert URL segment to model class name
            $modelClass = 'App\\Models\\' . Str::studly(Str::singular($model));

            if (!class_exists($modelClass)) 
            {
                return response()->json(['message' => 'Invalid model'], 400);
            }

            $record = $modelClass::findOrFail($id);
            $record->status = $request->status;
            $record->save();

            return response()->json(['message' => 'Status updated successfully']);
        } 
        catch (\Exception $e) 
        {
            return response()->json([
                'message' => 'Failed to update status',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
