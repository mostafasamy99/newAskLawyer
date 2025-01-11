<?php

namespace App\Http\Repositories\Eloquent\Admin;

use App\Models\Setting;
use DevxPackage\AbstractRepository;

class SettingRepository extends AbstractRepository
{

    protected $model;

    public function __construct(Setting $model)
    {
        $this->model = $model;
    }

    public function crudName(): string
    {
        return 'settings';
    }

    public function index($offset, $limit)
    {
        $settings = $this->pagination($offset, $limit);
        return view('admin.settings.index', compact('settings'));
    }

    public function create()
    {
        return view('admin.settings.create');
    }

    public function edit($id)
    {
        $setting = $this->findOne($id);
        return view('admin.settings.update', compact('setting'));
    }

    public function editSetting()
    {
        $setting = $this->findOne(1);
        return view('admin.settings.index', compact('setting'));
    }

    public function archivesPage($offset, $limit)
    {
        $settings = $this->archives($offset, $limit);
        return view('admin.settings.archives', compact('settings'));
    }

}