<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Storeeventuserimage;
use Illuminate\Http\Request;

class MaganageImageStatusController extends Controller
{
    public function image_index(Request $request)
    {
        $query = Storeeventuserimage::query();

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('fullname', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('mobile', 'like', "%{$search}%");
            });
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(10);
        $statusLabels = Storeeventuserimage::getStatusLabels();

        return view('admin.images_status.index', compact('users', 'statusLabels'));
    }

    // Individual approve
    public function image_approve($id)
    {
        try {
            $user = Storeeventuserimage::findOrFail($id);
            $user->status = Storeeventuserimage::STATUS_APPROVED;
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'User approved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error approving user'
            ], 500);
        }
    }

    // Individual reject
    public function image_reject($id)
    {
        try {
            $user = Storeeventuserimage::findOrFail($id);
            $user->status = Storeeventuserimage::STATUS_REJECTED;
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'User rejected successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error rejecting user'
            ], 500);
        }
    }

    public function image_bulkApprove(Request $request)
    {
        $request->validate([
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:storeeventuserimages,id'
        ]);

        try {


            $updated = Storeeventuserimage::whereIn('id', $request->user_ids)
                ->update([
                    'status' => Storeeventuserimage::STATUS_APPROVED,
                    'updated_at' => now()
                ]);



            return response()->json([
                'success' => true,
                'message' => "{$updated} users approved successfully"
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Error approving users'
            ], 500);
        }
    }

    public function image_bulkReject(Request $request)
    {
        $request->validate([
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:storeeventuserimages,id'
        ]);

        try {


            $updated = Storeeventuserimage::whereIn('id', $request->user_ids)
                ->update([
                    'status' => Storeeventuserimage::STATUS_REJECTED,
                    'updated_at' => now()
                ]);



            return response()->json([
                'success' => true,
                'message' => "{$updated} users rejected successfully"
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Error rejecting users'
            ], 500);
        }
    }


     public function image_updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:1,2,3'
        ]);

        try {
            $user = Storeeventuserimage::findOrFail($id);
            $user->status = $request->status;
            $user->save();

            $statusLabel = Storeeventuserimage::getStatusLabels()[$request->status];

            return response()->json([
                'success' => true,
                'message' => "User status updated to {$statusLabel}"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating status'
            ], 500);
        }
    }
}
