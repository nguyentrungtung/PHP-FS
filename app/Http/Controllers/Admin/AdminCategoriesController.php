<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Repositories\Constracts\Repository\CategoryRepository;
use Illuminate\Http\Request;

class AdminCategoriesController extends Controller
{
    protected $catgoryRepository;
    public function __construct(CategoryRepository $catgoryRepository){
        $this->catgoryRepository = $catgoryRepository;
    }
    //
    public function index()
    {
        
        $categories = $this->catgoryRepository->index();
        // dd($categories);
        return view('admin.category.index',['cats'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $parents=$this->catgoryRepository->getParents();
        // dd($parents);
        return view('admin.category.create',['cats'=>$parents]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request->input());
        $name= $request->input('name');
        $parent_Id= $request->input('parent_id');
        $data=['categories_name'=>$name,'categories_parent_id'=>$parent_Id];
        $this->catgoryRepository->create($data);
        return redirect()->route('admin.categories')->with('success','');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $cat=$this->catgoryRepository->find($id);
        $parents=$this->catgoryRepository->getParents();
        return view('admin.category.edit',['cat'=>$cat,'cats'=>$parents]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data=['categories_name'=>$request->input('name'),'categories_parent_id'=>$request->input('parent_id')];
        $this->catgoryRepository->update($id,$data);
        return redirect()->route('admin.categories.edit',['id'=>$id])->with('success','Update sucsess!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->catgoryRepository->delete($id);
        //
    }
}
