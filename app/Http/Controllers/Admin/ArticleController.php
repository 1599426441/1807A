<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ArticleCategory;
use App\Model\Article;
use App\Model\ArticleContent;
use Illuminate\Support\Facades\DB;
class ArticleController extends Controller
{
    //
    protected $category=null;
    protected $article=null;
    protected $content=null;

    public function __construct()
    {
        $this->category = new ArticleCategory();
        $this->article  = new Article();
        $this->content = new ArticleContent();
    }

    //文章列表页面
    public function lists()
    {
        $assign['category']=$this->category->getCategoryList();
        return view('admin.article.article.list');
    }

}
