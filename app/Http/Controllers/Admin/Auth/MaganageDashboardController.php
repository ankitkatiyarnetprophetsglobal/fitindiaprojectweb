<?php
namespace App\Http\Controllers\Admin\Auth;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Models\DashboardTile;
use Illuminate\Http\Request;

class MaganageDashboardController extends Controller
{
    public function index()
    {
        
        $tiles = DashboardTile::orderBy('id', 'asc')->paginate(10);
        return view('admin.dashboard_tiles.index', compact('tiles'));
    }

    public function create()
    {
        return view('admin.dashboard_tiles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        DashboardTile::create($request->only('title', 'description'));

        return redirect()->route('admin.dashboard-tiles.index')->with('success', 'Tile created successfully!');
    }

    public function edit(DashboardTile $dashboardTile)
    {
        return view('admin.dashboard_tiles.edit', compact('dashboardTile'));
    }

    public function update(Request $request, DashboardTile $dashboardTile)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $dashboardTile->update($request->only('title', 'description'));

        return redirect()->route('admin.dashboard-tiles.index')->with('success', 'Tile updated successfully!');
    }

    public function destroy(DashboardTile $dashboardTile)
    {
        $dashboardTile->delete();
        return redirect()->route('dashboard-tiles.index')->with('success', 'Tile deleted successfully!');
    }
}
