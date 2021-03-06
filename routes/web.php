<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::prefix("study")->group(function(){
    Route::get('lottery/index','Study\LotterController@lottery');//抽奖页面
    Route::any('lottery/do','Study\LotterController@doLottery');
    Route::get('guess/add','Study\GuessController@add');//竞猜添加页面
    Route::post('guess/doAdd','Study\GuessController@doAdd');//竞猜添加页面
    Route::get('guess/list','Study\GuessController@lists');//竞猜列表页面
    Route::get('guess/guess','Study\GuessController@guess');//竞猜添加页面doGuess
    Route::get('guess/result','Study\GuessController@checkResult');//竞猜添加页面doGuess
    Route::post('guess/doGuess','Study\GuessController@doGuess');//竞猜添加页面
});
//登录页面
 Route::any("admin/login","Admin\LoginController@index");
 Route::any("admin/logout","Admin\LoginController@logout");
 //执行登录
 Route::any("admin/doLogin","Admin\LoginController@doLogin");
 Route::any('study/delSign',"Study\IndexController@delSign");
 // Route::any('study/getList',"Study\IndexController@getList");
 // Route::any('study/Sign',"Study\IndexController@Sign");
 Route::get('403',function(){
 	return view('403');
 });
 //管理后台RBAC功能的路由组
 Route::middleware(['permission_auth','admin_auth'])->prefix('admin')->group(function(){
 	//后台登录首页
 		Route::any("home","Admin\HomeController@home")->name('admin.home');
 		/*###########################[权限相关]#####################*/
 		//权限列表
 		Route::any("/permission/list",'Admin\permissionController@list')->name('admin.permission.list');
 		//获取权限的数据
 		Route::any("/get/permission/list/{fid?}","Admin\permissionController@getPermissionList")->name('admin.get.permission.list');
 		//权限添加
 		Route::get('/permission/create','Admin\permissionController@create')->name('admin.permission.create');
 		//执行权限添加
 		Route::post('/permission/doCreate','Admin\permissionController@doCreate')->name('admin.permission.doCreate');
 		//删除权限操作
 		Route::get('/permission/del/{id}','Admin\permissionController@del')->name('admin.permission.del');
 		/*###########################[权限相关]#####################*/



 		/*###########################[用户相关]#####################*/
 		//用户添加页面
 		Route::get('/user/add','Admin\AdminUsersController@create')->name('admin.user.add');
 		//执行用户添加
 		Route::post('/user/store','Admin\AdminUsersController@store')->name('admin.user.store');
 		//用户列表页面
 		Route::get('/user/list','Admin\AdminUsersController@list')->name('admin.user.list');
 		//用户删除页面
 		Route::get('/user/del/{id}','Admin\AdminUsersController@delUser')->name('admin.user.del');
 		//用户编辑页面
 		Route::get('/user/edit/{id}','Admin\AdminUsersController@edit')->name('admin.user.edit');
 		//用户执行编辑页面
 		Route::post('/user/doEdit','Admin\AdminUsersController@doEdit')->name('admin.user.doEdit');
 		/*###########################[用户相关]#####################*/

 		/*###########################[角色相关]#####################*/
 		//角色列表
 		Route::get('/role/list','Admin\RoleController@list')->name('admin.role.list');
 		//角色删除
 		Route::get('/role/del/{id}','Admin\RoleController@delRole')->name('admin.role.del');
 		//角色编辑
 		Route::get('/role/edit/{id}','Admin\RoleController@edit')->name('admin.role.edit');
 		//执行编辑
 		Route::post('/role/doEdit','Admin\RoleController@doEdit')->name('admin.role.doEdit');
 		//角色添加
 		Route::get('/role/create','Admin\RoleController@create')->name('admin.role.create');
 		//执行添加
 		Route::post('/role/store','Admin\RoleController@store')->name('admin.role.store');
 		//角色权限编辑
 		Route::get('/role/permission/{id}','Admin\RoleController@rolePermission')->name('admin.role.permission');
 		//角色权限执行编辑
 		Route::post('/role/permission/save','Admin\RoleController@saveRolePermission')->name('admin.role.permission.save');

 		/*###########################[角色相关]#####################*/

 		/*###########################[小说相关]#####################*/
 		//作者列表
 		Route::get('author/list','Admin\AuthorController@list')->name('admin.author.list');
 		//作者添加
 		Route::get('author/create','Admin\AuthorController@create')->name('admin.author.create');
 		//作者执行添加
 		Route::post('author/store','Admin\AuthorController@store')->name('admin.author.store');
 		//作者删除
 		Route::get('author/del/{id}','Admin\AuthorController@del')->name('admin.author.del');
 		//小说分类列表
// 		Route::get('category/list','Admin\CategoryController@list')->name('admin.category.list');
// 		//小说分类添加
// 		Route::get('category/create','Admin\CategoryController@create')->name('admin.category.create');
// 		//小说执行分添加
// 		Route::post('category/store','Admin\CategoryController@store')->name('admin.category.store');
// 		//执行小说分类删除
// 		Route::get('category/del/{id}','Admin\CategoryController@del')->name('admin.category.del');
// 		//小说添加
 		Route::get('novel/create','Admin\NovelController@create')->name('admin.novel.create');
 		//小说列表
 		Route::get('novel/list','Admin\NovelController@list')->name('admin.novel.list');
 		//执行小说的添加
 		Route::post('novel/store','Admin\NovelController@store')->name('admin.novel.store');
 		 //小说编辑
     Route::get('nove/edit/{id}','Admin\NovelController@edit')->name('admin.novel.edit');
 		//执行小说编辑
     Route::post('nove/doEdit','Admin\NovelController@doEdit')->name('admin.novel.doEdit');
     //小说的删除
     Route::get('novel/del/{id}','Admin\NovelController@del')->name('admin.novel.del');
     
     //添加小说章节页面
     Route::get('chapter/add/{novel_id}','Admin\ChapterController@create')->name('admin.chapter.create');
     //保存小说的章节
     Route::post('chapter/store','Admin\ChapterController@store')->name('admin.chapter.store');
     // //小说章节列表
     Route::get('chapter/list/{novel_id?}','Admin\ChapterController@list')->name('admin.chapter.list');
     // //章节删除
     Route::get('chapter/del/{id}','Admin\ChapterController@del')->name('admin.chapter.del');
     // //章节编辑
     Route::get('chapter/edit/{id}','Admin\ChapterController@edit')->name('admin.chapter.edit');
     // //执行章节编辑
     Route::post('chapter/doEdit','Admin\ChapterController@doEdit')->name('admin.chapter.doEdit');
     // //小说评论列表页面
     Route::get('novel/comment/list','Admin\CommentController@list')->name('admin.novel.comment.list');
     //小说数据
     Route::get('novel/comment/data','Admin\CommentController@getComment')->name('admin.novel.comment.data');
     // //小说评论审核
     Route::get('novel/comment/check/{id}','Admin\CommentController@check')->name('admin.novel.comment.check');

     // //小说评论删除
     Route::get('novel/comment/del/{id}','Admin\CommentController@del')->name('admin.novel.comment.del');

     /*###########################[商品品牌相关]#####################*/
     Route::get('brand/list','Admin\BrandController@lists')->name('admin.brand.list');//品牌列表页面
     Route::get('brand/add','Admin\BrandController@add')->name('admin.brand.add');///品牌添加页面
     Route::post('brand/data/list','Admin\BrandController@getListData')->name('admin.brand.data.list');//品牌列表数据
     Route::post('brand/doAdd','Admin\BrandController@doAdd')->name('admin.brand.doAdd');//商品品牌添加
     Route::get('brand/del/{id}','Admin\BrandController@del')->name('admin.brand.del');//执行删除的操作
     Route::get('brand/edit/{id}','Admin\BrandController@edit')->name('admin.brand.edit');///品牌添加页面
     Route::post('brand/doEdit','Admin\BrandController@doEdit')->name('admin.brand.doEdit');//商品品牌修改
     Route::post('brand/change/attr','Admin\BrandController@changeAttr')->name('admin.brand.change.attr');//修改属性接口
     /*###########################[商品品牌相关]#####################*/
     /*###########################[商品分类相关]#####################*/
     Route::get('category/list','Admin\CategoryController@lists')->name('admin.category.list');//商品分类列表页面
     Route::get('category/get/data/{fid?}','Admin\CategoryController@getListData')->name('admin.category.get.data');//获取商品分类数据的的接口
     Route::get('category/add','Admin\CategoryController@add')->name('admin.category.add');//商品添加页面
     Route::post('category/doAdd','Admin\CategoryController@doAdd')->name('admin.category.doAdd');//商品执行添加页面
     Route::get('category/del/{id}','Admin\CategoryController@del')->name('admin.category.del');//商品删除操作
     Route::get('category/edit/{id}','Admin\CategoryController@edit')->name('admin.category.edit');//商品修改页面
     Route::post('category/doEdit','Admin\CategoryController@doEdit')->name('admin.category.doEdit');//商品修改
     /*###########################[商品分类相关]#####################*/
     /*###########################[文章分类相关]#####################*/
     Route::get('article/category/list','Admin\ArticleCategoryController@lists')->name('admin.article.category.list');//文章分类列表
     //文章分类添加
     Route::get('article/category/add','Admin\ArticleCategoryController@add')->name('admin.article.category.add');
     //文章分类执行添加
     Route::post('article/category/store','Admin\ArticleCategoryController@store')->name('admin.article.category.store');

     //文章分类编辑
     Route::get('article/category/edit/{id}','Admin\ArticleCategoryController@edit')->name('admin.article.category.edit');
     //文章分类执行编辑
     Route::post('article/category/save','Admin\ArticleCategoryController@doEdit')->name('admin.article.category.save');
     //文章分类的删除
     Route::get('article/category/del/{id}','Admin\ArticleCategoryController@del')->name('admin.article.category.del');
     /*###########################[文章分类相关]#####################*/
     /*#############################[文章相关]#############################*/

     //文章列表
     Route::get('article/list','Admin\ArticleController@list')->name('admin.article.list');
     //文章添加
     Route::get('article/add','Admin\ArticleController@add')->name('admin.article.add');
     //文章执行添加
     Route::post('article/store','Admin\ArticleController@store')->name('admin.article.store');

     //文章分类编辑
     Route::get('article/edit/{id}','Admin\ArticleController@edit')->name('admin.article.edit');
     //文章分类执行编辑
     Route::post('article/save','Admin\ArticleController@doEdit')->name('admin.article.save');

     //文章分类的删除
     Route::get('article/del/{id}','Admin\ArticleController@del')->name('admin.article.del');
     /*#############################[文章相关]#############################*/
     /*#############################[文章相关]#############################*/

     //文章列表
     Route::get('article/list','Admin\ArticleController@lists')->name('admin.article.list');
     //文章添加
     Route::get('article/add','Admin\ArticleController@add')->name('admin.article.add');
     //文章执行添加
     Route::post('article/store','Admin\ArticleController@store')->name('admin.article.store');

     //文章分类编辑
     Route::get('article/edit/{id}','Admin\ArticleController@edit')->name('admin.article.edit');
     //文章分类执行编辑
     Route::post('article/save','Admin\ArticleController@doEdit')->name('admin.article.save');

     //文章分类的删除
     Route::get('article/del/{id}','Admin\ArticleController@del')->name('admin.article.del');
     /*#############################[文章相关]#############################*/

 });

