<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HandleBotRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $userAgent = $request->header('User-Agent', '');
        
        // Check if this is a bot request
        $isBotRequest = $this->isBotRequest($userAgent);
        
        if ($isBotRequest) {
            // Log bot requests for debugging
            Log::info('Bot request detected', [
                'user_agent' => $userAgent,
                'url' => $request->fullUrl(),
                'ip' => $request->ip()
            ]);
            
            // Check if bot is trying to access invalid product URLs
            if ($request->is('products/*')) {
                $slug = $request->segment(2);
                
                // If the slug looks like an image file, return 404 instead of 500
                if (preg_match('/\.(jpg|jpeg|png|gif|webp|svg|bmp|tiff)$/i', $slug)) {
                    Log::warning('Bot trying to access image as product', [
                        'user_agent' => $userAgent,
                        'slug' => $slug,
                        'url' => $request->fullUrl()
                    ]);
                    
                    abort(404, 'Not Found');
                }
            }
        }
        
        return $next($request);
    }
    
    /**
     * Check if the request is from a bot/crawler
     */
    private function isBotRequest($userAgent)
    {
        $bots = [
            'facebookexternalhit', 'Facebot', 'Twitterbot', 'LinkedInBot',
            'WhatsApp', 'TelegramBot', 'SkypeUriPreview', 'SlackBot',
            'Instagram', 'Googlebot', 'Bingbot', 'YandexBot', 'DuckDuckBot',
            'ia_archiver', 'Baiduspider', 'YahooSeeker', 'MJ12bot',
            'SemrushBot', 'AhrefsBot', 'DotBot', 'CCBot', 'BLEXBot',
            'SiteAuditBot', 'crawler', 'spider', 'bot/'
        ];
        
        foreach ($bots as $bot) {
            if (stripos($userAgent, $bot) !== false) {
                return true;
            }
        }
        
        return false;
    }
}
