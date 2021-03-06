<?php

namespace App\Http\Controllers\Backend;

use Session;
use App\Models\Settings;
use App\Http\Controllers\Controller;
use App\Http\Requests\SettingsUpdateRequest;

class SettingsController extends Controller
{
    /**
     * Display the settings page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data = [
            'blogTitle' => Settings::blogTitle(),
            'blogSubtitle' => Settings::blogSubTitle(),
            'blogDescription' => Settings::blogDescription(),
            'blogSeo' => Settings::blogSeo(),
            'blogAuthor' => Settings::blogAuthor(),
            'disqus' => Settings::disqus(),
            'analytics' => Settings::gaId(),
        ];

        return view('backend.settings.index', compact('data'));
    }

    /**
     * Store the site configuration options. This is currently accomplished
     * by finding the specific option, deleting it, and then inserting
     * the new option.
     *
     * @param SettingsUpdateRequest $request
     *
     * @return \Illuminate\View\View
     */
    public function store(SettingsUpdateRequest $request)
    {
        $blogTitle = Settings::where('setting_name', 'blog_title')->first();
        $blogTitle->setting_name = 'blog_title';
        $blogTitle->setting_value = $request->toArray()['blog_title'];
        $blogTitle->update();

        $blogSubtitle = Settings::where('setting_name', 'blog_subtitle')->first();
        $blogSubtitle->setting_name = 'blog_subtitle';
        $blogSubtitle->setting_value = $request->toArray()['blog_subtitle'];
        $blogSubtitle->update();

        $blogDescription = Settings::where('setting_name', 'blog_description')->first();
        $blogDescription->setting_name = 'blog_description';
        $blogDescription->setting_value = $request->toArray()['blog_description'];
        $blogDescription->update();

        $blogSeo = Settings::where('setting_name', 'blog_seo')->first();
        $blogSeo->setting_name = 'blog_seo';
        $blogSeo->setting_value = $request->toArray()['blog_seo'];
        $blogSeo->update();

        $blogAuthor = Settings::where('setting_name', 'blog_author')->first();
        $blogAuthor->setting_name = 'blog_author';
        $blogAuthor->setting_value = $request->toArray()['blog_author'];
        $blogAuthor->update();

        $disqusName = Settings::where('setting_name', 'disqus_name')->first();
        $disqusName->setting_name = 'disqus_name';
        $disqusName->setting_value = $request->toArray()['disqus_name'];
        $disqusName->update();

        $gaId = Settings::where('setting_name', 'ga_id')->first();
        $gaId->setting_name = 'ga_id';
        $gaId->setting_value = $request->toArray()['ga_id'];
        $gaId->update();

        Session::set('_update-settings', trans('messages.save_settings_success'));

        return redirect('admin/settings');
    }
}
