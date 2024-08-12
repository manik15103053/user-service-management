<?php

namespace App\Http\Controllers;

use App\Models\Selected;
use App\Models\UserTable;
use App\Models\Unselected;
use App\Models\ServiceName;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $user = new UserTable;
        $user->username = $request->username;
        $user->service_id = $request->service_id;
        $user->save();

        if ($user->service_id) {
            $selectedService = new Selected;
            $selectedService->user_id = $user->id;
            $selectedService->service_id = $user->service_id;
            $selectedService->save();
        } else {
            $services = ServiceName::all();
            foreach ($services as $service) {
                $unselectedService = new Unselected;
                $unselectedService->service_id = $service->id;
                $unselectedService->save();
            }
        }

        return response()->json(['success' => true]);
    }

    public function edit($id)
    {
        $user = UserTable::find($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $user = UserTable::findOrFail($id);
        $user->username = $request->username;
        if ($request->service_id) {
            $user->service_id = $request->service_id;
            Selected::updateOrCreate(
                ['user_id' => $user->id],
                ['service_id' => $request->service_id]
            );
        }
        $user->save();

        return response()->json(['success' => true, 'user' => $user]);

}

    public function destroy($id)
    {
        $user = UserTable::findOrFail($id);
        $user->delete();
        return response()->json(['success' => true]);
    }

    public function checkMatchingService($userId)
    {
        $selectedService = Selected::where('user_id', $userId)->first();
        if(!$selectedService){
            return response()->json(['matched' => false, 'message' => 'No service selected by the user']);
        }
        $unselectedServices = Unselected::all();

        foreach ($unselectedServices as $unselectedService) {
            // dd($unselectedService->service_id);
            if ($selectedService->service_id == $unselectedService->service_id) {
                return response()->json(['matched' => true, 'message' => 'Matched']);
            }
        }

        return response()->json(['matched' => false, 'message' => 'No match found']);
    }
}
