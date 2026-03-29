<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Models\Locale;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $localeId = $request->session()->get(Locale::ACTIVE_LOCALE);

        $reviews = Review::where('locale_id', $localeId)
            ->latest()
            ->paginate(20);

        return view('review.index', compact('reviews'));
    }

    public function store(StoreReviewRequest $request)
    {
        $data = $request->validated();
        $data['locale_id']    = $request->session()->get(Locale::ACTIVE_LOCALE);
        $data['is_published'] = $request->boolean('is_published', false);

        $review = Review::create($data);
        $review->locale->recalculateRating();

        return redirect()->back()->with('success', 'Avis ajouté avec succès.');
    }

    public function togglePublish(Review $review)
    {
        $review->update(['is_published' => !$review->is_published]);
        $review->locale->recalculateRating();

        return response()->json(['success' => true, 'is_published' => $review->is_published]);
    }

    public function destroy(Review $review)
    {
        $locale = $review->locale;
        $review->delete();
        $locale->recalculateRating();

        if (request()->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->back()->with('success', 'Avis supprimé.');
    }
}
