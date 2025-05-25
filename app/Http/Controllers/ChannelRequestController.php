<?php

namespace App\Http\Controllers;

use App\Models\ChannelRequest;
use Illuminate\Http\Request;

class ChannelRequestController extends Controller
{
    /**
     * لیست تمام درخواست‌ها (مخصوص یوتیوبر برای بررسی).
     */
    public function index()
    {
        $requests = ChannelRequest::with('channel', 'user')->latest()->get();
        return response()->json($requests);
    }

    /**
     * ایجاد درخواست مدیریت کانال.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'channel_id' => 'required|exists:channels,id',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['status'] = 'pending';

        $request = ChannelRequest::create($validated);

        return response()->json(['message' => 'Request submitted successfully', 'data' => $request], 201);
    }

    /**
     * تایید درخواست توسط یوتیوبر.
     */
    public function approve(ChannelRequest $request)
    {
        $request->update(['status' => 'approved']);
        return response()->json(['message' => 'Request approved successfully']);
    }

    /**
     * رد کردن درخواست.
     */
    public function reject(ChannelRequest $request)
    {
        $request->update(['status' => 'rejected']);
        return response()->json(['message' => 'Request rejected']);
    }

    /**
     * حذف درخواست.
     */
    public function destroy(ChannelRequest $request)
    {
        $request->delete();
        return response()->json(['message' => 'Request deleted']);
    }
}
