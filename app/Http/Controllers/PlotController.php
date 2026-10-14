<?php

namespace App\Http\Controllers;

use App\Models\Plot;
use Illuminate\Http\Request;

class PlotController extends Controller
{
    public function createPlot(Request $request){
        $validated = $request->validate([
            'name'=>'required|string|unique:plots,name',
            'longitude'=>'required|string',
            'latitude'=>'required|string',
            'water_rate'=>'required|numeric',
            'meter_number'=>'required|string|unique:plots,meter_number',
            'location_id'=> 'required|integer|exists:locations,id'
        ]);

        $plot = new Plot();
        $plot->name = $validated['name'];
        $plot->longitude = $validated['longitude'];
        $plot->latitude = $validated['latitude'];
        $plot->water_rate = $validated['water_rate'];
        $plot->meter_number = $validated['meter_number'];
        $plot->location_id = $validated['location_id'];


        try{
            $plot->save();
            return response()->json([
                'message' => 'Plot saved successfully',
                'plot'=>$plot
            ], 200);
        } catch(\Exception $e){
            return response()->json([
                'message'=>'Failed to save',
                'error'=>$e->getMessage()
            ], 500);
        }
    }

    public function readAllPlots(){
        try{
            $plots = Plot::all();
            return response()->json([
                'plots'=>$plots
            ], 200);
        } catch(\Exception $e){
            return response()->json([
                'message'=>'Failed to read all plots',
                'error'=>$e->getMessage()
            ], 500);
        }
    }

    public function readPlot($id){
        try{
            $plot = Plot::where('id', $id)->first();
            return response()->json([
                'plot'=>$plot
            ], 200);
        } catch(\Exception $e){
            return response()->json([
                'message'=>'Failed to fetch plot',
                'error'=>$e->getMessage()
            ], 500);
        }
    }

    public function updatePlot($id, Request $request){
        
        $validated = $request->validate([
            'name'=>'required|string|unique:plots,name',
            'longitude'=>'required|string',
            'latitude'=>'required|string',
            'water_rate' => 'required|numeric',
            'meter_number'=>'required|string:plots,meter_number',
            'location_id'=> 'required|integer|exists:locations,id'
        ]);

        $plot = Plot::where('id', $id)->first();
        $plot->name = $validated['name'];
        $plot->longitude = $validated['longitude'];
        $plot->latitude = $validated['latitude'];
        $plot->water_rate = $validated['water_rate'];
        $plot->meter_number = $validated['meter_number'];
        $plot->location_id = $validated['location_id'];


        try{
            $plot->save();
            return response()->json([
                'message' => 'Plot updated successfully',
                'plot'=>$plot
            ], 200);
        } catch(\Exception $e){
            return response()->json([
                'message'=>'Failed to update',
                'error'=>$e->getMessage()
            ], 500);
        }               
    }

    public function deletePlot($id){
        try{
            $plot = Plot::where('id', $id)->first();

            if(!$plot){
                return response()->json("Record does not exist");
            }

            $plot->delete();
            return response()->json("Plot deleted successfully");
        }catch(\Exception $e){
            return response()->json([
                'message'=>'Failed to delete',
                'error'=>$e->getMessage()
            ], 500);
        }
    }

    public function searchPlot($name){
        try{
            $plots = Plot::where('id', 'LIKE', "%{$name}%")->get();
            return response()->json([
                'plots'=>$plots
            ], 200);
        } catch(\Exception $e){
            return response()->json([
                'message'=>'Failed to search plot',
                'error'=>$e->getMessage()
            ], 500);
        }
    }
}
