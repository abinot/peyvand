<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class RedirectController extends Controller
{

    public function __invoke(Request $request, string $code): RedirectResponse
    {
        $link = Link::where('code', $code)->firstOrFail();

        abort_unless($link->isUsable(), 410); // لینک منقضی یا غیرفعال

        $link->increment('clicks');

        $link->clickLogs()->create([
            'ip_hash' => hash('sha256', $request->ip().config('app.key')),
            'user_agent' => str($request->userAgent())->limit(250, '')->toString(),
            'referer' => str((string) $request->headers->get('referer'))->limit(250, '')->toString() ?: null,
        ]);

        // 302 تا مرورگر ریدایرکت را کش نکند و کلیک‌ها شمرده شوند
        return redirect()->away($link->original_url, 302);
    }
}
