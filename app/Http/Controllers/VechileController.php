<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
class VechileController extends Controller
{
      // Get all vehicles
      public function index()
      {
        $vehicles = Vehicle::paginate(10); // Paginate 10 vehicles per page
         return response()->json($vehicles);
      }
  
      // Store a new vehicle
      public function store(Request $request)
      {
          $validatedData = $request->validate([
              'make' => 'required|string|max:255',
              'model' => 'required|string|max:255',
              'year' => 'required|integer',
              'license_plate' => 'required|string|max:255|unique:vehicles',
          ]);
  
          $vehicle = Vehicle::create($validatedData);
  
          return response()->json($vehicle, 201);
      }
  
      // Show a specific vehicle
      public function show($id)
      {
          $vehicle = Vehicle::find($id);
  
          if (!$vehicle) {
              return response()->json(['message' => 'Vehicle not found'], 404);
          }
  
          return response()->json($vehicle);
      }
  
      // Update a vehicle
      public function update(Request $request, $id)
      {
          $vehicle = Vehicle::find($id);
  
          if (!$vehicle) {
              return response()->json(['message' => 'Vehicle not found'], 404);
          }
  
          $validatedData = $request->validate([
              'make' => 'string|max:255',
              'model' => 'string|max:255',
              'year' => 'integer',
              'license_plate' => 'string|max:255|unique:vehicles,license_plate,' . $id,
          ]);
  
          $vehicle->update($validatedData);
  
          return response()->json($vehicle);
      }
  
      // Delete a vehicle
      public function destroy($id)
      {
          $vehicle = Vehicle::find($id);
  
          if (!$vehicle) {
              return response()->json(['message' => 'Vehicle not found'], 404);
          }
  
          $vehicle->delete();
  
          return response()->json(['message' => 'Vehicle deleted successfully']);
      }
}
