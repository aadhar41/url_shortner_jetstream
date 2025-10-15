<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ShortUrl;
use App\Http\Requests\ShortUrl\StoreShortUrlRequest;
use App\Http\Requests\ShortUrl\UpdateShortUrlRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request; // Added Request
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse; // Added for CSV download

class ShortUrlController extends Controller
{
    /**
     * Display a listing of the resource (Short URLs for the current company) with optional search and download.
     */
    public function index(Request $request): View|StreamedResponse // Accepts Request and can return View or StreamedResponse
    {
        $companyId = Auth::user()->company_id;
        $query = ShortUrl::where('company_id', $companyId);
        $searchTerm = $request->input('search');

        // Apply Search Filter
        if ($searchTerm) {
            $query->where(function ($q) use ($searchTerm) {
                // Search in both original URL and short code
                $q->where('original_url', 'like', '%' . $searchTerm . '%')
                  ->orWhere('short_code', 'like', '%' . $searchTerm . '%');
            });
        }

        // Handle CSV Download Request
        if ($request->get('download') === 'csv') {
            return $this->downloadCsv($query->get());
        }

        // Fetch paginated results for the view, preserving the search query in pagination links
        $shortUrls = $query->orderByDesc('created_at')->paginate(10)->withQueryString();

        return view('short_urls.index', compact('shortUrls', 'searchTerm'));
    }

    /**
     * Helper function to download short URLs as a CSV file.
     */
    protected function downloadCsv($shortUrls): StreamedResponse
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="short_urls_' . time() . '.csv"',
        ];

        $callback = function() use ($shortUrls) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Original URL', 'Short Code', 'Access Count', 'Is Active', 'Created At']);

            foreach ($shortUrls as $shortUrl) {
                fputcsv($file, [
                    $shortUrl->id,
                    $shortUrl->original_url,
                    url($shortUrl->short_code), // Full short URL
                    $shortUrl->access_count,
                    $shortUrl->is_active ? 'Active' : 'Inactive',
                    $shortUrl->created_at->toDateTimeString(),
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('short_urls.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreShortUrlRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        // Assign foreign keys and generate short code if not provided
        $validated['company_id'] = auth()->user()->company_id;
        $validated['user_id'] = Auth::id();

        if (empty($validated['short_code'])) {
            $validated['short_code'] = ShortUrl::generateUniqueShortCode();
        }

        ShortUrl::create($validated);

        return redirect()->route('web.short_urls.index')->with('success', 'Short URL created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ShortUrl $shortUrl): View
    {
        // Add authorization check here if necessary (e.g., must belong to company)
        return view('short_urls.show', compact('shortUrl'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ShortUrl $shortUrl): View
    {
        // Add authorization check here if necessary
        return view('short_urls.edit', compact('shortUrl'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShortUrlRequest $request, ShortUrl $shortUrl): RedirectResponse
    {
        $shortUrl->update($request->validated());

        return redirect()->route('web.short_urls.index')->with('success', 'Short URL updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShortUrl $shortUrl): RedirectResponse
    {
        // Add authorization check here if necessary
        $shortUrl->delete();

        return redirect()->route('web.short_urls.index')->with('success', 'Short URL deleted successfully.');
    }

    /**
     * Handle the public short link redirection.
     */
    public function redirect(string $shortCode): RedirectResponse
    {
        $shortUrl = ShortUrl::where('short_code', $shortCode)
                            ->where('is_active', true)
                            ->firstOrFail();

        // Increment access count
        $shortUrl->increment('access_count');

        return redirect($shortUrl->original_url);
    }
}