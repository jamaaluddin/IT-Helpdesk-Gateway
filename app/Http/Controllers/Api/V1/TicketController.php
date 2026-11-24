<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\JsonResponse;

class TicketController extends Controller
{
    public function index(): JsonResponse
    {
        $tickets = Ticket::query()
            ->select([
                'id',
                'ticket_number',
                'user_id',
                'office_id',
                'department_id',
                'category_id',
                'asset_id',
                'subject',
                'description',
                'priority',
                'status',
                'assigned_to',
                'assigned_at',
                'resolved_at',
                'closed_at',
                'created_at',
                'updated_at',
            ])
            ->orderByDesc('created_at')
            ->paginate(15);

        return response()->json([
            'success' => true,
            'message' => 'Ticket list retrieved successfully.',
            'data' => $tickets->items(),
            'meta' => [
                'current_page' => $tickets->currentPage(),
                'last_page' => $tickets->lastPage(),
                'per_page' => $tickets->perPage(),
                'total' => $tickets->total(),
            ],
        ]);
    }

    public function show(int $id): JsonResponse
    {
        $ticket = Ticket::query()
            ->select([
                'id',
                'ticket_number',
                'user_id',
                'office_id',
                'department_id',
                'category_id',
                'asset_id',
                'subject',
                'description',
                'priority',
                'status',
                'assigned_to',
                'assigned_at',
                'resolved_at',
                'closed_at',
                'created_at',
                'updated_at',
            ])
            ->findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Ticket detail retrieved successfully.',
            'data' => $ticket,
        ]);
    }
}
