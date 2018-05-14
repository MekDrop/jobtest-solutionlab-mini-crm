<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests\EditCompanyRequest;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::paginate(10);

        return view('company.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  EditCompanyRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(EditCompanyRequest $request)
    {
        $company = new Company(
            $request->all()
        );
        $company->fill($request->all());
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $ext = $file->guessExtension();
            $filename = sha1(microtime(true)) . '.' . $ext;
            $file->move(storage_path('app/public'), $filename);
            $company->logo = $filename;
            Image::make(storage_path('app/public') . DIRECTORY_SEPARATOR . $filename)->resize(100, 100)->save(
                storage_path('app/public') . DIRECTORY_SEPARATOR . 'small_' . $filename
            );
        }
        $company->saveOrFail();
        return \Redirect::route('company.edit', compact('company'))->with('success', 'Saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        $employees = $company->employees()->paginate(10);
        return view('company.show', compact('company', 'employees'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EditCompanyRequest $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(EditCompanyRequest $request, Company $company)
    {
        $company->fill($request->all());
        if ($request->hasFile('logo')) {
            if ($company->logo) {
                File::delete([
                    storage_path('app/public') . DIRECTORY_SEPARATOR . $company->logo,
                    storage_path('app/public') . DIRECTORY_SEPARATOR . 'small_' . $company->logo
                ]);
            }
            $file = $request->file('logo');
            $ext = $file->guessExtension();
            $filename = sha1(microtime(true)) . '.' . $ext;
            $file->move(storage_path('app/public'), $filename);
            $company->logo = $filename;
            Image::make(storage_path('app/public') . DIRECTORY_SEPARATOR . $filename)->resize(100, 100)->save(
                storage_path('app/public') . DIRECTORY_SEPARATOR . 'small_' . $filename
            );
        }
        $company->saveOrFail();
        return \Redirect::route('company.edit', compact('company'))->with('success', 'Saved!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $file = $company->logo;
        $company->delete();
        File::delete([
            storage_path('app/public') . DIRECTORY_SEPARATOR . $file,
            storage_path('app/public') . DIRECTORY_SEPARATOR . 'small_'  . $file
        ]);
        return \Redirect::route('company.index')->with('success', 'Deleted!');
    }
}
