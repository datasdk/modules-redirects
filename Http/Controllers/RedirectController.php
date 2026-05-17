<?php

namespace Modules\Redirect\Http\Controllers;

use Orion\Http\Requests\Request;
use App\Http\Controllers\OrionBaseController;
use Modules\Redirect\Models\Redirect;
use Modules\Redirect\Http\Requests\RedirectRequest;
use Illuminate\Http\RedirectResponse;


class RedirectController extends OrionBaseController
{

    protected $model = Redirect::class;
    protected $request = RedirectRequest::class;

    /**
     * Display a listing of the resource.
     *
     * @param Request $req
     * @param mixed ...$args
     * @return \Illuminate\View\View
     */
    public function index(Request $req, ...$args)
    {
        return view('redirect::redirects.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $req
     * @param mixed ...$args
     * @return \Illuminate\View\View
     */
    public function create(Request $req, ...$args)
    {
        return view('redirect::redirects.create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $req
     * @param mixed ...$args
     * @return \Illuminate\View\View
     */
    public function edit(Request $req, ...$args)
    {

        $redirect = Redirect::findOrFail($args[0]);

        return view('redirect::redirects.edit', compact('redirect'));

    }

    /**
     * Display the specified resource.
     *
     * @param Request $req
     * @param mixed ...$args
     * @return \Illuminate\View\View
     */
    public function show(Request $req, ...$args)
    {

        $redirect = Redirect::findOrFail($args[0]);

        return view('redirect::redirects.show', compact('redirect'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $req
     * @param mixed ...$args
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $req, ...$args)
    {
        // Validation håndteres af OrionBaseController via RedirectRequest
        
        // Hent den validerede data fra request
        $data = $req->validated();
        
        // Opret en ny redirect
        $redirect = Redirect::create($data);
        
        return redirect()->route('redirect.index')
            ->with('success', 'Redirect created successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $req
     * @param mixed ...$args
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $req, ...$args)
    {
        $id = $args[0] ?? null;
        
        // Validation håndteres af OrionBaseController via RedirectRequest
        
        // Hent den validerede data fra request
        $data = $req->validated();
        
        // Find og opdater redirecten
        $redirect = Redirect::findOrFail($id);
        $redirect->update($data);
        
        return redirect()->route('redirect.index')
            ->with('success', 'Redirect updated successfully.');
    }

    /**
     * Handle redirect based on the given name or ID.
     *
     * @param Request $req
     * @param string|int $idOrName
     * @return \Illuminate\Http\Response
     */
    public function redirect(Request $req, $idOrName)
    {
        return $this->redirectAction($req, $idOrName);
    }

    public function redirectAction(Request $req, $idOrName)
    {
        // Initialize the URL variable
        $url = null;

        // Check if the $idOrName is numeric (id) or a string (name)
        if (is_numeric($idOrName)) {
            // If it's numeric, find by id
            $redirect = Redirect::find($idOrName);
            $url = $redirect ? $redirect->url : null; // Get the URL if found
        } else {
            // If it's a string, find by name
            $url = Redirect::getUrl($idOrName); // Assuming this method returns a URL string
        }

        // If a valid URL was found, proceed to redirect
        if ($url) {
            return $this->goToLandingPage($url);
        }

        // If no valid URL was found, return a 404 error
        abort(404, 'Redirect URL not found.');
    }

    /**
     * Redirect to the landing page with the provided URL.
     *
     * @param string $return_url
     * @return \Illuminate\View\View
     */
    private function goToLandingPage($return_url)
    {
        return redirect()->away($return_url);
    }
}
