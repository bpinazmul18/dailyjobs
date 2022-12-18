<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    // Show all listings
    public function index () {
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->get()
        ]);
    }

    // Show single listing
    public function show (Listing $listing) {
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    // Create single listing
    public function create(Listing $listing) {
        return view('listings.create');
    }

    // Store listing data
    public function store(Request $request) {
        $validateData = $request->validate([
            'company' => [
                'required',
                Rule::unique('listings', 'company'),
            ],
            'title' => 'required',
            'location'=> 'required',
            'email' => [ 'required', 'email'],
            'website'=> 'required',
            'tags' => 'required',
            'description' => 'required'
        ]);

        Listing::create($validateData);
        
        return redirect('/');
    }
}