<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ModuleCollection;
use App\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json([
            'modules' => new ModuleCollection(Module::root()->orderByDesc('id')->get())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:modules'],
            'alias' => ['required', 'string', 'max:255'],
            'icon' => ['nullable', 'string', 'max:255'],
        ]);

        $trashedModule = Module::onlyTrashed()->whereName($request->name)->first();

        if ($trashedModule) {
            $trashedModule->restore();
            $trashedModule->update($request->all());

            return response()->json([
                'message' => $trashedModule->name . ' successfully restored.'
            ]);
        }

        $module = Module::create($request->all());

        return response()->json([
            'message' => $module->name . ' successfully created.'
        ], 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Module $module
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeChild(Request $request, Module $module)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:modules'],
            'alias' => ['required', 'string', 'max:255'],
            'icon' => ['nullable', 'string', 'max:255'],
        ]);

        $trashedModule = Module::onlyTrashed()->whereName($request->name)->first();

        if ($trashedModule) {
            $trashedModule->restore();
            $trashedModule->update($request->all());

            return response()->json([
                'message' => $module->name . ' successfully restored.'
            ]);
        }

        $module = $module->children()->create($request->all());

        return response()->json([
            'message' => $module->name . ' successfully created.'
        ], 201);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Module $module
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Module $module)
    {
        return response()->json([
            'module' => $module
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Module $module
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Module $module)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'alias' => ['required', 'string', 'max:255'],
            'icon' => ['nullable', 'string', 'max:255']
        ]);

        if ($request->name !== $module->name) {
            $request->validate([
                'name' => ['unique:modules']
            ]);
        }

        $module->update($request->all());

        return response()->json([
            'message' => $module->name . ' successfully updated.',
            'module' => $module
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Module $module
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Module $module)
    {
        $name = $module->name;

        $module->delete();

        return response()->json([
            'message' => $name . ' successfully deleted.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroyMany(Request $request)
    {
        $request->validate([
            'moduleIds' => ['required', 'array', 'min:1'],
            'moduleIds.*.id' => ['required_with:moduleIds', 'exists:modules,id'],
        ]);

        Module::destroy($request->moduleIds);

        return response()->json([
            'message' => 'Modules successfully deleted.'
        ]);
    }
}
