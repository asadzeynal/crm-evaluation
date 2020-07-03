<?php

namespace App\Http\Controllers;

use App\Company;
use App\Mail\CompanyCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CompanyController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        
        $companies = Company::paginate(6);

        return view('companies.index', [
            'companies' => $companies,
        ]);
    }

    public function show($id) {
        $company = Company::findOrFail($id);
        $company->employees = $company->employees()->paginate(10);

        return view('companies.show', ['company' => $company]);
    }

    public function create() {
        return view('companies.create');
    }

    public function store(Request $request) {
        $request->merge(['website' => $request->protocol.$request->website]);
        $validatedData = $request->validate([
           'name'=>'required|unique:companies|max:255', 
           'email'=>'email|max:255', 
           'website'=>'url|max:255',
           'logo'=>'image|mimes:jpeg,png|dimensions:min_width=100,min_height=100'
        ]);

        $company = new Company();
        $company->name = request('name');
        $company->email = request('email');
        $company->website = request('website');
        $company->logo = basename(request('logo')->store('public/logos'));
        $company->save();
        return redirect('/home') -> with('mssg', 'Company has been created');
    }

    public function destroy($id) {
        $company = Company::findOrFail($id);
        $company->delete();

        return redirect('/home') -> with('mssg', 'Company has been deleted');
    }

    public function edit($id) {
        $company = Company::findOrFail($id);
        $company->website = substr($company->website, strpos($company->website, '://') + 3);
        return view('companies.edit', ['company' => $company]);
    }
    
    public function update($id) {
        request()->merge(['website' => request()->protocol.request()->website]);
        $validatedData = request()->validate([
           'name'=>'required|unique:companies|max:255', 
           'email'=>'email|unique:companies|max:255', 
           'website'=>'url|max:255',
           'logo'=>'image|mimes:jpeg,png|dimensions:min_width=100,min_height=100'
        ]);
        $data = request()->only(['name', 'email', 'website', 'logo']);
        if(request()->logo != null ) {
            $data['logo'] = basename(request('logo')->store('public/logos'));
        }
        Company::where('id', $id)->update($data);
        $company = Company::findOrFail($id);
        $company->employees = $company->employees()->paginate(10);
        return view('companies.show', ['company' => $company]);
    }
}
