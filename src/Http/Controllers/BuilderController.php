<?php

namespace TomatoPHP\FilamentCms\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Illuminate\View\View;
use ProtoneMedia\Splade\Facades\Toast;
use TomatoPHP\FilamentCms\Models\Post;
use TomatoPHP\TomatoThemes\Facades\TomatoThemes;

class BuilderController extends Controller
{
    public function builder(Request $request, \TomatoPHP\FilamentCms\Models\Post $model): View|JsonResponse
    {
        $this->authorizePage($request, $model);

        $sections = \TomatoPHP\FilamentCms\Facades\FilamentCms::themes()->getSections()->groupBy('group');
        return view('filament-themes::pages.builder', compact('model', 'sections'));
    }

    public function meta(Request $request,\TomatoPHP\FilamentCms\Models\Post $model){
        $this->authorizePage($request, $model);

        $request->validate([
            "section" => "required|string"
        ]);

        $sectionID = $request->get('section');
        $section = collect($model->meta('sections'))->where('uuid', $sectionID)->first();
        if($section){
            if(!empty($section['form'])){
                return view('filament-themes::pages.meta', compact('model','section',  'sectionID'));
            }
            else {
                Toast::danger(__('Section do not have form'))->autoDismiss(2);
                return redirect()->back();
            }
        }
        else {
            Toast::danger(__('Section not found'))->autoDismiss(2);
            return redirect()->back();
        }

    }

    public function metaStore(Request $request, \TomatoPHP\FilamentCms\Models\Post $model){
        $this->authorizePage($request, $model);

        $request->validate([
            "section" => "required|string"
        ]);

        $data = $request->all();
        $sectionID = $request->get('section');
        $section = collect($model->meta('sections'))->where('uuid', $sectionID)->first();

        if($section){
            if(isset($data['image'])){
                $image = $data['image']->storeAs('public/sections', time() . '.' . $request->file('image')->extension());
                $data['image'] =  url(Str::replace('public', 'storage', $image));
            }

            if(isset($data['images']) && is_array($data['images'])){
                $images = [];
                foreach ($data['images'] as $image){
                    $image = $image->storeAs('public/sections', time() . '.' . $image->extension());
                    $images[] = url(Str::replace('public', 'storage', $image));
                }

                $data['images'] = $images;
            }

            $model->meta($sectionID, $data);

            Toast::success(__('Section updated successfully'))->autoDismiss(2);
            return redirect()->back();
        }
        else {
            Toast::danger(__('Section not found'))->autoDismiss(2);
            return redirect()->back();
        }

    }

    public function remove(Request $request, \TomatoPHP\FilamentCms\Models\Post $model){
        $this->authorizePage($request, $model);

        $request->validate([
            "section" => "required|string"
        ]);

        $section = $request->get('section');
        $sections = collect($model->meta('sections'))->filter(function ($item) use ($section){
            return $item['uuid'] !== $section;
        });

        $sections = $model->meta('sections', $sections);

        Toast::success(__('Section removed successfully'))->autoDismiss(2);
        return redirect()->back();
    }

    public function sections(Request $request, \TomatoPHP\FilamentCms\Models\Post $model){
        $this->authorizePage($request, $model);

        $request->validate([
            "section" => "required|string"
        ]);

        $section = TomatoThemes::find($request->get('section'));
        if($section){
            $sections = $model->meta('sections');
            $section['order'] = 0;
            $section['uuid'] = Str::uuid();
            $sections[] = $section;
            $model->meta('sections', $sections);


            Toast::success(__('Section added successfully'))->autoDismiss(2);
            return redirect()->back();
        }
        else {
            Toast::danger(__('Section not found'))->autoDismiss(2);
            return redirect()->back();
        }


    }

    public function clear(Request $request, \TomatoPHP\FilamentCms\Models\Post $model){
        $this->authorizePage($request, $model);

        $model->meta('sections', []);

        Toast::success(__('Sections cleared successfully'))->autoDismiss(2);
        return redirect()->back();
    }

    /**
     * Only users the host app's Post policy allows to `update` the page may use the builder.
     * Without a registered policy every request is denied.
     */
    protected function authorizePage(Request $request, Post $model): void
    {
        $user = $request->user();
        abort_unless($user, 403);
        abort_if(Gate::getPolicyFor($model) === null, 403);

        Gate::forUser($user)->authorize('update', $model);
    }
}
