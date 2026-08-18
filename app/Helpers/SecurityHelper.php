<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;

class SecurityHelper
{
    /**
     * Sanitize HTML content to prevent XSS.
     */
    public static function sanitizeHtml(?string $html): string
    {
        if (empty($html)) {
            return '';
        }

        // 1. Remove script tags and their content
        $html = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $html);

        // 2. Remove inline event handlers (onerror, onload, onclick, etc.)
        $html = preg_replace('/\bon[a-z]+\s*=\s*("[^"]*"|\'[^\']*\'|[^\s>]*)/i', '', $html);

        // 3. Remove javascript: pseudo-protocol in href or src
        $html = preg_replace('/href\s*=\s*["\']?\s*javascript:[^"\'>]*["\']?/i', 'href="#"', $html);
        $html = preg_replace('/src\s*=\s*["\']?\s*javascript:[^"\'>]*["\']?/i', 'src="#"', $html);

        // 4. Remove dangerous tags (iframe, object, embed, applet, meta, link, style)
        $html = preg_replace('/<\/?(iframe|object|embed|applet|meta|link|style)\b[^>]*>/is', '', $html);

        return $html;
    }

    /**
     * Check if the uploaded file has a double extension or blacklisted extensions.
     */
    public static function hasDoubleExtension(UploadedFile $file): bool
    {
        $originalName = $file->getClientOriginalName();
        
        // Match dangerous extensions anywhere in the filename
        if (preg_match('/\.(php|phtml|php3|php4|php5|php7|phtm|html|htm|js|exe|bat|sh)/i', $originalName)) {
            return true;
        }

        // Match multiple extensions pattern, e.g., name.pdf.jpg or name.png.php
        $parts = explode('.', $originalName);
        if (count($parts) > 2) {
            // Check if any intermediate part contains dangerous extension suffixes
            $dangerous = ['php', 'phtml', 'html', 'htm', 'js', 'exe', 'sh', 'bat'];
            for ($i = 1; $i < count($parts) - 1; $i++) {
                if (in_array(strtolower($parts[$i]), $dangerous)) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Check if the file content contains script tags disguised in images or other formats.
     */
    public static function isSpoofedFile(UploadedFile $file): bool
    {
        $realPath = $file->getRealPath();
        if (!file_exists($realPath)) {
            return false;
        }

        $content = @file_get_contents($realPath, false, null, 0, 8192); // Read first 8KB
        if ($content === false) {
            return false;
        }

        // Detect PHP tags or script tags in the content
        if (stripos($content, '<?php') !== false || 
            stripos($content, '<?=') !== false ||
            stripos($content, '<script') !== false ||
            preg_match('/<script\b[^>]*>(.*?)<\/script>/is', $content)) {
            return true;
        }

        return false;
    }
}
