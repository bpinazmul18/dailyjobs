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
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(6)
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

        if ($request->hasFile('logo')) {
            $validateData['logo'] = $request->file('logo')->store('logos', 'public');
        }


        $validateData['user_id'] = auth()->id();

        Listing::create($validateData);
        
        return redirect('/')->with('message', 'Listing created successfully.');
    }

    // Manage listings
    public function manage () {
        return view('listings.manage', [
            'listings' => auth()->user()->listings()->get()
        ]);
    }

    // Show Listings Edit Form
    public function edit (Listing $listing) {
        return view('listings.edit', [
            'listing' => $listing
        ]);
    }

        // Update listing data
        public function update(Request $request, Listing $listing) {
            if ($listing->user_id != auth()->id()) {
                abort(403, 'Unauthorized action!');
            }

            $validateData = $request->validate([
                'company' => ['required'],
                'title' => 'required',
                'location'=> 'required',
                'email' => [ 'required', 'email'],
                'website'=> 'required',
                'tags' => 'required',
                'description' => 'required'
            ]);
    
            if ($request->hasFile('logo')) {
                $validateData['logo'] = $request->file('logo')->store('logos', 'public');
            }
    
    
            $validateData['user_id'] = auth()->id();
    
            $listing->update($validateData);
            
            return redirect('/')->with('message', 'Listing Updated successfully.');
        }
}