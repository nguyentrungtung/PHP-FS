<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Services\CategoriesService;
use Illuminate\Http\Request;

class AdminCategoriesController extends Controller
{
    private $catgoryService;
    public function __construct(
        CategoriesService $catgoryService,
    ){
        $this->catgoryService = $catgoryService;
    }
    //
    public function index()
    {
        
        $categories = $this->catgoryService->index();
        // dd($categories);
        return view('admin.category.index',['cats'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $parents=$this->catgoryService->getParents();
        // dd($parents);
        return view('admin.category.create',['cats'=>$parents]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->catgoryService->create($request);
        return redirect()->route('admin.categories')->with('success','Add sucsess!');
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
        $data=$this->catgoryService->getCatWithParent($id);
        return view('admin.category.edit',['cat'=>$data['cat'],'cats'=>$data['parents']]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->catgoryService->update($request,$id);
        return redirect()->route('admin.categories.edit',['id'=>$id])->with('success','Update sucsess!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->catgoryService->destroy($id);
        // return with('success','Delete sucsess!');
        //
    }
}
