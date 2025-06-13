<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Display;
use App\Http\Requests\StoreDisplayRequest;
use App\Http\Requests\UpdateDisplayRequest;
use Illuminate\Http\Request;

/**
 * Controller: DisplayController
 *
 * Manages CRUD operations for advertising displays.
 */
class DisplayController extends Controller
{
    use AuthorizesRequests;
    
    /**
     * List displays with optional filters and pagination.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $query = Display::where('user_id', auth()->id());

        if ($request->has('name')) {
            $query->where('name', 'like', '%'.$request->name.'%');
        }

        if ($request->has('type') && in_array($request->type, ['indoor', 'outdoor'])) {
            $query->where('type', $request->type);
        }

        $displays = $query->paginate(
            $request->input('perPage', 10),
            ['*'],
            'page',
            $request->input('page', 1)
        );

        return response()->json($displays);
    }

    /**
     * Show a specific display.
     *
     * @param Display $display
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Display $display)
    {
        $this->authorize('view', $display);
        return response()->json($display);
    }

    /**
     * Store a new display.
     *
     * @param StoreDisplayRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreDisplayRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $display = Display::create($data);
        return response()->json($display, 201);
    }

    /**
     * Update an existing display.
     *
     * @param UpdateDisplayRequest $request
     * @param Display $display
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateDisplayRequest $request, Display $display)
    {
        $this->authorize('update', $display);
        $display->update($request->validated());
        return response()->json($display);
    }

    /**
     * Delete a display.
     *
     * @param Display $display
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Display $display)
    {
        $this->authorize('delete', $display);
        $display->delete();
        return response()->json(null, 204);
    }
}
