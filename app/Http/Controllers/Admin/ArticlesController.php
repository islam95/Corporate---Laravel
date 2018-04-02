<?php

namespace Corp\Http\Controllers\Admin;

use Corp\Http\Requests\ArticleRequest;
use Corp\Models\Article;
use Corp\Models\Category;
use Corp\Repositories\ArticleRepository;
use Illuminate\Http\Request;

use Corp\Http\Requests;
use Corp\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class ArticlesController extends AdminController
{
    public function __construct(ArticleRepository $articles){
        parent::__construct();
        if(Gate::denies('VIEW_ARTICLES')){
            abort(403);
        }
        $this->articles = $articles;
        $this->template = env('THEME') .'.admin.articles';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function index(){
        $this->title = 'Articles management';
        $articles = $this->getArticles();
        $this->content = view(env('THEME').'.admin.articles_content')->with('articles', $articles)->render();
        return $this->renderOutput();
    }

    public function getArticles(){
        return $this->articles->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function create()
    {
        if (Gate::denies('save', new Article())){
            abort(403);
        }
        $this->title = "Add new article";
        $categories = Category::select(['title', 'alias', 'parent_id', 'id'])->get();
        $lists = array();
        foreach ($categories as $category){
            if($category->parent_id == 0){
                $lists[$category->title] = array();
            } else{
                $lists[$categories->where('id', $category->parent_id)->first()->title][$category->id] = $category->title;
            }
        }
        //dd($lists);
        $this->content = view(env('THEME') .'.admin.articles_create')->with('categories', $lists)->render();
        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ArticleRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $result = $this->articles->addArticle($request);
        if(is_array($result) && !empty($result['error'])){
            return back()->with($result);
        }
        return redirect('/admin')->with($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
