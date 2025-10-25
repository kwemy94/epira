<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Repositories\ContactRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    private $contactRepository;

    public function __construct(
        ContactRepository $contactRepository
    ){
        $this->contactRepository = $contactRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        try {
            $inputs = $request->all();
            // dd($inputs);
            DB::beginTransaction();
            $contact = $this->contactRepository->store($inputs);
            $contact->patient()->attach($inputs['patient_id']);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error("Erreur create contact : ".$th->getMessage());
            return redirect()->back()->with('error', 'Echec création contact');
        }
        return redirect()->back()->with('success', 'Contact crée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        //
    }
}
