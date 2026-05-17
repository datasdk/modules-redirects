<?php

namespace Modules\Redirect\Http\Controllers;

use Orion\Http\Requests\Request;
use App\Http\Controllers\OrionBaseController;
use Modules\Redirect\Models\DeviceRedirect;
use Modules\Redirect\Http\Requests\DeviceRedirectRequest;
use Illuminate\Http\RedirectResponse;

class DeviceRedirectController extends OrionBaseController
{
    protected $model = DeviceRedirect::class;
    protected $request = DeviceRedirectRequest::class;

    /**
     * Display a listing of the resource.
     *
     * @param Request $req
     * @param mixed ...$args
     * @return \Illuminate\View\View
     */
    public function index(Request $req, ...$args)
    {
        return view('redirect::device_redirects.index');
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
        return view('redirect::device_redirects.create');
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
        $id = $args[0] ?? null;
        $deviceRedirect = DeviceRedirect::findOrFail($id);
        return view('redirect::device_redirects.edit', compact('deviceRedirect'));
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
        $id = $args[0] ?? null;
        $deviceRedirect = DeviceRedirect::findOrFail($id);
        return view('redirect::device_redirects.show', compact('deviceRedirect'));
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
        // Validering håndteres af DeviceRedirectRequest gennem OrionBaseController
        $validated = $req->validated();
        
        // Opret ny DeviceRedirect
        $deviceRedirect = DeviceRedirect::create($validated);
        
        return redirect()->route('device-redirects.index')
            ->with('success', 'Device redirect created successfully.');
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
        
        // Validering håndteres af DeviceRedirectRequest gennem OrionBaseController
        $validated = $req->validated();
        
        // Find og opdater DeviceRedirect
        $deviceRedirect = DeviceRedirect::findOrFail($id);
        $deviceRedirect->update($validated);
        
        return redirect()->route('device-redirects.index')
            ->with('success', 'Device redirect updated successfully.');
    }

    /**
     * Handle device redirect based on id or name and platform.
     * 
     * @param Request $req
     * @param string|int $idOrName
     * @return \Illuminate\Http\Response
     */
    public function redirect(Request $req, $idOrName)
    {
        // Determine the platform from request or user agent
        $platform = $req->input('platform', $this->getPlatform($req));

        // Check if $idOrName is numeric (id) or string (name)
        if (is_numeric($idOrName)) {
            // If it's numeric, find by id
            $deviceRedirect = DeviceRedirect::where('id', $idOrName)
                ->where('platform', $platform)
                ->first();

        } else {

            // If it's a string, find by name
            $deviceRedirect = DeviceRedirect::where('name', trim($idOrName))
                ->where('platform', $platform)
                ->first();
                
        }

        // Check if device redirect is found
        if (!$deviceRedirect) {
            
            $deviceRedirect = DeviceRedirect::where('name', trim($idOrName))
                ->where('platform', 'default')
                ->first();

        }

        if (!$deviceRedirect) {
            
            return $this->deviceRedirectNotFoundResponse();

        }
        

        // Redirect to the landing page
        return $this->goToLandingPage($deviceRedirect->url);
    }

    /**
     * Get platform from request or user agent.
     * 
     * @param Request $req
     * @return string
     */
    protected function getPlatform(Request $req)
    {
        // Default to user agent if platform isn't specified
        return $req->input('platform', $this->userAgent());
    }

  
    protected function goToLandingPage($url)
    {
    
        return redirect()->away($url);
             
    }

    /**
     * Return a 404 response when the device redirect is not found.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    protected function deviceRedirectNotFoundResponse()
    {
        abort(404, 'Device redirect not found.');
    }

    /**
     * Detect the platform based on the user agent.
     * 
     * @return string
     */
    protected function userAgent()
    {
        $userAgent = request()->userAgent();

        if (!$userAgent) {
            return 'unknown';
        }

        // iOS devices
        if (preg_match('/iPhone|iPad|iPod/i', $userAgent)) {
            return 'ios';
        }

        // Android devices
        if (preg_match('/Android/i', $userAgent)) {
            return 'android';
        }

        // Desktop browsers
        if (preg_match('/Windows|Macintosh|Linux/i', $userAgent)) {
            return 'web';
        }

        // Fallback
        return 'default';
    }
}