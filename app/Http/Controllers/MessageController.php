<?php

namespace App\Http\Controllers;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Models\Message;

use Stancl\Tenancy\Database\Models\Tenant;
use Stancl\Tenancy\Facades\Tenancy;


class MessageController extends Controller
{
    // عرض الرسائل
    public function index()
    {
        $sub = Subscription::where('tenant_id', tenant('id'))->first();

if (!$sub || now()->gt($sub->expires_at)) {
    abort(403, 'Subscription expired');
}
        $tenant = Tenant::find('company1'); // 
Tenancy::initialize($tenant);
        $messages = Message::where('tenant_id', 'company1')->get(); // مؤقت
        return view('messages.index', compact('messages'));
    }

    // إرسال رسالة
    public function send(Request $request)
    {
        $sub = Subscription::where('tenant_id', tenant('id'))->first();

if (!$sub || now()->gt($sub->expires_at)) {
    abort(403, 'Subscription expired');
}
        $tenant = Tenant::find('company1'); // 
Tenancy::initialize($tenant);
        Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'content' => $request->content,
            'tenant_id' => 'company1' // مؤقت
        ]);

        return back();
    }
}