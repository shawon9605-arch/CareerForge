<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use Illuminate\Http\Request;

class ResourceRecommendationController extends Controller
{
    public function index(Request $request)
    {
        $query = Resource::query();

        if ($request->search) {

            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('category', 'like', '%' . $request->search . '%')
                  ->orWhere('type', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        $resources = $query->get();

        return view(
            'resource-recommendation',
            compact('resources')
        );
    }

    // <-- এখানে add করবে

    public function category($category)
    {
        $resources = Resource::where(
            'category',
            urldecode($category)
        )->get();

        return view(
            'resource-recommendation',
            compact('resources')
        );
    }
}
