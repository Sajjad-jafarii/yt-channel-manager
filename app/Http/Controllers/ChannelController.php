<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    /**
     * نمایش لیست کانال‌های کاربر جاری.
     */
    public function index()
    {
        $channels = auth()->user()->channels()->latest()->get();
        return response()->json($channels);
    }

    /**
     * چون API داریم، نیازی به فرم ایجاد نیست.
     */
    public function create()
    {
        return response()->json(['message' => 'Form creation not available in API.'], 405);
    }

    /**
     * ذخیره‌ی کانال جدید.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'youtube_link' => 'nullable|url',
            'category' => 'nullable|string',
        ]);

        $channel = auth()->user()->channels()->create($validated);

        return response()->json($channel, 201);
    }

    /**
     * نمایش اطلاعات یک کانال خاص.
     */
    public function show(Channel $channel)
    {
        $this->authorize('view', $channel);
        return response()->json($channel);
    }

    /**
     * چون API داریم، نیازی به فرم ویرایش نیست.
     */
    public function edit(Channel $channel)
    {
        return response()->json(['message' => 'Form editing not available in API.'], 405);
    }

    /**
     * بروزرسانی اطلاعات کانال.
     */
    public function update(Request $request, Channel $channel)
    {
        $this->authorize('update', $channel);

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'youtube_link' => 'nullable|url',
            'category' => 'nullable|string',
        ]);

        $channel->update($validated);

        return response()->json($channel);
    }

    /**
     * حذف کانال.
     */
    public function destroy(Channel $channel)
    {
        $this->authorize('delete', $channel);

        $channel->delete();

        return response()->json(['message' => 'Channel deleted successfully.']);
    }
}
