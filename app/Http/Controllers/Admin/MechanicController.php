<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mechanic;
use App\Models\User;

class MechanicController extends Controller
{
    public function index()
    {
        $mechanics = Mechanic::withCount('maintenances')
            ->with(['user:id,name,email'])
            ->orderBy('maintenances_count','desc')
            ->paginate(12);

        return view('backend.admin.mechanics.index', compact('mechanics'));
    }

    public function create()
    {
        // choose from users with role=mechanic that aren’t already linked
        $availableUsers = User::where('role','mechanic')
            ->whereDoesntHave('mechanic')->orderBy('name')->get(['id','name','email']);
        return view('backend.admin.mechanics.create', compact('availableUsers'));
    }

    public function store()
    {
        $data = request()->validate([
            'user_id'       => ['required','exists:users,id'],
            'phone'         => ['nullable','string','max:100'],
            'specialization'=> ['nullable','string','max:150'],
        ]);
        Mechanic::create($data);
        return redirect()->route('admin.mechanics.index')->with('status','Mechanic added.');
    }

    public function show(Mechanic $mechanic)
    {
        $mechanic->load(['user:id,name,email', 'maintenances' => function ($q) {
            $q->with(['vehicle:id,plate_number,make,model'])->latest();
        }]);

        return view('backend.admin.mechanics.show', compact('mechanic'));
    }

    public function edit(Mechanic $mechanic)
    {
        return view('backend.admin.mechanics.edit', compact('mechanic'));
    }

    public function update(Mechanic $mechanic)
    {
        $data = request()->validate([
            'phone'         => ['nullable','string','max:100'],
            'specialization'=> ['nullable','string','max:150'],
        ]);
        $mechanic->update($data);
        return back()->with('status','Mechanic updated.');
    }

    public function destroy(Mechanic $mechanic)
    {
        $mechanic->delete();
        return redirect()->route('admin.mechanics.index')->with('status','Mechanic removed.');
    }
}
