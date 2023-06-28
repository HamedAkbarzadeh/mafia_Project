<?php

namespace App\Http\Controllers\admin\setting;

use Illuminate\Http\Request;
use App\Models\Setting\Setting;
use Database\Seeders\SettingSeeder;
use App\Http\Controllers\Controller;
use App\Http\Services\Image\ImageService;
use App\Http\Requests\Admin\Setting\SettingRequest;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::first();
        if($setting == null){
            $default = new SettingSeeder;
            $default->run();
            $setting = Setting::first();
        }
        return view('admin.setting.index' , compact('setting'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        return view('admin.setting.edit' , compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SettingRequest $request, Setting $setting, ImageService $imageService)
    {
        $inputs = $request->all();
        if($request->hasFile('whiteLogo'))
        {
            if(!empty($setting->whiteLogo))
            {
                $imageService->deleteImage($setting->whiteLogo);
            }
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'setting');
            $imageService->setImageName('whiteLogo');
            $result = $imageService->save($request->file('whiteLogo'));
            if($result === false)
            {
                return redirect()->route('admin.setting.index')->with('swal-error', 'آپلود تصویر لوگو با خطا مواجه شد');
            }
            $inputs['whiteLogo'] = $result;
        }
        if($request->hasFile('blackLogo'))
        {
            if(!empty($setting->blackLogo))
            {
                $imageService->deleteImage($setting->blackLogo);
            }
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'setting');
            $imageService->setImageName('blackLogo');
            $result = $imageService->save($request->file('blackLogo'));
            if($result === false)
            {
                return redirect()->route('admin.setting.index')->with('swal-error', 'آپلود تصویر لوگو با خطا مواجه شد');
            }
            $inputs['blackLogo'] = $result;
        }
        if($request->hasFile('icon'))
        {
            if(!empty($setting->icon))
            {
                $imageService->deleteImage($setting->icon);
            }
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'setting');
            $imageService->setImageName('icon');
            $result = $imageService->save($request->file('icon'));
            if($result === false)
            {
                return redirect()->route('admin.setting.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['icon'] = $result;
        }
        if($request->hasFile('bannerImage'))
        {
            if(!empty($setting->bannerImage))
            {
                $imageService->deleteImage($setting->bannerImage);
            }
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'setting');
            $imageService->setImageName('bannerImage');
            $result = $imageService->save($request->file('bannerImage'));
            if($result === false)
            {
                return redirect()->route('admin.setting.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['bannerImage'] = $result;
        }
        if($request->hasFile('ruleImage'))
        {
            if(!empty($setting->ruleImage))
            {
                $imageService->deleteImage($setting->ruleImage);
            }
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'setting');
            $imageService->setImageName('ruleImage');
            $result = $imageService->save($request->file('ruleImage'));
            if($result === false)
            {
                return redirect()->route('admin.setting.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['ruleImage'] = $result;
        }
        $setting->update($inputs);
        return redirect()->route('admin.setting.index')->with('swal-success', 'تنظیمات سایت  شما با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
