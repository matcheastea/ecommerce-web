<?php

namespace App\Http\Livewire\Admin\Brand;

use App\Models\Brand;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $name, $status;

    public function rules(){
        return [
            'name' => 'required|string',
            'status' => 'nullable'
        ];
    }
public function resetInput(){
    $this->name = NULL;
    $this->status = NULL;
}

    public function storeBrand(){
        $validateData = $this->validate();
        Brand::create([
            'name' => $this->name,
            'status' => $this->status == true ? '1':'0',
        ]);
        session()->flash('message','Brand Added Successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function render()
    {
        $brands = Brand::orderBy('id', 'DESC')->paginate(10);
        return view('livewire.admin.brand.index', ['brands' => $brands])
        ->extends('layout.admin')
        ->section('content')
        ;
    }
}
