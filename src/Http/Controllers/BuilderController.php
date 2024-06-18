<?php

namespace TomatoPHP\FilamentCms\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use ProtoneMedia\Splade\Facades\Toast;
use TomatoPHP\FilamentCms\Models\Post;
use TomatoPHP\TomatoThemes\Facades\TomatoThemes;

class BuilderController extends Controller
{
    public function edit(Request $request, Post $model)
    {
        return view('filament-cms::themes.builder-page', compact('model'));
    }

    public function update(Request $request, Post $model)
    {
        $request->validate([
            "body" => "required|string"
        ]);

        $model->body = $request->get('body');
        $model->save();

        Toast::success(__('Page updated successfully'))->autoDismiss(2);
        return redirect()->back();
    }

    public function builder(Request $request, \TomatoPHP\FilamentCms\Models\Post $model): View|JsonResponse
    {
        $sections = \TomatoPHP\FilamentCms\Facades\FilamentCms::themes()->getSections()->groupBy('group');
        return view('filament-themes::pages.builder', compact('model', 'sections'));
    }

    public function meta(Request $request,\TomatoPHP\FilamentCms\Models\Post $model){
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

    public function clear(\TomatoPHP\FilamentCms\Models\Post $model){
        $model->meta('sections', []);

        Toast::success(__('Sections cleared successfully'))->autoDismiss(2);
        return redirect()->back();
    }
}
