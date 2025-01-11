<?php

namespace App\Http\Repositories\Eloquent\Admin;

use App\Models\ProcesStep;
use DevxPackage\AbstractRepository;

class ProcesStepRepository extends AbstractRepository
{

    protected $model;

    public function __construct(ProcesStep $model)
    {
        $this->model = $model;
    }

    public function crudName(): string
    {
        return 'procesSteps';
    }

    public function index($offset, $limit)
    {
        $procesSteps = $this->pagination($offset, $limit);
        return view('admin.procesSteps.index', compact('procesSteps'));
    }

    public function create()
    {
        return view('admin.procesSteps.create');
    }

    public function edit($id)
    {
        $procesStep = $this->findOne($id);
        return view('admin.procesSteps.update', compact('procesStep'));
    }

    public function archivesPage($offset, $limit)
    {
        $procesSteps = $this->archives($offset, $limit);
        return view('admin.procesSteps.archives', compact('procesSteps'));
    }

}