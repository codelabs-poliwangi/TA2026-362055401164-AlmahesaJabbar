<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Berita;
use App\Models\KategoriBerita;
use App\Helpers\SecurityHelper;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class SecurityHardeningTest extends TestCase
{
    /**
     * Test HTML Sanitizer (XSS prevention).
     */
    public function test_html_sanitizer_removes_xss_payloads(): void
    {
        $dirtyHtml = '<p>Hello</p><script>alert("XSS")</script><img src="x" onerror="alert(\'XSS\')"><a href="javascript:alert(1)">Click</a><iframe src="evil.html"></iframe>';
        $cleanHtml = SecurityHelper::sanitizeHtml($dirtyHtml);

        $this->assertStringNotContainsString('<script>', $cleanHtml);
        $this->assertStringNotContainsString('onerror', $cleanHtml);
        $this->assertStringNotContainsString('javascript:', $cleanHtml);
        $this->assertStringNotContainsString('<iframe>', $cleanHtml);
        $this->assertStringContainsString('<p>Hello</p>', $cleanHtml);
    }

    /**
     * Test Double Extension File Upload block.
     */
    public function test_double_extension_file_is_blocked(): void
    {
        $file = UploadedFile::fake()->create('dokumen.pdf.php', 10, 'application/pdf');
        $this->assertTrue(SecurityHelper::hasDoubleExtension($file));

        $file2 = UploadedFile::fake()->create('photo.png.html', 10, 'image/png');
        $this->assertTrue(SecurityHelper::hasDoubleExtension($file2));

        $safeFile = UploadedFile::fake()->create('revisi_laporan.pdf', 10, 'application/pdf');
        $this->assertFalse(SecurityHelper::hasDoubleExtension($safeFile));
    }

    /**
     * Test Spoofed file upload block (disguised PHP script).
     */
    public function test_spoofed_file_content_is_detected(): void
    {
        $file = UploadedFile::fake()->create('photo.jpg', 10, 'image/jpeg');
        file_put_contents($file->getRealPath(), '<?php echo "dangerous script"; ?>');
        
        $this->assertTrue(SecurityHelper::isSpoofedFile($file));

        $safeFile = UploadedFile::fake()->create('photo_real.jpg', 10, 'image/jpeg');
        file_put_contents($safeFile->getRealPath(), "\xFF\xD8\xFF\xE0\x00\x10JFIF\x00\x01\x01\x01\x00\x60\x00\x60\x00\x00Real JPG Content");

        $this->assertFalse(SecurityHelper::isSpoofedFile($safeFile));
    }

    /**
     * Test that basic SQL Injection attempts in searches do not throw database errors.
     */
    public function test_sql_injection_attempt_returns_empty_or_safe_results_without_error(): void
    {
        // Eloquent/PDO should handle prepared statements correctly
        $response = $this->get('/search?search=\' OR \'1\'=\'1');
        $response->assertStatus(200);

        $response2 = $this->get('/search?search=UNION SELECT username, password FROM users');
        $response2->assertStatus(200);
    }
}
