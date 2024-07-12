<?php

namespace App\Http\Controllers;

use App\Models\companies;
use Illuminate\Http\Request;

class companiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        if ($user->hasRole('admin')) {
            return companies::query()->get();
        }
        return response()->json(['message' => 'sorry Not Authonticated']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = $request->user();
        if ($user->hasRole('admin')) {
            $company = companies::create([
                'name' => $request->name,
            ]);
            return $company;
        } else {
            return response()->json(['message' => 'Not Authonticated sorry!']);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(companies $id, Request $request)
    {
        $user = $request->user();
        if ($user->hasRole('admin')) {
            $company = companies::query()->find($id);
            if (!$company) {
                return response()->json(['message' => 'Company not found'], 404);
            }
            return $company;
        } else {
            return response()->json(['message' => 'Not Authonticated sorry!']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(companies $companies, Request $request)
    {
        $user = $request->user();
        if ($user->hasRole('admin')) {
            $company = companies::find($request->id);
            if (!$company) {
                return response()->json(['message' => 'Company not found'], 404);
            }
            $company->update($request->all());
            return $company;
        } else {
            return response()->json(['message' => 'Not Authonticated sorry!']);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, companies $companies)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(companies $id, Request $request)
    {
        $user = $request->user();
        if ($user->hasRole('admin')) {
            $company = companies::find($id);
            if (!$company) {
                return response()->json(['message' => 'Company not found'], 404);
            }
            // $company->destroy();////////////////////////////////////////////////
            return response()->json(['message' => 'Company deleted successfully']);
        }
    }
}
