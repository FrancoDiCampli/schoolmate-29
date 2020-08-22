<?php

namespace App\Http\Controllers;

use App\Traits\SearchTrait;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchJobs(Request $request)
    {
        return SearchTrait::searchJobs($request);
    }

    public function searchPosts(Request $request)
    {
        return SearchTrait::searchPosts($request);
    }

    public function searchDeliveries(Request $request)
    {
        return SearchTrait::searchDeliveries($request);
    }
}
