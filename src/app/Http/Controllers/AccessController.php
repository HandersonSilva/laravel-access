<?php

namespace SecurityTools\LaravelAccess\Http\Controllers;

use SecurityTools\LaravelAccess\Http\Requests\AccessRequest\SendCodeRequest;
use SecurityTools\LaravelAccess\Http\Requests\AccessRequest\ValidateCodeRequest;
use SecurityTools\LaravelAccess\Services\AccessService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AccessController extends Controller
{

    public function __construct(
        private readonly AccessService $accessService)
    {
    }

    /**
     * Index
     */
    public function index(): View
    {
        if(session()->has('message')) {
            return view('vendor.laravel-access.access.index')->with(
                'message', session('message')
            );
        }

        return view('vendor.laravel-access.access.index');
    }

    /**
     * Send code
     */
    public function sendCode(SendCodeRequest $request): View|RedirectResponse
    {
        try {
            [$formId, $nonce] = $this->accessService->generateAuth($request->validated()['email']);

            return view('vendor.laravel-access.access.send_code', compact(
                'nonce',
                'formId'
            ));
        } catch (\Exception $e) {
            \Log::error('Error validate code: '.$e->getMessage());
            return redirect()->route('access.index')->with(
                'message', $e->getMessage()
            );
        }
    }

    /**
     * Validate code
     */
    public function validateCode(ValidateCodeRequest $request): RedirectResponse
    {
        try {
            $this->accessService->validate($request->validated());

            return redirect($this->accessService->getRedirectPrefix());
        } catch (\Exception $e) {
            return redirect()->route('access.index')->with(
                'message', $e->getMessage()
            );
        }
    }

}
